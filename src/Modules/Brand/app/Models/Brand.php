<?php

declare(strict_types=1);

namespace src\Modules\Brand\app\Models;

use src\Modules\Brand\database\factories\BrandFactory;
use src\Modules\Catalog\app\Models\Product\Product;
use src\Modules\Core\app\Traits\Model\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    use HasSlug;

    protected static function newFactory(): BrandFactory
    {
        return BrandFactory::new();
    }

    protected $fillable = [
        'slug',
        'title',
        'thumbnail',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
