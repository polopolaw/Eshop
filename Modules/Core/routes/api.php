<?php

declare(strict_types=1);

use Ecom\Core\Http\Controllers\CoreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('core', CoreController::class)->names('core');
});
