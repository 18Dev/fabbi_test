<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('index'))->name('index');

Route::post('/step-1', [DishesController::class, 'stepOne'])->name('step-1');
Route::post('/step-2', [DishesController::class, 'stepTwo'])->name('step-2');
Route::post('/step-3', [DishesController::class, 'stepThree'])->name('step-3');

// Step preview (test)
Route::post('/step-4', fn() => dd('step preview'))->name('step-4');

