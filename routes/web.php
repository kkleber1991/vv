<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Livewire\Admin\Posts;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rotas do Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Rotas administrativas
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/admin/posts', Posts::class)
        ->middleware('can:criar posts')
        ->name('admin.posts');
});
