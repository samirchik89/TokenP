<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clear-all-tables {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all tables in the database (keeps migrations table)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $databaseName = config('database.connections.' . config('database.default') . '.database');

        // Safety confirmation unless --force flag is used
        if (!$this->option('force')) {
            $this->error('⚠️  WARNING: This will clear ALL data from ALL tables in database: ' . $databaseName);
            $this->line('This action cannot be undone!');

            if (!$this->confirm('Are you sure you want to continue?')) {
                $this->info('Operation cancelled.');
                return;
            }

            if (!$this->confirm('Are you REALLY sure? This will delete ALL your data!')) {
                $this->info('Operation cancelled.');
                return;
            }
        }

        $this->info('Starting to clear all tables...');

        try {
            // Get all table names
            $tables = $this->getAllTables();

            if (empty($tables)) {
                $this->info('No tables found in the database.');
                return;
            }

            $this->info('Found ' . count($tables) . ' tables');

            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $this->info('Foreign key checks disabled');

            $clearedCount = 0;
            $skippedTables = [];

            // Clear each table
            foreach ($tables as $table) {
                // Skip migrations table to preserve migration history
                if ($table === 'migrations') {
                    $skippedTables[] = $table;
                    continue;
                }

                try {
                    DB::table($table)->truncate();
                    $this->line("✓ Cleared table: {$table}");
                    $clearedCount++;
                } catch (\Exception $e) {
                    $this->error("✗ Failed to clear table {$table}: " . $e->getMessage());
                }
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->info('Foreign key checks re-enabled');

            // Summary
            $this->info('');
            $this->info("✅ Operation completed!");
            $this->info("Tables cleared: {$clearedCount}");

            if (!empty($skippedTables)) {
                $this->info("Tables skipped: " . implode(', ', $skippedTables));
            }

        } catch (\Exception $e) {
            // Make sure to re-enable foreign key checks in case of error
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            } catch (\Exception $fkException) {
                // Silent fail for foreign key re-enable
            }

            $this->error('An error occurred: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Get all table names from the database
     *
     * @return array
     */
    private function getAllTables()
    {
        $databaseName = config('database.connections.' . config('database.default') . '.database');

        // Get all table names for MySQL
        $tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?", [$databaseName]);

        return array_map(function($table) {
            return $table->TABLE_NAME;
        }, $tables);
    }
}