<?php

declare(strict_types=1);

namespace Domain\Catalog\Builders;

use Illuminate\Database\Eloquent\Builder;

class ProductQueryBuilder extends Builder
{
    public function homePage(): ProductQueryBuilder
    {
        return $this->where('on_homepage', true)
            ->orderBy('sort')
            ->limit(6);
    }
}
