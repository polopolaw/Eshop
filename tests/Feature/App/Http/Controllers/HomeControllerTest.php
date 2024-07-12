<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Database\Factories\Catalog\BrandFactory;
use Database\Factories\Catalog\CategoryFactory;
use Database\Factories\Catalog\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_response()
    {
        ProductFactory::new()->count(5)
            ->create([
                'on_homepage' => true,
                'sort' => 999
            ]);

        $product = ProductFactory::new()
            ->createOne([
                'on_homepage' => true,
                'sort' => 1
            ]);

        CategoryFactory::new()->count(5)
            ->create([
                'on_homepage' => true,
                'sort' => 999
            ]);

        $category = CategoryFactory::new()
            ->createOne([
                'on_homepage' => true,
                'sort' => 1
            ]);

        BrandFactory::new()->count(5)
            ->create([
                'on_homepage' => true,
                'sort' => 999
            ]);

        $brand = BrandFactory::new()
            ->createOne([
                'on_homepage' => true,
                'sort' => 1
            ]);

        $this->get(action(HomeController::class))
            ->assertOk()
            ->assertViewHas('categories.0', $category)
            ->assertViewHas('products.0', $product)
            ->assertViewHas('brands.0', $brand);
    }
}
