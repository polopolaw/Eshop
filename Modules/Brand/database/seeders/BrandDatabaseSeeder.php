<?php

declare(strict_types=1);

namespace Ecom\Brand\Database\Seeders;

use Ecom\Brand\Models\Brand;
use Illuminate\Database\Seeder;

class BrandDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(20)->create();
    }
}
