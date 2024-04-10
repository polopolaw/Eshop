<?php

declare(strict_types=1);

namespace Ecom\Catalog\Database\Factories;

use Ecom\Brand\Models\Brand;
use Ecom\Catalog\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'thumbnail' => $this->faker->placeholdco('products', width: 500, height: 400),
            'price' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
