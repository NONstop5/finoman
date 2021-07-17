<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
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

Route::get('/secrets', function (Request $request){
    return $request->user()->secrets;
})->middleware('auth:sanctum');

Route::post('/tokens/create', function(Request $request){
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
})->middleware('auth:sanctum');

Route::get('/reports', function (){
    $userId = 4; //auth user
    return User::find($userId)->accounts()->get(); // get all categories
//    $account = \App\Models\Account::find(13);
//    return $account->user->name;
});

