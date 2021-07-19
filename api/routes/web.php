<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('app');
// });

// Redirect all to the front-end router
// Route::get('/{pattern?}', function() {
//     return view('welcome');
// })->where('pattern', '.*');

// Route::view('/', 'welcome');
Route::view('{all}', 'app')
    ->where(['all' => '^(?!api).*$']);
