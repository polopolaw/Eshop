<?php

declare(strict_types=1);

namespace Domain\Catalog\Builders;

use Illuminate\Database\Eloquent\Builder;

class BrandQueryBuilder extends Builder
{
    public function homePage(): BrandQueryBuilder
    {
        return $this->select(['id', 'title', 'slug', 'thumbnail'])
            ->where('on_homepage', true)
            ->orderBy('sort')
            ->limit(6);
    }
}
