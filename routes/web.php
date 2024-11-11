<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//   return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [FormController::class, 'index'])->name('dashboard');
    Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('/forms', [FormController::class, 'store'])->name('forms.store');
    Route::get('/forms/{slug}/edit', [FormController::class, 'edit'])->name('forms.edit');
    Route::put('/forms/{slug}', [FormController::class, 'update'])->name('forms.update');
    Route::delete('/forms/{slug}', [FormController::class, 'destroy'])->name('forms.delete');
    Route::get('/forms/{slug}/responses', [FormController::class, 'showResponses'])->name('forms.showResponses');

    Route::get('/forms/{slug}/preview', [FormController::class, 'preview'])->name('forms.preview');
});

Route::get('/form/{slug}', [PublicFormController::class, 'show'])->name('forms.show');
Route::post('/form/{slug}/submit', [PublicFormController::class, 'store'])->name('form.submit');


require __DIR__ . '/auth.php';
