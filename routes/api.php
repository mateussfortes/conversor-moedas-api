<?php

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

// FALTOU PROTEGER ROTAS

Route::post('/login', 'App\Http\Controllers\JwtAuthController@login');
Route::post('logout', 'App\Http\Controllers\JwtAuthController@logout');
Route::get('me', 'App\Http\Controllers\JwtAuthController@me');

Route::apiResource('currency-converter', 'App\Http\Controllers\API\CurrencyConverterController');