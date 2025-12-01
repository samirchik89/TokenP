<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    /**
     * Create a database backup
     */
    public function backup()
    {
        $filename = 'backup-' . Carbon::now()->format('Y-m-d-H-i-s') . '.sql';
        $storagePath = 'backups/' . $filename;

        // Get database configuration
        $config = $this->getDatabaseConfig();

        // Create backup directory if it doesn't exist
        if (!Storage::exists('backups')) {
            Storage::makeDirectory('backups');
        }

        // Create backup using mysqldump
        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s --single-transaction --routines --triggers %s > %s',
            escapeshellarg($config['host']),
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['database']),
            escapeshellarg(storage_path('app/' . $storagePath))
        );

        Log::info('Database backup initiated', [
            'filename' => $filename,
            'database' => $config['database'],
            'host' => $config['host']
        ]);

        exec($command, $output, $returnVar);

        Log::info('Database backup result:', [
            'return_code' => $returnVar,
            'output' => $output,
            'file_path' => storage_path('app/' . $storagePath),
            'file_exists' => file_exists(storage_path('app/' . $storagePath))
        ]);

        if ($returnVar !== 0) {
            Log::error('Database backup failed', [
                'return_code' => $returnVar,
                'output' => $output
            ]);

            return redirect()->back()->with('error', 'Database backup failed. Check logs for details.');
        }

        if (!file_exists(storage_path('app/' . $storagePath))) {
            Log::error('Database backup file not created', [
                'expected_path' => storage_path('app/' . $storagePath)
            ]);

            return redirect()->back()->with('error', 'Database backup file was not created.');
        }

        $fileSize = filesize(storage_path('app/' . $storagePath));
        Log::info('Database backup completed successfully', [
            'file_size' => $fileSize,
            'file_size_mb' => round($fileSize / 1024 / 1024, 2)
        ]);

        return response()->download(storage_path('app/' . $storagePath))->deleteFileAfterSend();
    }

    /**
     * Show the import form
     */
    public function showImport()
    {
        return view('admin.database.import');
    }

    /**
     * Import a database file
     */
    public function import(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|file|mimetypes:text/plain,application/sql,application/x-sql|max:51200', // Max 50MB
        ]);

        // Convert checkbox values to boolean
        $truncateFirst = $request->has('truncate_first') && $request->input('truncate_first') === 'on';
        $disableConstraints = !$request->has('disable_constraints') || ($request->has('disable_constraints') && $request->input('disable_constraints') === 'on');

        if (!$request->hasFile('sql_file')) {
            return redirect()->back()->with('error', 'No file uploaded');
        }

        $file = $request->file('sql_file');
        $filename = 'import-' . Carbon::now()->format('Y-m-d-H-i-s') . '.sql';

        // Store uploaded file
        $filePath = $this->storeUploadedFile($file, $filename);
        if (!$filePath) {
            return redirect()->back()->with('error', 'File upload failed. Please try again.');
        }

        try {
            // Get database configuration
            $config = $this->getDatabaseConfig();

            // Test database connection
            if (!$this->testDatabaseConnection($config)) {
                Storage::delete($filePath);
                return redirect()->back()->with('error', 'Database connection failed. Check credentials and try again.');
            }

            // Truncate database if requested
            if ($truncateFirst) {
                Log::info('Truncating database before import');

                $truncateSuccess = $this->truncateDatabase($config);
                if (!$truncateSuccess) {
                    Storage::delete($filePath);
                    return redirect()->back()->with('error', 'Database truncate failed. Check logs for details.');
                }
            }

            // Perform the import
            $importSuccess = $this->performImport($config, $filePath, $disableConstraints);

            // Clean up the imported file
            Storage::delete($filePath);

            if ($importSuccess) {
                Log::info('Database import completed successfully');
                return redirect()->back()->with('success', 'Database imported successfully');
            } else {
                return redirect()->back()->with('error', 'Database import failed. Check logs for details.');
            }

        } catch (\Exception $e) {
            Log::error('Database import exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Clean up the imported file
            if (isset($filePath)) {
                Storage::delete($filePath);
            }

            return redirect()->back()->with('error', 'Database import failed: ' . $e->getMessage());
        }
    }

    /**
     * Export database in various formats
     */
    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:sql,csv,json',
            'tables' => 'nullable|array',
            'tables.*' => 'string'
        ]);

        $format = $request->input('format');
        $tables = $request->input('tables');
        $filename = 'export-' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $format;
        $storagePath = 'exports/' . $filename;

        // Create exports directory if it doesn't exist
        if (!Storage::exists('exports')) {
            Storage::makeDirectory('exports');
        }

        // Get database configuration
        $config = $this->getDatabaseConfig();

        switch ($format) {
            case 'sql':
                return $this->exportSql($config, $storagePath, $tables);

            case 'csv':
                return $this->exportCsv($config, $storagePath, $tables);

            case 'json':
                return $this->exportJson($storagePath, $tables);
        }
    }

    /**
     * Get database configuration
     */
    private function getDatabaseConfig()
    {
        return [
            'host' => config('database.connections.mysql.host'),
            'database' => config('database.connections.mysql.database'),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
        ];
    }

    /**
     * Store uploaded file securely
     */
    private function storeUploadedFile($file, $filename)
    {
        // Create imports directory if it doesn't exist
        if (!Storage::exists('imports')) {
            Storage::makeDirectory('imports');
        }

        // Check if storage directory is writable
        $storagePath = storage_path('app/imports');
        if (!is_writable($storagePath)) {
            Log::error('Storage directory not writable', [
                'path' => $storagePath,
                'permissions' => substr(sprintf('%o', fileperms($storagePath)), -4)
            ]);
            return false;
        }

        $path = $file->storeAs('imports', $filename);

        // Fallback: if Laravel storage fails, try direct file storage
        if (!Storage::exists($path)) {
            $directPath = storage_path('app/imports/' . $filename);
            $file->move(dirname($directPath), $filename);
            $path = 'imports/' . $filename;

            Log::info('Used fallback file storage method', [
                'direct_path' => $directPath,
                'new_path' => $path
            ]);
        }

        // Verify file was stored properly
        $actualFilePath = Storage::path($path);
        if (!Storage::exists($path) || !file_exists($actualFilePath)) {
            Log::error('File storage failed', [
                'original_name' => $file->getClientOriginalName(),
                'attempted_path' => $path,
                'actual_file_path' => $actualFilePath,
                'storage_exists' => Storage::exists($path),
                'file_exists' => file_exists($actualFilePath)
            ]);
            return false;
        }

        Log::info('File stored successfully', [
            'original_name' => $file->getClientOriginalName(),
            'stored_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType()
        ]);

        return $path;
    }

    /**
     * Test database connection
     */
    private function testDatabaseConnection($config)
    {
        $testCommand = sprintf(
            'mysql --host=%s --user=%s --password=%s %s -e "SELECT 1;" 2>&1',
            escapeshellarg($config['host']),
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['database'])
        );

        exec($testCommand, $testOutput, $testReturnVar);

        Log::info('Database connection test:', [
            'return_code' => $testReturnVar,
            'output' => $testOutput
        ]);

        return $testReturnVar === 0;
    }

    /**
     * Truncate database using Laravel's database methods (more reliable)
     */
    private function truncateDatabase($config)
    {
        try {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Get all table names using Laravel
            $tables = DB::select('SHOW TABLES');
            $databaseName = $config['database'];
            $tableKey = "Tables_in_{$databaseName}";

            Log::info('Tables found for truncation:', [
                'table_key' => $tableKey,
                'total_tables' => count($tables)
            ]);

            $truncatedTables = [];
            $skippedTables = ['migrations', 'failed_jobs', 'password_resets', 'personal_access_tokens'];

            foreach ($tables as $table) {
                $tableName = $table->$tableKey;

                if (!in_array($tableName, $skippedTables)) {
                    try {
                        DB::statement("TRUNCATE TABLE `{$tableName}`");
                        $truncatedTables[] = $tableName;
                        Log::debug("Successfully truncated table: {$tableName}");
                    } catch (\Exception $e) {
                        Log::warning("Failed to truncate table: {$tableName}", [
                            'error' => $e->getMessage()
                        ]);

                        // Try DELETE as fallback
                        try {
                            DB::statement("DELETE FROM `{$tableName}`");
                            $truncatedTables[] = $tableName . ' (using DELETE)';
                            Log::debug("Successfully deleted from table: {$tableName}");
                        } catch (\Exception $deleteError) {
                            Log::error("Failed to delete from table: {$tableName}", [
                                'truncate_error' => $e->getMessage(),
                                'delete_error' => $deleteError->getMessage()
                            ]);
                        }
                    }
                } else {
                    Log::debug("Skipped system table: {$tableName}");
                }
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            Log::info('Truncation completed', [
                'truncated_tables' => $truncatedTables,
                'total_truncated' => count($truncatedTables)
            ]);

            return true;

        } catch (\Exception $e) {
            // Re-enable foreign key checks in case of error
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            } catch (\Exception $nested) {
                Log::error('Failed to re-enable foreign key checks', [
                    'error' => $nested->getMessage()
                ]);
            }

            Log::error('Truncation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return false;
        }
    }

    /**
     * Perform database import
     */
    private function performImport($config, $filePath, $disableConstraints)
    {
        $actualFilePath = Storage::path($filePath);

        // Disable foreign key checks if requested
        if ($disableConstraints) {
            $disableCommand = sprintf(
                'mysql --host=%s --user=%s --password=%s %s -e "SET FOREIGN_KEY_CHECKS=0;" 2>&1',
                escapeshellarg($config['host']),
                escapeshellarg($config['username']),
                escapeshellarg($config['password']),
                escapeshellarg($config['database'])
            );

            exec($disableCommand, $disableOutput, $disableReturnVar);

            Log::info('Disable constraints result:', [
                'return_code' => $disableReturnVar,
                'output' => $disableOutput
            ]);
        }

        // Import using mysql command
        $command = sprintf(
            'mysql --host=%s --user=%s --password=%s %s --force < %s 2>&1',
            escapeshellarg($config['host']),
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['database']),
            escapeshellarg($actualFilePath)
        );

        Log::info('Database import command initiated');

        exec($command, $output, $returnVar);

        // Re-enable foreign key checks if they were disabled
        if ($disableConstraints) {
            $enableCommand = sprintf(
                'mysql --host=%s --user=%s --password=%s %s -e "SET FOREIGN_KEY_CHECKS=1;" 2>&1',
                escapeshellarg($config['host']),
                escapeshellarg($config['username']),
                escapeshellarg($config['password']),
                escapeshellarg($config['database'])
            );

            exec($enableCommand, $enableOutput, $enableReturnVar);

            Log::info('Re-enable constraints result:', [
                'return_code' => $enableReturnVar,
                'output' => $enableOutput
            ]);
        }

        Log::info('Database import result:', [
            'return_code' => $returnVar,
            'output_lines' => count($output),
            'has_errors' => $returnVar !== 0
        ]);

        if ($returnVar !== 0) {
            $errorMessage = $this->parseImportError($returnVar, $output);

            Log::error('Database import failed', [
                'return_code' => $returnVar,
                'output' => $output,
                'error_message' => $errorMessage
            ]);

            return false;
        }

        return true;
    }

    /**
     * Parse import error messages
     */
    private function parseImportError($returnVar, $output)
    {
        $outputString = implode(' ', $output);

        if (strpos($outputString, 'ERROR 1050 (42S01)') !== false) {
            return 'Database import failed: Some tables already exist. Consider truncating first.';
        } elseif (strpos($outputString, 'Access denied') !== false) {
            return 'Database import failed: Access denied. Check database credentials.';
        } elseif (strpos($outputString, 'Connection refused') !== false) {
            return 'Database import failed: Cannot connect to database server.';
        } elseif (strpos($outputString, 'Unknown database') !== false) {
            return 'Database import failed: Database does not exist.';
        } else {
            // Provide specific error messages based on return code
            switch ($returnVar) {
                case 1:
                    return 'Database import failed: General SQL error';
                case 2:
                    return 'Database import failed: Command line syntax error';
                case 3:
                    return 'Database import failed: Access denied';
                case 4:
                    return 'Database import failed: Connection error';
                case 5:
                    return 'Database import failed: SQL syntax error in file';
                default:
                    return 'Database import failed: Unknown error (code ' . $returnVar . ')';
            }
        }
    }

    /**
     * Export database as SQL
     */
    private function exportSql($config, $storagePath, $tables)
    {
        $tablesStr = $tables ? implode(' ', array_map('escapeshellarg', $tables)) : '';
        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s --single-transaction --routines --triggers %s %s > %s',
            escapeshellarg($config['host']),
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['database']),
            $tablesStr,
            escapeshellarg(storage_path('app/' . $storagePath))
        );

        return $this->executeExportCommand($command, $storagePath, 'SQL');
    }

    /**
     * Export database as CSV
     */
    private function exportCsv($config, $storagePath, $tables)
    {
        if (empty($tables)) {
            return redirect()->back()->with('error', 'Tables must be specified for CSV export');
        }

        // For CSV, we'll create a ZIP file with multiple CSV files
        $zipPath = str_replace('.csv', '.zip', $storagePath);
        $tempDir = storage_path('app/temp_csv_' . time());

        if (!mkdir($tempDir, 0755, true)) {
            return redirect()->back()->with('error', 'Failed to create temporary directory for CSV export');
        }

        try {
            foreach ($tables as $table) {
                $csvFile = $tempDir . '/' . $table . '.csv';
                $query = sprintf(
                    "SELECT * FROM %s INTO OUTFILE '%s' FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'",
                    $table,
                    $csvFile
                );

                $command = sprintf(
                    'mysql --host=%s --user=%s --password=%s %s -e "%s"',
                    escapeshellarg($config['host']),
                    escapeshellarg($config['username']),
                    escapeshellarg($config['password']),
                    escapeshellarg($config['database']),
                    $query
                );

                exec($command, $output, $returnVar);
                if ($returnVar !== 0) {
                    Log::warning("Failed to export table {$table} to CSV", [
                        'return_code' => $returnVar,
                        'output' => $output
                    ]);
                }
            }

            // Create ZIP file
            $zip = new \ZipArchive();
            if ($zip->open(storage_path('app/' . $zipPath), \ZipArchive::CREATE) === TRUE) {
                $files = glob($tempDir . '/*.csv');
                foreach ($files as $file) {
                    $zip->addFile($file, basename($file));
                }
                $zip->close();

                // Clean up temp directory
                array_map('unlink', glob($tempDir . '/*'));
                rmdir($tempDir);

                Log::info('CSV export completed successfully');
                return response()->download(storage_path('app/' . $zipPath))->deleteFileAfterSend();
            } else {
                throw new \Exception('Failed to create ZIP file for CSV export');
            }

        } catch (\Exception $e) {
            // Clean up temp directory on error
            if (is_dir($tempDir)) {
                array_map('unlink', glob($tempDir . '/*'));
                rmdir($tempDir);
            }

            Log::error('CSV export failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'CSV export failed: ' . $e->getMessage());
        }
    }

    /**
     * Export database as JSON
     */
    private function exportJson($storagePath, $tables)
    {
        if (empty($tables)) {
            return redirect()->back()->with('error', 'Tables must be specified for JSON export');
        }

        try {
            $data = [];
            foreach ($tables as $table) {
                $data[$table] = DB::table($table)->get()->toArray();
            }

            Storage::put($storagePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            Log::info('JSON export completed successfully', [
                'tables_exported' => count($tables),
                'file_size' => Storage::size($storagePath)
            ]);

            return response()->download(storage_path('app/' . $storagePath))->deleteFileAfterSend();

        } catch (\Exception $e) {
            Log::error('JSON export failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'JSON export failed: ' . $e->getMessage());
        }
    }

    /**
     * Execute export command and handle response
     */
    private function executeExportCommand($command, $storagePath, $format)
    {
        Log::info("{$format} export initiated");

        exec($command, $output, $returnVar);

        Log::info("{$format} export result:", [
            'return_code' => $returnVar,
            'output' => $output,
            'file_path' => storage_path('app/' . $storagePath),
            'file_exists' => file_exists(storage_path('app/' . $storagePath))
        ]);

        if ($returnVar !== 0) {
            Log::error("{$format} export failed", [
                'return_code' => $returnVar,
                'output' => $output
            ]);

            return redirect()->back()->with('error', "{$format} export failed. Check logs for details.");
        }

        if (!file_exists(storage_path('app/' . $storagePath))) {
            Log::error("{$format} export file not created", [
                'expected_path' => storage_path('app/' . $storagePath)
            ]);

            return redirect()->back()->with('error', "{$format} export file was not created.");
        }

        $fileSize = filesize(storage_path('app/' . $storagePath));
        Log::info("{$format} export completed successfully", [
            'file_size' => $fileSize,
            'file_size_mb' => round($fileSize / 1024 / 1024, 2)
        ]);

        return response()->download(storage_path('app/' . $storagePath))->deleteFileAfterSend();
    }
}