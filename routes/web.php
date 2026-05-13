<?php

use App\Http\Controllers\Api\CarApiController;
use App\Http\Controllers\Api\OwnerApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('cars.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::resource('cars', CarController::class)->except(['index', 'show']);
    Route::resource('owners', OwnerController::class)->except(['index', 'show']);
    Route::delete('/car-photos/{id}', [CarController::class, 'deletePhoto'])
        ->name('cars.photos.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('cars', CarController::class)->only(['index', 'show']);
    Route::resource('owners', OwnerController::class)->only(['index', 'show']);
});

Route::get('language/{locale}', [LangController::class, 'setLocale'])->name('setLocale');



require __DIR__.'/auth.php';
