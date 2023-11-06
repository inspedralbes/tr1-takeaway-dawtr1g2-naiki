<?php

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

Route::get('/panel',[AdminController::class,'mostrarPanel'])->name('panel');
Route::post('/updateEstat',[AdminController::class,'canviarEstatComanda'])->name('updateEstat');
Route::get('/',function(){
    return view('app');
})->name('/');
Route::post('/loginAdmin',[AdminController::class,'loginAdmin'])->name('loginAdmin');

//Route::post('/register', [AdminController::class, 'register'])->name('register');
//Route::post('/login', [AdminController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



