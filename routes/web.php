<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Livewire\Admin\Posts;
use App\Livewire\Anuncios\GerenciarAnuncios;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\PlanSubscriptionController;

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

    Route::get('/anuncios', GerenciarAnuncios::class)
        ->middleware('can:criar anuncios')
        ->name('anuncios.index');

    Route::get('/admin/plans', App\Livewire\Admin\Plans\ManagePlans::class)
        ->middleware('can:manage plans')
        ->name('admin.plans');

    // Rotas de assinatura de planos
    Route::get('/planos/{plan}/assinar', [PlanSubscriptionController::class, 'showSubscriptionForm'])
        ->name('plans.subscribe.form');
    Route::post('/planos/{plan}/assinar', [PlanSubscriptionController::class, 'subscribe'])
        ->name('plans.subscribe');
});

// Rotas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rotas de anúncios públicas
Route::get('/anuncios-disponiveis', [AnuncioController::class, 'index'])
    ->name('anuncios.disponiveis');

// Rotas de planos
Route::get('/planos', App\Livewire\Plans\ShowPlans::class)->name('plans.index');

// Dentro do grupo de rotas públicas
Route::get('/anuncios/{slug}', [AnuncioController::class, 'show'])->name('anuncios.show');
