<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CreateDemoUser;
use Exception;

class CreateDemoUserCommand extends Command
{
    protected $signature = 'demo:create-user {--count=1 : Number of demo user pairs to create}';

    protected $description = 'Create demo users (investor and issuer pair)';

    protected $createDemoUserService;

    public function __construct(CreateDemoUser $createDemoUserService)
    {
        parent::__construct();
        $this->createDemoUserService = $createDemoUserService;
    }

    public function handle()
    {
        $count = (int) $this->option('count');

        if ($count < 1) {
            $this->error('Count must be at least 1');
            return 1;
        }

        $this->info("Creating {$count} demo user pair(s)...");

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        $createdUsers = [];

        try {
            for ($i = 0; $i < $count; $i++) {
                $userPair = $this->createDemoUserService->createSingle();
                $createdUsers[] = $userPair;
                $bar->advance();
            }

            $bar->finish();
            $this->line('');

            $this->info('Demo users created successfully!');

            // Display created users information
            $this->displayCreatedUsers($createdUsers);

            return 0;

        } catch (Exception $e) {
            $bar->finish();
            $this->line('');

            $this->error('Failed to create demo users: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Display information about created users
     *
     * @param array $createdUsers
     * @return void
     */
    private function displayCreatedUsers($createdUsers)
    {
        $this->info('Created Users:');
        $this->line('');

        foreach ($createdUsers as $index => $userPair) {
            $pairNumber = $index + 1;

            $investorLastName = $userPair['investor']->identity->last_name ?? 'N/A';
            $issuerLastName = $userPair['issuer']->identity->last_name ?? 'N/A';

            $this->line("Pair {$pairNumber}:");
            $this->line("  Investor: {$userPair['investor']->name} {$investorLastName} ({$userPair['investor']->email})");
            $this->line("  Issuer: {$userPair['issuer']->name} {$issuerLastName} ({$userPair['issuer']->email})");
            $this->line('');
        }

        $this->info('Password for all users: ' . config('app.demo_password', 'password123'));
    }
}