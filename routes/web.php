<?php

use App\Http\Controllers\BulletineController;
use App\Http\Controllers\PrimeController;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\SalarieController;
use App\Models\Prime;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/Salarie/salaire/{id}',[SalarieController::class,'checkDate'])->name('R_salaire.checkDate');
Route::post('/salaire/store/{id}',[SalaireController::class,'store'])->name('R_salaire.store');
/////////////////////////////////////////////////////////////////////////////////////
Route::get('/Prime',[PrimeController::class,'index'])->name('R_primes.index');
Route::get('/Prime/create',[PrimeController::class,'create'])->name('R_primes.create');
Route::post('/Prime',[PrimeController::class,'store'])->name('R_primes.store');
Route::get('/Prime/edit/{id}',[PrimeController::class,'edit'])->name('R_primes.edit');
Route::put('/Prime/{id}',[PrimeController::class,'update'])->name('R_primes.update');
Route::get('/Prime/{id}',[PrimeController::class,'destroy'])->name('R_primes.destroy');

/////////////////////////////////////////////////////////////////////////////////////////

Route::get('/',[SalarieController::class,'index'])->name('R_salaries.index');
Route::get('/Salarie/create',[SalarieController::class,'create'])->name('R_salaries.create');
Route::post('/Salarie',[SalarieController::class,'store'])->name('R_salaries.store');
Route::get('/Salarie/edit/{id}',[SalarieController::class,'edit'])->name('R_salaries.edit');
Route::get('/Salarie/show/{id}',[SalarieController::class,'show'])->name('R_salaries.show');
Route::put('/Salarie/{id}',[SalarieController::class,'update'])->name('R_salaries.update');
Route::get('/Salarie/{id}',[SalarieController::class,'destroy'])->name('R_salaries.destroy');

/////////////////////////////////////////////////////////////////////////////////////////////
use App\Http\Controllers\BulltineController;

Route::get('/R_bulltines/download/{id}', [BulletineController::class, 'downloadBulletin'])->name('R_bulltines.download');

Route::get('/bulltin',[BulletineController::class,'All_bulletin'])->name('R_bulltines.All_bulletin');
Route::get('/bulltin/index/{id}',[BulletineController::class,'index'])->name('R_bulltines.index');
Route::get('/bulltin/create',[BulletineController::class,'create'])->name('R_bulltines.create');
Route::get('/bulltine/store/{id}',[BulletineController::class,'store'])->name('R_bulltines.store');
Route::get('/bulltine/show',[BulletineController::class,'show'])->name('R_bulltines.show');
Route::get('/bulltine/edit/{id}',[BulletineController::class,'edit'])->name('R_bulltines.edit');
Route::put('/bulltine/{id}',[BulletineController::class,'update'])->name('R_bulltines.update');
Route::get('/bulltine/{id}',[BulletineController::class,'destroy'])->name('R_bulltines.destroy');