#!/usr/bin/env bash
set -euo pipefail

APP_HOME=/var/www/html
cd "$APP_HOME"

# Render routes traffic to $PORT (default 10000).
export PORT="${PORT:-10000}"

# Writable directories for Laravel (cache, sessions, views, logs, uploads).
mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/app/public \
    storage/logs \
    bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R u+rwX storage bootstrap/cache

# Render routes traffic to $PORT; substitute only ${PORT} and keep the
# nginx runtime variables ($uri, $query_string, ...) intact.
envsubst '${PORT}' < /etc/nginx/site.conf.template > /etc/nginx/sites-available/default

# Public symlink for uploaded files (idempotent).
php artisan storage:link >/dev/null 2>&1 || true

# Wait for the database and run migrations once per deploy.
if [ -n "${DB_HOST:-}" ]; then
    echo "Waiting for database and running migrations..."
    attempt=0
    until php artisan migrate --force; do
        attempt=$((attempt + 1))
        if [ "$attempt" -ge 30 ]; then
            echo "Database unreachable after ${attempt} attempts; aborting." >&2
            exit 1
        fi
        echo "Database not ready (attempt ${attempt}/30); retrying in 2s..."
        sleep 2
    done
else
    echo "DB_HOST not set; skipping migrations."
fi

# Cache configuration and compiled views for production.
# NOTE: route:cache is deliberately not used - routes/web.php defines
# closure routes, which Laravel cannot serialize into the route cache.
php artisan config:cache
php artisan view:cache

exec supervisord -c /etc/supervisor/supervisord.conf
