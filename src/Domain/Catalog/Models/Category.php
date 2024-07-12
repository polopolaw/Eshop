<?php

declare(strict_types=1);

namespace Domain\Catalog\Models;

use Database\Factories\Catalog\CategoryFactory;
use Domain\Catalog\Builders\CategoryQueryBuilder;
use Domain\Catalog\Events\Category\BrandDeletingEvent;
use Domain\Catalog\Events\Category\BrandSavingEvent;
use Domain\Catalog\Events\Category\CategoryDeletingEvent;
use Domain\Catalog\Events\Category\CategorySavingEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Traits\Model\HasSlug;

/**
 * @method static Category|CategoryQueryBuilder query()
 * @property mixed $id
 */
class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $dispatchesEvents = [
        'saving' => CategorySavingEvent::class,
        'deleting' => CategoryDeletingEvent::class,
    ];

    public function newEloquentBuilder($query): CategoryQueryBuilder
    {
        return new CategoryQueryBuilder($query);
    }

    protected $fillable = [
        'title',
        'slug',
        'on_homepage',
        'sort',
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
