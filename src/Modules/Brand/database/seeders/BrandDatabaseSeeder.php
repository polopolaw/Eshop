<?php

declare(strict_types=1);

namespace src\Modules\Brand\database\seeders;

use src\Modules\Brand\app\Models\Brand;
use Illuminate\Database\Seeder;

class BrandDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(20)->create();
    }
}
