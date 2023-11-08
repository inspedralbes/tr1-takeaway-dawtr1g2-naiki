<?php

use App\Http\Controllers\ControllerComanda;
use App\Http\Controllers\ControllerSabates;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    return view('app');
})->name('app');

Route::get('/panel',function(){
    return view('panel');;
})->name('panel');

Route::post('/loginAdmin',[AdminController::class,'loginAdmin'])->name('loginAdmin');
Route::patch('/comanda', [ControllerComanda::class, 'canviarEstatComanda'])->name("updateEstat");

Route::get('/sabates', function(){
    return view('sabates');
})->name('sabates');

Route::post('/sabates',[ControllerSabates::class,'crearSabata'])->name('crearSabata');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

});

