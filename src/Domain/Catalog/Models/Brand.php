<?php

declare(strict_types=1);

namespace Domain\Catalog\Models;

use Database\Factories\Catalog\BrandFactory;
use Domain\Catalog\Builders\BrandQueryBuilder;
use Domain\Catalog\Events\Brand\BrandDeletingEvent;
use Domain\Catalog\Events\Brand\BrandSavingEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\Model\HasSlug;
use Support\Traits\Model\HasThumbnail;

/**
 * @method static BrandQueryBuilder query()
 */
class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $dispatchesEvents = [
        'saving' => BrandSavingEvent::class,
        'deleting' => BrandDeletingEvent::class,
    ];

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
