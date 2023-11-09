<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ControllerComanda;
use App\Http\Controllers\ControllerSabates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->post('/register', [AdminController::class, 'register']);

Route::get('/sabates', [ControllerSabates::class, 'getSabates']);
Route::post('/sabates', [ControllerSabates::class, 'createSabates']);
Route::post('/comanda', [ControllerComanda::class, 'createComanda']);
Route::post('/login', [AdminController::class, 'login']);

//Route::post('/register', [AdminController::class, 'register']);

Route::post('/logout', [AdminController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/comanda', [ControllerComanda::class, 'getComanda']);
   // Route::post('/logout', [AdminController::class, 'logout'])->name('logout');


});