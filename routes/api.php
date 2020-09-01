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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('doctors', 'Api\\DoctorsController');

Route::post('users', 'Api\\UsersController@store');


Route::group([
    'middleware' => ['apiJwt'],
    'prefix' => 'doctors'
], function () {
    Route::get('/', 'Api\\DoctorsController@index');
    Route::get('/{doctor}', 'Api\\DoctorsController@show');
    Route::post('/', 'Api\\DoctorsController@store');
    Route::put('/{doctor}', 'Api\\DoctorsController@update');
    Route::delete('/{doctor}', 'Api\\DoctorsController@destroy');
});

Route::group([
    'middleware' => ['apiJwt'],
    'prefix' => 'specialties'
], function () {
    Route::get('/', 'Api\\SpecialtiesController@index');
//    Route::get('/{specialty}', 'Api\\SpecialtiesController@show');
//    Route::post('/', 'Api\\SpecialtiesController@store');
//    Route::put('/{specialty}', 'Api\\SpecialtiesController@update');
//    Route::delete('/{specialty}', 'Api\\SpecialtiesController@destroy');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
