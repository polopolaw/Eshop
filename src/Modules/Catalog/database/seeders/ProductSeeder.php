<?php

declare(strict_types=1);

namespace src\Modules\Catalog\database\seeders;

use src\Modules\Catalog\app\Models\Category\Category;
use src\Modules\Catalog\app\Models\Product\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(10)
            ->has(Product::factory(rand(5, 15)))
            ->create();
    }
}
