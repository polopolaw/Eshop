<?php

declare(strict_types=1);

namespace Domain\Catalog\Events\Category;

use Domain\Catalog\Models\Category;

class CategoryDeletingEvent
{
    public Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}
