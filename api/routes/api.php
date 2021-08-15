<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(
    ['middleware' => ['auth:sanctum']],
    function () {
        Route::apiResource('wallets', WalletController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('transactions', TransactionController::class);

        Route::get(
            '/user',
            function (Request $request) {
                return $request->user();
            }
        );
        Route::get(
            '/secrets',
            function (Request $request) {
                return $request->user()->secrets;
            }
        );
        Route::post('/logout', [UserController::class, 'logout']);
    }
);

Route::get('transactions', [TransactionController::class, 'index']);

