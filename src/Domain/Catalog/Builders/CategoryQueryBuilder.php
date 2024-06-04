<?php

declare(strict_types=1);

namespace Domain\Catalog\Builders;

use Illuminate\Database\Eloquent\Builder;

class CategoryQueryBuilder extends Builder
{
    public function homePage(): CategoryQueryBuilder
    {
        return $this->where('on_homepage', true)
            ->orderBy('sort')
            ->limit(6);
    }
}
