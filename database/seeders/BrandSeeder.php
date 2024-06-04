<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Brand\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(20)->create();
    }
}
