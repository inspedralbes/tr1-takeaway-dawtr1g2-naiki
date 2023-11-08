<?php

use App\Http\Controllers\ControllerComanda;
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

//Route::post('/updateEstat',[AdminController::class,'canviarEstatComanda'])->name('updateEstat');
Route::get('/',function(){
    return view('app');
})->name('/');

Route::get('/panel',function(){
    return view('panel',['token' => session('token'),'comandes'=>session('comandes')]);
})->name('panel');

Route::post('/loginAdmin',[AdminController::class,'loginAdmin'])->name('loginAdmin');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->patch('/comanda', [ControllerComanda::class, 'canviarEstatComanda'])->name("updateEstat");
   

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/comanda', [ControllerComanda::class, 'getComanda']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::patch('/comanda', [ControllerComanda::class, 'canviarEstatComanda'])->name('updateEstat');


});

