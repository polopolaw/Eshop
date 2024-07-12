<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    public function __invoke(
        string $dir,
        string $method,
        string $size,
        string $image
    ): BinaryFileResponse {
        abort_if(
            !in_array($size, config('thumbnails.allowed_sizes'), true),
            403,
            __('Size not allowed')
        );
        $storage = Storage::disk('images');
        $date = now()->format('d-m-Y');
        $newDirPath = "$dir/$method/$size/$date";
        try {
            $resultPath = "$newDirPath/" . File::basename($image);

            if ($storage->exists($resultPath)) {
                return response()->file($storage->path($resultPath));
            }

            if (!$storage->exists($newDirPath)) {
                $storage->makeDirectory($newDirPath);
            }


            $manager = new ImageManager(new Driver());
            $image = $manager->read($storage->path($image));

            [$w, $h] = explode('x', $size);

            $image->{$method}((int)$w, (int)$h);

            $image->save($storage->path($resultPath));
        } catch (\Throwable $e) {
            logger()->error(__('Problem with create thumbnail: ' . $e->getMessage()));
            abort(404);
        }
        return response()->file($storage->path($resultPath));
    }
}
