<?php

declare(strict_types=1);

namespace src\Modules\Catalog\app\Models\Product;

use src\Modules\Brand\app\Models\Brand;
use src\Modules\Catalog\database\factories\ProductFactory;
use src\Modules\Catalog\app\Models\Category\Category;
use src\Modules\Core\app\Traits\Model\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'price',
        'thumbnail',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
