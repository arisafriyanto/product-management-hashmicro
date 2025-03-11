<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutControllers;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacterMatchController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', LogoutControllers::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('units', UnitController::class);
    Route::resource('products', ProductController::class);
    Route::resource('discounts', DiscountController::class);
    Route::resource('transactions', TransactionController::class);

    Route::post('/check-discount', [TransactionController::class, 'checkDiscount'])->middleware('web');

    Route::get('/character-match', [CharacterMatchController::class, 'index'])->name('character.match');
    Route::post('/character-match', [CharacterMatchController::class, 'check'])->name('character.match.check');
});
