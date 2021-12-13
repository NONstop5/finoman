<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Services\ApiDocService;
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

Route::get(
    '/get-api-doc-data',
    function (ApiDocService $apiDocService) {
        $routes = $apiDocService->getRoutes();
        $apiDocData = $apiDocService->getApiDocData($routes);

        return response()->json($apiDocData);
    }
);

Route::groupName('User')->group([],
    function () {
        Route::post('/register', [UserController::class, 'register']);
        Route::post('/login', [UserController::class, 'login']);
    }
);

Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::groupName('Wallets')->apiResource('wallets', WalletController::class);
        Route::groupName('Categories')->apiResource('categories', CategoryController::class);
        Route::groupName('Transactions')->apiResource('transactions', TransactionController::class);

        Route::groupName('User')->group([], function () {
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
        });

        Route::post(
            '/get-api-doc-data',
            function (ApiDocService $apiDocService) {
                $routes = $apiDocService->getRoutes();
                $apiDocData = $apiDocService->getApiDocData($routes);

                return response()->json($apiDocData);
            }
        );
    }
);
