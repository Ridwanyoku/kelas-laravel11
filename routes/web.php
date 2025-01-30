<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\LoginController;

// Rute login
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Proteksi halaman web dengan middleware
Route::middleware(['auth.single'])->group(function () {
    Route::resource('students', StudentController::class);
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::post('students/checklist', [StudentController::class, 'updateChecklist'])->name('students.checklist');

    Route::post('/checklists/update', [ChecklistController::class, 'update'])->name('checklists.update');

    Route::post('/years/store', [YearController::class, 'store'])->name('years.store');
    Route::post('/years/destroy', [YearController::class, 'destroy'])->name('years.destroy');

    Route::post('/reset-total-cash', [ChecklistController::class, 'resetTotalCash'])->name('reset.totalCash');

    
});
