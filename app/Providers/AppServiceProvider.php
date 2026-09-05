<?php

namespace App\Providers;

use App\Models\Breed;
use App\Models\Expense;
use App\Models\Goat;
use App\Models\Sale;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Disable debug mode in production
        if ($this->app->environment('production')) {
            $this->app['config']['app.debug'] = false;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Log slow queries in development (over 100ms)
        if ($this->app->environment('local')) {
            DB::listen(function ($query) {
                if ($query->time > 100) {
                    Log::warning('Slow query detected', [
                        'sql' => $query->sql,
                        'bindings' => $query->bindings,
                        'time' => $query->time . 'ms',
                    ]);
                }
            });
        }

        // Clear relevant caches when models are updated
        foreach ([Goat::class, Breed::class, Sale::class, Expense::class] as $model) {
            $model::saved(function () {
                $this->clearAppCache();
            });
            $model::deleted(function () {
                $this->clearAppCache();
            });
        }
    }

    /**
     * Clear application cache
     */
    private function clearAppCache(): void
    {
        Cache::forget('active_breeds');
        Cache::forget('breeds_count');
        Cache::forget('customers_count');
        Cache::forget('total_expenses');
    }
}
