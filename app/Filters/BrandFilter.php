<?php

declare(strict_types=1);

namespace App\Filters;

use Domain\Catalog\Filters\AbstractFilter;
use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Builder;

class BrandFilter extends AbstractFilter
{

    public function title(): string
    {
        return __('Brands');
    }

    public function key(): string
    {
        return 'brands';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $q) {
            $q->whereIn('brand_id', $this->requestValue());
        });
    }

    public function values(): array
    {
        return Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get()
            ->pluck('id', 'title')
            ->toArray();
    }

    public function view(): string
    {
        return 'catalog.filters.brands';
    }
}
