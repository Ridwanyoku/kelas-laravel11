<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kas', [KasController::class, 'index']);
Route::post('/kas/update', [KasController::class, 'updateChecklist']);

