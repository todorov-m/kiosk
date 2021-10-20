<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Livewire\Items;

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
Route::get('/users', [UserController::class,'index'])->middleware('auth');
Route::get('/createuser', [UserController::class,'create'])->middleware('auth');
Route::post('/createuser', [UserController::class,'store'])->middleware('auth');

Route::get('/changepass/{id}', [UserController::class,'listuser'])->middleware('auth');
Route::patch('/changepass/{id}', [UserController::class,'updatepass'])->middleware('auth');

Route::post('/login', [UserController::class,'login']);
Route::post('/logout', [UserController::class,'destroy'])->middleware('auth');

#Артикули
Route::get('/items', function () {
    return view('livewire.items');
})->middleware('auth');
Route::post('/items', [Items::class,'submit']);
