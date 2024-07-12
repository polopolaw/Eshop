<?php

declare(strict_types=1);

namespace App\Filters;

use Domain\Catalog\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\ValueObjects\Price;

class PriceFilter extends AbstractFilter
{

    public function title(): string
    {
        return __('Price');
    }

    public function key(): string
    {
        return 'price';
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereBetween('price', [
            Price::make((int)$this->requestValue('from', 0), precision: 1)->raw(),
            Price::make((int)$this->requestValue('to', 100000000), precision: 1)->raw()
        ]);
    }

    public function values(): array
    {
        return [
            'from' => 0,
            'to' => 10000000
        ];
    }

    public function view(): string
    {
        return 'catalog.filters.price';
    }
}
