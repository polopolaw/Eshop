<?php

declare(strict_types=1);

namespace Domain\Catalog\Events\Brand;

use Domain\Catalog\Models\Brand;

class BrandDeletingEvent
{
    public Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
}
