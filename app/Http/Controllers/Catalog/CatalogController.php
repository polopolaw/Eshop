<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Domain\Catalog\Models\Category;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Catalog\ViewModels\ProductViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function __invoke(?Category $category): View|Factory|Application
    {
        $categories = CategoryViewModel::make()
            ->catalog();

        $products = ProductViewModel::make()
            ->catalog($category);

        return view('catalog.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
        ]);
    }
}
