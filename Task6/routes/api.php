<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\ProfileController;
use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Controllers\api\auth\EmailVerificationController;
use App\Http\Controllers\api\auth\PasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'products','middleware'=>['auth:sanctum','verified.api']], function () {
    Route::get('/all', [ProductController::class, 'index']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'delete']);
});


Route::group(['prefix' => 'users'], function () {
    Route::group(['middleware' => 'mustguest'], function () {
        Route::post('register', RegisterController::class);
        Route::post('login', [LoginController::class, 'login']);
        Route::post('verify-email', [PasswordController::class, 'verifyEmail']);
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('send-code', [EmailVerificationController::class, 'sendCode']);
        Route::get('verify-code', [EmailVerificationController::class, 'verifyCode']);
        Route::group(['middleware' => 'verified.api'], function () {
            Route::post('set-new-password', [PasswordController::class, 'setNewPassword']);
            Route::post('logout', [LoginController::class, 'logout']);
            Route::post('logout-from-all-devices', [LoginController::class, 'logoutFromAllDevices']);
            Route::get('profile', ProfileController::class);
        });
    });
});
