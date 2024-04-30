<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    protected $signature = 'shop:refresh';

    protected $description = 'Command description';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }
        Storage::deleteDirectory('products');
        Storage::deleteDirectory('brands');

        $this->call('module:migrate-fresh', [
            '--seed' => true,
        ]);

        return self::SUCCESS;
    }
}
