<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\OptionFactory;
use Database\Factories\OptionValueFactory;
use Database\Factories\PropertyFactory;
use Domain\Catalog\Models\Category;
use Domain\Catalog\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = PropertyFactory::new()->count(10)->create();

        OptionFactory::new()->count(2)->create();
        $optionValues = OptionValueFactory::new()->count(10)->create();

        Category::factory(10)
            ->has(
                Product::factory(rand(5, 15))
                    ->hasAttached($optionValues)
                    ->hasAttached($properties, function () {
                        return ['value' => ucfirst(fake()->word)];
                    })
            )
            ->create();
    }
}
