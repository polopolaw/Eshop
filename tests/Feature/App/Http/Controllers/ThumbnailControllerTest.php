<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use Database\Factories\Catalog\ProductFactory;
use Domain\Catalog\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ThumbnailControllerTest extends TestCase
{
    public function test_it_generated_success(): void
    {
        $size = '345x320';
        $method = 'resize';
        $storage = Storage::disk('images');

        config()->set('thumbnail', ['allowed_sizes' => [$size]]);

        /** @var Product $product */
        $product = ProductFactory::new()->create();

        $response = $this->get($product->makeThumbnail($size, $method));

        $response->assertOk();
        $date = now()->format('d-m-Y');
        $storage->assertExists(
            "product/$method/$size/$date/" . File::basename($product->thumbnail)
        );
    }
}
