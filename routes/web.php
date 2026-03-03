<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('owners.index');
});

Route::resource('owners', OwnerController::class);
Route::resource('cars', CarController::class);
