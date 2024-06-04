<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Brand\Models\Brand;
use Domain\Catalog\Models\Category\Category;
use Domain\Catalog\Models\Product\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()
            ->homePage()
            ->get();

        $products = Product::query()
            ->homePage()
            ->get();

        $brands = Brand::query()
            ->homePage()
            ->get();

        return view(
            'index',
            compact('categories', 'products', 'brands')
        );
    }
}
