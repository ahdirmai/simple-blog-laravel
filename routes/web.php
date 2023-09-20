<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return 'Masuk';
    })->name('dashboard');
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::POST('post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');


Route::get('post/{slug}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::PUT('post/{slug}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');

Route::get('post/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('post/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
