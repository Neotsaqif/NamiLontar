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
        try {
            // Check if database exists by attempting to connect
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            // Database might not exist, try to create it
            $connection = config('database.default');
            $config = config("database.connections.{$connection}");
            
            if (!$config) {
                return;
            }

            $database = $config['database'];

            // Connect to server without database selection
            $config['database'] = null;
            config(["database.connections.{$connection}_setup" => $config]);

            try {
                DB::connection("{$connection}_setup")->statement("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
                DB::purge("{$connection}_setup");
                
                // Reset original connection to use the new database
                DB::purge($connection);
            } catch (\Exception $e2) {
                // If we can't even create the database, we might lack permissions
                return;
            }
        }

        // Now that the database exists, check if tables are missing
        try {
            if (!Schema::hasTable('migrations')) {
                Artisan::call('migrate', ['--force' => true]);
            }
        } catch (\Exception $e) {
            // Silently fail if migration fails
        }
    }
}
