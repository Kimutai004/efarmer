<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class OptimizeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize {--clear : Clear all caches instead of optimizing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize the application for production performance';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if ($this->option('clear')) {
            $this->clearCaches();
            return Command::SUCCESS;
        }

        $this->info('Starting application optimization...');

        // Clear existing caches first
        $this->clearCaches();

        // Cache configuration
        $this->info('Caching configuration...');
        Artisan::call('config:cache');
        $this->info('Configuration cached successfully.');

        // Cache routes
        $this->info('Caching routes...');
        Artisan::call('route:cache');
        $this->info('Routes cached successfully.');

        // Cache views
        $this->info('Caching views...');
        Artisan::call('view:cache');
        $this->info('Views cached successfully.');

        // Cache events
        $this->info('Caching events...');
        Artisan::call('event:cache');
        $this->info('Events cached successfully.');

        // Optimize autoloader
        $this->info('Optimizing autoloader...');
        shell_exec('composer dump-autoload --optimize --no-dev --classmap-authoritative 2>&1');
        $this->info('Autoloader optimized successfully.');

        $this->info(' Application optimization completed!');
        $this->info('');
        $this->info('Your application is now optimized for production.');
        $this->info('Remember to run "php artisan app:optimize --clear" before re-optimizing.');

        return Command::SUCCESS;
    }

    /**
     * Clear all caches
     */
    private function clearCaches(): void
    {
        $this->info('Clearing caches...');

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        Artisan::call('clear-compiled');

        $this->info('All caches cleared.');
    }
}
