<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\StudentController;

Route::resource('students', StudentController::class);
Route::get('students', [StudentController::class, 'index'])->name('students.index');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/kas', function () {
    return view('kas');
});
