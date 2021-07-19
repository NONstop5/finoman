<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\Auth\RegistrationController;
use \App\Http\Controllers\ReportController;
use App\Http\Controllers\Api\AccountController;


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

Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::apiResource('account', AccountController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('reports', ReportController::class);
});


Route::get('/secrets', function (Request $request) {
    return $request->user()->secrets;
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
})->middleware('auth:sanctum');

