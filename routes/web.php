<?php

use App\Http\Controllers\SaldoController;
use App\Models\SaleContent;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Livewire\Items;
use \App\Http\Livewire\Newsale;
use \App\Http\Controllers\SaleController;

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

Route::post('/items', [Items::class,'submit'])->middleware('auth');

#Продажби
Route::get('/newsales', function () {
    return view('livewire.newsale');
})->middleware('auth');

# Нова Продажба
Route::get('/newsales/{salesId}', [SaleController::class,'getsale'])->middleware('auth');
Route::put('/newsales', [SaleController::class,'submit'])->middleware('auth');
Route::post('/newsales', [SaleController::class,'store'])->middleware('auth');

# Отказ на продажба status=99
Route::get('/clearsale/{salesId}', [SaldoController::class,'clearsale'])->middleware('auth');

#Изтриване на ред от продажбата
Route::post('/deleterow', [SaleController::class,'deleterow'])->middleware('auth');

# Всички Продажби
Route::get('/listsales', function (){
    return view('livewire.sales');
})->middleware('auth');

# Показване на съдържанието на продажбата
Route::get('/sale/{id}',[SaleController::class,'listsale'])->middleware('auth');

#Форма за НОва продажба
Route::get('/sale', function () {
    return view('sales.sale');
})->middleware('auth');

Route::get('/sales', function () {
    return view('livewire.sales');
})->middleware('auth');

#Салда

Route::get('/shiftstart', [SaldoController::class,'index'])->middleware('auth');
Route::post('/shiftstart', [SaldoController::class,'store'])->middleware('auth');
Route::put('/shiftend', [SaldoController::class,'shiftend'])->middleware('auth');

//TODO да се направи ДНЕВНО приключване с печат
//TODO да се направи изглед на смените

//TODO да се направи функционалност за справки
