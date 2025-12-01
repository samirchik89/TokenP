<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DatabaseBackupCommand extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Backup the database';

    public function handle()
    {
        $this->info('Starting database backup...');

        $filename = 'backup-' . Carbon::now()->format('Y-m-d-H-i-s') . '.sql';
        $storagePath = 'backups/' . $filename;

        // Get database credentials from config
        $host = config('database.connections.mysql.host');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        // Create backup directory if it doesn't exist
        if (!Storage::exists('backups')) {
            Storage::makeDirectory('backups');
        }

        // Create backup using mysqldump
        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg(storage_path('app/' . $storagePath))
        );

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info('Database backup completed successfully!');
            $this->info('Backup stored at: ' . storage_path('app/' . $storagePath));
        } else {
            $this->error('Database backup failed!');
        }
    }
}