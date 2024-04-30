<?php

declare(strict_types=1);

namespace src\Modules\Catalog\app\Models\Category;

use src\Modules\Catalog\database\factories\CategoryFactory;
use src\Modules\Catalog\app\Models\Product\Product;
use src\Modules\Core\app\Traits\Model\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
