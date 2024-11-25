<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

//Registration
Route::get('/register', [AuthController::class, 'showRegistrationForm'])
    ->name('register.form');
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

//Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login.form');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::get('', fn() => to_route('blog.index'));
Route::resource('blog', BlogController::class)
    ->only(['index', 'show', 'create']);

Route::middleware('auth')->group(function () {
    Route::resource('blog', BlogController::class)
        ->only(['store', 'update', 'edit', 'destroy']);
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::post('/blogs/{blog}/categories', [BlogController::class, 'addCategories'])
        ->name('blog.categories.add');
    Route::delete('/blogs/{blog}/categories', [BlogController::class, 'removeCategories'])
        ->name('blog.categories.remove');
});
