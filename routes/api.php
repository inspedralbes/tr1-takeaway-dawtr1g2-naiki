<?php

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

Route::get('/sabates', [ControllerSabates::class, 'getSabates']);
Route::post('/sabates', [ControllerSabates::class, 'createSabates']);
Route::post('/comanda', [ControllerComanda::class, 'createComanda']);