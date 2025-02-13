<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Support\EstadosCidades;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cidades/{estado}', function ($estado) {
    return response()->json(EstadosCidades::getCidades($estado));
});
