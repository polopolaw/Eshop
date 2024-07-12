<?php

declare(strict_types=1);

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

class CategoryViewModel
{
    use Makeable;

    public function homePage()
    {
        return Cache::tags(['category'])->rememberForever('category_home_page', function () {
            return Category::query()
                ->homePage()
                ->get();
        });
    }

    public function catalog(): Collection|array
    {
        return Category::query()
            ->select(['id', 'slug', 'title'])
            ->has('products')
            ->get();
    }
}
