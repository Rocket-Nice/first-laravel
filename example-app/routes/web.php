<?php

use App\Http\Controllers\MyPlaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Получение по viev
Route::get('/', function () {
    return view('welcome');
});

// Получение по определенному контроллеру функции
Route::get('/test', [MyPlaceController::class, 'testRouteController']);


//** POST */

// ПОлучение по прямому индексу
Route::resource('posts', PostController::class);

// Получение по юрл и функции
Route::get('/posts/create/test', [PostController::class, 'createSecond'])
    ->name('posts.create-test');
    
Route::get('/posts/update/test', [PostController::class, 'updateSecond'])
    ->name('posts.update-test');

Route::get('/posts/delete/test', [PostController::class, 'deleteSecond'])
    ->name('posts.delete-test');