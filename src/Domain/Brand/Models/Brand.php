<?php

declare(strict_types=1);

namespace Domain\Brand\Models;

use App\Traits\Model\HasSlug;
use App\Traits\Model\HasThumbnail;
use Database\Factories\Brand\BrandFactory;
use Domain\Brand\Builders\BrandQueryBuilder;
use Domain\Catalog\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static BrandQueryBuilder query()
 */
class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    public function newEloquentBuilder($query): BrandQueryBuilder
    {
        return new BrandQueryBuilder($query);
    }

    protected static function newFactory(): BrandFactory
    {
        return BrandFactory::new();
    }

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
        'on_homepage',
        'sort',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
