<?php

declare(strict_types=1);

namespace Database\Factories\Catalog;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Product;
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
            'thumbnail' => $this->faker->placeholdco('product', width: 500, height: 400),
            'text' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(10000, 1000000),
            'on_homepage' => $this->faker->boolean(),
            'sort' => $this->faker->numberBetween(0, 500),
        ];
    }
}
