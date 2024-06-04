<?php

declare(strict_types=1);

namespace Domain\Catalog\Models\Product;

use App\Traits\Model\HasSlug;
use App\Traits\Model\HasThumbnail;
use Database\Factories\Catalog\ProductFactory;
use Domain\Brand\Models\Brand;
use Domain\Catalog\Builders\ProductQueryBuilder;
use Domain\Catalog\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static ProductQueryBuilder query()
 */
class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    public function newEloquentBuilder($query): ProductQueryBuilder
    {
        return new ProductQueryBuilder($query);
    }

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
        'on_homepage',
        'sort',
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
