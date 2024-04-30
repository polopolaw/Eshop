<?php

declare(strict_types=1);

namespace src\Modules\Brand\database\factories;

use src\Modules\Brand\app\Models\Brand;
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
