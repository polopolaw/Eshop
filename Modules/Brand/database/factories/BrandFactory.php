<?php

declare(strict_types=1);

namespace Ecom\Brand\Database\Factories;

use Ecom\Brand\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'thumbnail' => $this->faker->placeholdco('brands', width: 500, height: 400),
        ];
    }
}
