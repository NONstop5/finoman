<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
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

Route::group(
    ['middleware' => ['auth:sanctum']],
    function () {
        Route::apiResource('account', AccountController::class);
        Route::apiResource('transactions', TransactionController::class);
        Route::get('/reports', [ReportController::class, 'index']);

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

        Route::post(
            '/tokens/create',
            function (Request $request) {
                $token = $request->user()->createToken($request->get('token_name'));

                return ['token' => $token->plainTextToken];
            }
        );
    }
);
