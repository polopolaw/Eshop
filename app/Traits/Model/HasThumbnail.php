<?php

declare(strict_types=1);

namespace App\Traits\Model;

use ReflectionClass;

trait HasThumbnail
{
    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        return route('thumbnail', [
            'dir' => $this->thumbnailDir(),
            'method' => $method,
            'size' => $size,
            'image' => $this->{$this->thumbnailColumn()}
        ]);
    }

    protected function thumbnailDir(): string
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }
}
