<?php

declare(strict_types=1);

namespace Ecom\Catalog\Database\Seeders;

use Illuminate\Database\Seeder;

class CatalogDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
