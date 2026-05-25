<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSyncService
{
    protected $tables = [
        'users',
        'categories',
        'products',
        'discounts',
        'carts',
        'orders',
        'order_items',
        'system_settings',
    ];

    /**
     * Get row counts for both databases.
     */
    public function getIntegrityReport()
    {
        $report = [];

        foreach ($this->tables as $table) {
            $mysqlCount = DB::connection('mysql')->table($table)->count();
            
            // Check if table exists in SQLite
            if (Schema::connection('sqlite')->hasTable($table)) {
                $sqliteCount = DB::connection('sqlite')->table($table)->count();
            } else {
                $sqliteCount = -1; // Indicates table doesn't exist
            }

            $report[] = [
                'table' => $table,
                'mysql' => $mysqlCount,
                'sqlite' => $sqliteCount,
                'status' => ($mysqlCount === $sqliteCount) ? 'Match' : 'Mismatch'
            ];
        }

        return $report;
    }

    /**
     * Synchronize data from source to target.
     */
    public function sync(string $source, string $target)
    {
        // Disable foreign keys for SQLite if it's the target
        if ($target === 'sqlite') {
            DB::connection($target)->statement('PRAGMA foreign_keys = OFF;');
        } else {
            DB::connection($target)->statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        foreach ($this->tables as $table) {
            // First, make sure the table exists in target by running migrations if needed
            // But for simplicity, we assume schema is present or we truncate and re-insert
            
            // Truncate target table
            DB::connection($target)->table($table)->truncate();

            // Get data from source
            $data = DB::connection($source)->table($table)->get()->map(function ($row) {
                return (array) $row;
            })->toArray();

            // Bulk insert into target
            if (!empty($data)) {
                // Chunk to avoid memory/SQL length issues
                foreach (array_chunk($data, 100) as $chunk) {
                    DB::connection($target)->table($table)->insert($chunk);
                }
            }
        }

        // Re-enable foreign keys
        if ($target === 'sqlite') {
            DB::connection($target)->statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::connection($target)->statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        return true;
    }

    /**
     * Run migrations on the SQLite database if table doesn't exist.
     */
    public function ensureSchema()
    {
        \Illuminate\Support\Facades\Artisan::call('migrate', [
            '--database' => 'sqlite',
            '--force' => true,
        ]);
    }
}
