<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\FrontController::class, 'home']);
Route::get('/details', [\App\Http\Controllers\FrontController::class, 'details']);
Route::get('/refresh', [\App\Http\Controllers\MainController::class, 'refresh']);

Route::middleware(['authMid'])->group( function () {
    Route::get('/favorites', [\App\Http\Controllers\FrontController::class, 'favorites']);
});
