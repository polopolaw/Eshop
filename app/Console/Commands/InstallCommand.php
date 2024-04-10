<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (!$this->confirm('Are you sure? All data will be purged.')) {
            return self::SUCCESS;
        }
        $this->call('storage:link');
        $this->call('php artisan module:migrate-fresh --seed');
        return self::SUCCESS;
    }
}
