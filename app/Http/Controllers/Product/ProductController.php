<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Domain\Catalog\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __invoke(Product $product): View|Factory|Application
    {
        $product->load(['optionValues.option']);

        $alsos = session()->has('also') ? Product::query()
            ->whereIn('id', session()->get('also'))
            ->whereNot('id', $product->id)
            ->get() : [];

        $options = $product->optionValues->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });

        session()->put('also.' . $product->id, $product->id);

        return view('product.show', [
            'product' => $product,
            'options' => $options,
            'alsos' => $alsos
        ]);
    }
}
