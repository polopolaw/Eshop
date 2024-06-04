<?php

declare(strict_types=1);

namespace Database\Factories\Catalog;

use Domain\Catalog\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'on_homepage' => $this->faker->boolean(),
            'sort' => $this->faker->numberBetween(0, 500),
        ];
    }
}
