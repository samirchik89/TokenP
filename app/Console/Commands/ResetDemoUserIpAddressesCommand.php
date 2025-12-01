<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DemoUserAutoFillService;

class ResetDemoUserIpAddressesCommand extends Command
{
    protected $signature = 'demo:reset-ip-addresses';

    protected $description = 'Reset IP addresses for demo users to allow re-use';

    protected $demoUserService;

    public function __construct(DemoUserAutoFillService $demoUserService)
    {
        parent::__construct();
        $this->demoUserService = $demoUserService;
    }

    public function handle()
    {
        if (!config('app.is_demo', false)) {
            $this->error('This command only works in demo mode.');
            return 1;
        }

        $this->info('Resetting IP addresses for demo users...');

        $this->demoUserService->resetDemoUserIpAddresses();

        $counts = $this->demoUserService->getAvailableDemoUsersCount();

        $this->info('Demo user IP addresses reset successfully!');
        $this->info("Available demo users: {$counts['investors']} investors, {$counts['issuers']} issuers");

        return 0;
    }
}