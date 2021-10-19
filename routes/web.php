<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|HELLO
*/

Route::get('/', function () {
    return view('welcome');
})->name('login');

#Потребители
Route::get('/createuser', [UserController::class,'create'])->middleware('auth');
Route::post('/createuser', [UserController::class,'store'])->middleware('auth');

Route::post('/login', [UserController::class,'login']);
Route::post('/logout', [UserController::class,'destroy'])->middleware('auth');

