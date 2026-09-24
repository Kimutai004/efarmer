# Efarmer Application Optimization Guide

This document describes the performance optimizations implemented in the application to handle high traffic and ensure stability.

## Overview of Optimizations

### 1. Database Optimizations

#### Added Indexes
The following indexes have been added to improve query performance:

**goats table:**
- `status` - For filtering by goat status
- `breed_id` - For filtering by breed
- `gender` - For filtering by gender
- `featured` - For filtering featured goats
- `selling_price` - For price range filtering
- `status, featured` - Composite index for featured available goats
- `status, breed_id` - Composite index for breed filtering with status

**goat_photos table:**
- `goat_id, is_primary` - Composite index for fetching primary photos

**payments table:**
- `status` - For filtering by payment status
- `phone_number` - For looking up payments by phone
- `created_at` - For date range queries
- `status, created_at` - Composite index for status with date filtering

**sales table:**
- `status` - For filtering by sale status
- `payment_status` - For filtering by payment status
- `sale_date` - For date range queries
- `customer_id` - For looking up sales by customer
- `status, sale_date` - Composite index for dashboard queries

#### Database Configuration
- Set MySQL engine to `InnoDB` for better transaction support
- Enabled persistent database connections to reduce connection overhead

### 2. Query Optimizations

#### Dashboard Controller
- Reduced multiple count queries to a single query using conditional aggregation
- Added caching for frequently accessed data (breeds count, customers count, expenses)
- Cache TTL: 1 hour for stable data, 5 minutes for expenses

#### Goat Controller
- Cached breeds query (rarely changes)
- Removed duplicate breeds query in index method
- Applied caching to create and edit methods

### 3. Caching Strategy

#### Cache Keys
- `active_breeds` - Active breeds list (TTL: 1 hour)
- `breeds_count` - Total breeds count (TTL: 1 hour)
- `customers_count` - Total customers count (TTL: 1 hour)
- `total_expenses` - Total expenses amount (TTL: 5 minutes)

#### Cache Invalidation
Cache is automatically cleared when:
- A goat is created, updated, or deleted
- A breed is created, updated, or deleted
- A sale is created, updated, or deleted
- An expense is created, updated, or deleted

### 4. Rate Limiting

#### Payment Endpoints
- `payment.initiate` - 5 requests per minute per IP
- `payment.status` - 30 requests per minute per IP

This prevents abuse and protects the M-Pesa API from being overwhelmed.

### 5. Error Handling & Monitoring

#### Slow Query Logging
In development mode, queries taking longer than 100ms are logged to help identify performance bottlenecks.

#### Debug Mode
Debug mode is automatically disabled in production for security and performance.

### 6. Configuration

#### Transport Fee Configuration
The transport fee is now configurable via `.env` file:
```
TRANSPORT_FEE_PER_GOAT=300
```

#### Database Persistent Connections
Enable/disable persistent connections:
```
DB_PERSISTENT=true
```

## Deployment Optimization Commands

### Optimize for Production
```bash
php artisan app:optimize
```

This command:
1. Clears all existing caches
2. Caches configuration
3. Caches routes
4. Caches views
5. Caches events
6. Optimizes Composer autoloader

### Clear Caches
```bash
php artisan app:optimize --clear
```

### Manual Optimization Commands
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache events
php artisan event:cache

# Optimize autoloader
composer dump-autoload --optimize --no-dev --classmap-authoritative
```

## Additional Recommendations

### Server-Level Optimizations

1. **PHP Configuration**
   - Enable OPcache with recommended settings:
     ```ini
     opcache.enable=1
     opcache.memory_consumption=256
     opcache.max_accelerated_files=10000
     opcache.validate_timestamps=0
     opcache.revalidate_freq=0
     ```

2. **MySQL Configuration**
   - Enable query cache
   - Optimize InnoDB buffer pool size
   - Enable slow query log for monitoring

3. **Web Server**
   - Enable gzip compression
   - Set proper cache headers for static assets
   - Use HTTP/2 if possible

4. **Queue Worker**
   For high-traffic scenarios, consider using queues for M-Pesa API calls:
   ```bash
   php artisan queue:work --tries=3 --timeout=60
   ```

### Monitoring

1. **Laravel Telescope** (Development)
   ```bash
   composer require laravel/telescope
   php artisan telescope:install
   ```

2. **Laravel Horizon** (Production with Redis)
   ```bash
   composer require laravel/horizon
   php artisan horizon:install
   ```

## Performance Metrics

Expected improvements:
- **Dashboard load time**: ~60% faster (reduced from 10+ queries to 2 queries)
- **Goat listing**: ~40% faster (cached breeds, indexed queries)
- **Database queries**: ~50% faster with proper indexing
- **Page load time**: ~30% faster with config/route/view caching

## Troubleshooting

### Cache Issues
If data appears stale:
```bash
php artisan app:optimize --clear
php artisan app:optimize
```

### Rate Limiting
If you hit rate limits during testing, temporarily increase limits in `RouteServiceProvider.php`.

### Slow Queries
Check `storage/logs/laravel.log` for slow query warnings in development mode.
