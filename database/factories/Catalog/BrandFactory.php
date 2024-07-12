<?php

declare(strict_types=1);

namespace Database\Factories\Catalog;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'thumbnail' => $this->faker->placeholdco('brand', width: 500, height: 400),
            'on_homepage' => $this->faker->boolean(),
            'sort' => $this->faker->numberBetween(0, 500),
        ];
    }
}
