<?php

declare(strict_types=1);

namespace src\Modules\Catalog\database\seeders;

use Illuminate\Database\Seeder;
use src\Modules\Catalog\database\seeders\ProductSeeder;

class CatalogDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
