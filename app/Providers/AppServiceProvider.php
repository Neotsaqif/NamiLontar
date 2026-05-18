<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('local')) {
            $this->ensureDatabaseAndTablesExist();
        }
    }

    /**
     * Ensure the database and required tables exist.
     */
    protected function ensureDatabaseAndTablesExist(): void
    {
        $connection = config('database.default');
        $config = config("database.connections.{$connection}");
        
        if (!$config) {
            return;
        }
        $connection = config('database.default');
        $config = config("database.connections.{$connection}");
        
        if (!$config) {
            return;
        }

        // 1. Ensure Database Exists
        if ($connection === 'sqlite') {
            $dbPath = $config['database'];
            if ($dbPath !== ':memory:' && !file_exists($dbPath)) {
                try {
                    @mkdir(dirname($dbPath), 0755, true);
                    @touch($dbPath);
                } catch (\Exception $e) {
                    return;
                }
            }
        } else if ($connection === 'mysql') {
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                $database = $config['database'];
                $config['database'] = null;
                config(["database.connections.{$connection}_setup" => $config]);
        // 1. Ensure Database Exists
        if ($connection === 'sqlite') {
            $dbPath = $config['database'];
            if ($dbPath !== ':memory:' && !file_exists($dbPath)) {
                try {
                    @mkdir(dirname($dbPath), 0755, true);
                    @touch($dbPath);
                } catch (\Exception $e) {
                    return;
                }
            }
        } else if ($connection === 'mysql') {
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                $database = $config['database'];
                $config['database'] = null;
                config(["database.connections.{$connection}_setup" => $config]);

                try {
                    DB::connection("{$connection}_setup")->statement("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
                    DB::purge("{$connection}_setup");
                    DB::purge($connection);
                } catch (\Exception $e2) {
                    return;
                }
            }
        }

        // 2. Ensure Migrations and Tables exist
        try {
            $hasMigrationsTable = Schema::hasTable('migrations');
            $hasProductsTable = Schema::hasTable('products');
            $hasCategoriesTable = Schema::hasTable('categories');
            $hasDiscountsTable = Schema::hasTable('discounts');

            if (!$hasMigrationsTable || !$hasProductsTable || !$hasCategoriesTable || !$hasDiscountsTable) {
                Artisan::call('migrate', ['--force' => true]);
            }

            // 3. Ensure seed data exists
            if (Schema::hasTable('products') && \App\Models\Product::count() === 0) {
                Artisan::call('db:seed', ['--force' => true]);
            } else {
                if (Schema::hasTable('categories') && \App\Models\Category::count() === 0) {
                    Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
                }
                if (Schema::hasTable('discounts') && \App\Models\Discount::count() === 0) {
                    Artisan::call('db:seed', ['--class' => 'DiscountSeeder', '--force' => true]);
                }
            }
        } catch (\Exception $e) {
            // Silently fail to avoid blocking server boot
            // Silently fail to avoid blocking server boot
        }
    }
}