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
        // 1. Check for Primary Database Setting to switch connection dynamically
        try {
            if (Schema::hasTable('system_settings')) {
                $primary = DB::table('system_settings')->where('key', 'primary_database')->value('value');
                if ($primary && in_array($primary, ['mysql', 'sqlite'])) {
                    config(['database.default' => $primary]);
                }
            }
        } catch (\Exception $e) {
            // Silently skip if DB/Table not ready yet
        }

        if (app()->environment('local')) {
            $this->ensureDatabaseAndTablesExist();
        }
    }

    /**
     * Ensure the database and required tables exist for both MySQL and SQLite.
     */
    protected function ensureDatabaseAndTablesExist(): void
    {
        // 1. Ensure SQLite database file exists
        $sqliteConfig = config("database.connections.sqlite");
        if ($sqliteConfig && isset($sqliteConfig['database'])) {
            $dbPath = $sqliteConfig['database'];
            if ($dbPath !== ':memory:' && !file_exists($dbPath)) {
                try {
                    @mkdir(dirname($dbPath), 0755, true);
                    @touch($dbPath);
                } catch (\Exception $e) {
                    // Ignore
                }
            }
        }

        // 2. Ensure MySQL database exists
        $mysqlConfig = config("database.connections.mysql");
        if ($mysqlConfig) {
            try {
                // Try connecting to MySQL server to create the DB if missing
                $pdo = @new \PDO(
                    "mysql:host={$mysqlConfig['host']};port={$mysqlConfig['port']}",
                    $mysqlConfig['username'],
                    $mysqlConfig['password'],
                    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_TIMEOUT => 2]
                );
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$mysqlConfig['database']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            } catch (\Exception $e) {
                // MySQL is offline or connection failed
            }
        }

        // Determine active connection and fallback if mysql is configured default but offline
        $defaultConnection = config('database.default');
        if ($defaultConnection === 'mysql') {
            try {
                DB::connection('mysql')->getPdo();
            } catch (\Exception $e) {
                if (str_contains($e->getMessage(), 'actively refused it') || str_contains($e->getMessage(), 'Connection refused') || str_contains($e->getMessage(), 'No connection') || str_contains($e->getMessage(), 'Unknown database')) {
                    config(['database.default' => 'sqlite']);
                    $defaultConnection = 'sqlite';
                }
            }
        }

        // 3. Keep both active databases updated with migrations and seed data
        $connectionsToMigrate = ['sqlite'];
        if ($defaultConnection === 'mysql') {
            $connectionsToMigrate[] = 'mysql';
        } else {
            // Check if mysql is online to migrate it too
            try {
                DB::connection('mysql')->getPdo();
                $connectionsToMigrate[] = 'mysql';
            } catch (\Exception $e) {
                // mysql is offline
            }
        }

        foreach ($connectionsToMigrate as $conn) {
            try {
                // Always run migrate to catch new tables or new column migrations
                Artisan::call('migrate', [
                    '--database' => $conn,
                    '--force' => true
                ]);

                // Ensure seed data exists on this connection
                $userCount = DB::connection($conn)->table('users')->count();
                if ($userCount === 0) {
                    Artisan::call('db:seed', [
                        '--database' => $conn,
                        '--force' => true
                    ]);
                }
            } catch (\Exception $e) {
                // Silently skip if migration fails for this connection
            }
        }
    }
}