<?php

use App\Http\Controllers\MyPlaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [MyPlaceController::class, 'testRouteController']);
