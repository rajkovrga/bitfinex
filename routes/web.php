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
Route::get('/refresh/fav/{name}', [\App\Http\Controllers\MainController::class, 'refreshFav']);
Route::get('/refresh/{name}', [\App\Http\Controllers\FrontController::class, 'getOne']);
Route::get('/login', [\App\Http\Controllers\MainController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\MainController::class, 'logout']);

Route::middleware(['authMid'])->group( function () {
    Route::get('/fav', [\App\Http\Controllers\FrontController::class, 'favorite']);
    Route::get('/add/{name}', [\App\Http\Controllers\MainController::class, 'addFav']);
    Route::get('/remove/{name}', [\App\Http\Controllers\MainController::class, 'remove']);
});
