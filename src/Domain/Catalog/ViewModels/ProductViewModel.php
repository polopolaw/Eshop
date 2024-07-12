<?php

declare(strict_types=1);

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Models\Category;
use Domain\Catalog\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class ProductViewModel
{
    use Makeable;

    public function catalog(?Category $category): LengthAwarePaginator
    {
        return Product::query()
            ->select(['id', 'title', 'slug', 'thumbnail', 'price'])
            ->when(request('s'), static function (Builder $q) {
                $q->whereFullText(['title', 'text'], request('s'));
            })
            ->when($category?->exists, function (Builder $q) use ($category) {
                $q->whereRelation('categories', 'categories.id', '=', $category->id);
            })
            ->filtered()
            ->sorted()
            ->paginate(6);
    }
}
