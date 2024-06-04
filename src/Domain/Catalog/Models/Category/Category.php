<?php

declare(strict_types=1);

namespace Domain\Catalog\Models\Category;

use App\Traits\Model\HasSlug;
use Database\Factories\Catalog\CategoryFactory;
use Domain\Catalog\Builders\CategoryQueryBuilder;
use Domain\Catalog\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static CategoryQueryBuilder query()
 */
class Category extends Model
{
    use HasFactory;
    use HasSlug;

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
