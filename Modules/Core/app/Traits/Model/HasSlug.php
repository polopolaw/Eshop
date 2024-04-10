<?php

declare(strict_types=1);

namespace Ecom\Core\Traits\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            $model->slug = self::getUniqueSlug($model);
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }

    private static function getUniqueSlug(Model $model)
    {
        $slug = $model->slug ?: Str::slug($model->{self::slugFrom()});
        $slugPattern = '/(_\d+)?$/';
        $version = 1;

        while ($model::where('slug', $slug)->where('id', '<>', $model->id)->exists()) {
            $slug = preg_replace_callback($slugPattern, function ($matches) use (&$version) {
                return sprintf('_%d', $version++);
            }, $slug, 1);
        }

        return $slug;
    }
}
