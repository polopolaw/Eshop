<?php

declare(strict_types=1);

namespace src\Modules\Core\app\Traits\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            $model->makeSlug();
        });
    }

    protected function slugFrom(): string
    {
        return 'title';
    }

    protected function slugColumn(): string
    {
        return 'slug';
    }

    protected function makeSlug(): void
    {
        $originalSlug = $this->{$this->slugColumn()} ?: Str::slug($this->{$this->slugFrom()});
        $slug = $originalSlug;
        $version = 1;

        while ($this->isSlugExist($slug)) {
            $slug = $originalSlug . '-' . $version;
            $version++;
        }

        $this->{$this->slugColumn()} = $slug;
    }

    private function isSlugExist(string $slug): bool
    {
        return $this->newQuery()
            ->where($this->slugColumn(), $slug)
            ->where('id', '<>', $this->id)
            ->withoutGlobalScopes()
            ->exists();
    }
}
