<?php

declare(strict_types=1);

use Ecom\Core\Http\Controllers\CoreController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::resource('core', CoreController::class)->names('core');
});
