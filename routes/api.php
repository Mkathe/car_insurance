<?php

use App\Http\Controllers\Api\CarApiController;
use App\Http\Controllers\Api\OwnerApiController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarApiController::class, 'index']);
Route::get('/cars/{car}', [CarApiController::class, 'show']);
Route::post('/cars', [CarApiController::class, 'store']);
Route::put('/cars/{car}', [CarApiController::class, 'update']);
Route::patch('/cars/{car}', [CarApiController::class, 'update']);
Route::delete('/cars/{car}', [CarApiController::class, 'destroy']);


Route::delete('/car-photos/{photo}', [CarApiController::class, 'deletePhoto']);

Route::get('/owners', [OwnerApiController::class, 'index']);
Route::get('/owners/{owner}', [OwnerApiController::class, 'show']);
Route::post('/owners', [OwnerApiController::class, 'store']);
Route::put('/owners/{owner}', [OwnerApiController::class, 'update']);
Route::patch('/owners/{owner}', [OwnerApiController::class, 'update']);
Route::delete('/owners/{owner}', [OwnerApiController::class, 'destroy']);
