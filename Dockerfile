# ---------- Build stage: Composer dependencies ----------
FROM composer:2 AS vendor

WORKDIR /app

# Install dependencies first to leverage Docker layer caching.
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs

# Bring in the rest of the application and build the autoloader.
# composer.json's post-autoload-dump runs `php artisan package:discover`.
COPY . .
RUN composer dump-autoload --optimize --no-interaction

# ---------- Runtime stage: PHP-FPM + nginx + supervisor ----------
FROM php:8.2-fpm-bookworm

RUN apt-get update && apt-get install -y --no-install-recommends \
        gettext-base \
        nginx \
        supervisor \
        libpq-dev \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        curl \
        gd \
        mbstring \
        opcache \
        pdo_mysql \
        pdo_pgsql \
        zip \
    && rm -rf /var/lib/apt/lists/*

# PHP settings for uploads and production.
COPY docker/php.ini /usr/local/etc/php/conf.d/99-app.ini

# PHP-FPM workers must inherit the container environment: Render provides
# configuration such as APP_KEY, DB_* and M-Pesa credentials as env vars.
RUN sed -i -e 's/^;clear_env.*/clear_env = no/' -e 's/^clear_env.*/clear_env = no/' \
        /usr/local/etc/php-fpm.d/www.conf \
    && { grep -q '^clear_env' /usr/local/etc/php-fpm.d/www.conf \
        || echo 'clear_env = no' >> /usr/local/etc/php-fpm.d/www.conf; }

WORKDIR /var/www/html

# Application code + production Composer dependencies from the build stage.
COPY --from=vendor /app /var/www/html

# Directories PHP-FPM (www-data) must be able to write to.
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R u+rwX storage bootstrap/cache

# Process manager, web server template and entrypoint.
COPY docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/nginx-site.conf.template /etc/nginx/site.conf.template
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Render routes traffic to $PORT (default 10000).
EXPOSE 10000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
