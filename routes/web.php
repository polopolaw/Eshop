<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    logger()
        ->channel('telegram')
        ->debug("he;;");
    return view('welcome');
});
