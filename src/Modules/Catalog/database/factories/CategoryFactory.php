<?php

declare(strict_types=1);

namespace src\Modules\Catalog\database\factories;

use src\Modules\Catalog\app\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
        ];
    }
}
