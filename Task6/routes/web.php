<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'verified'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductsController::class, 'index'])->name('index');
        Route::get('/create', [ProductsController::class, 'create'])->name('create')->middleware('password.confirm');
        Route::post('/store', [ProductsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductsController::class, 'delete'])->name('delete');
    });
});


require __DIR__.'/auth.php';
