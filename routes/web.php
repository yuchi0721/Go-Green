<?php

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

Route::get('/', '\App\Http\Controllers\UserController@index');
Route::post('/', '\App\Http\Controllers\UserController@createUser');
Route::get('/users', '\App\Http\Controllers\UserController@showUser');
Route::get('/hotels', '\App\Http\Controllers\HotelController@hotelOverview');
Route::get('/hotels/{id}', '\App\Http\Controllers\HotelController@hotelDetail');

Route::get('/test', function () {
    return view('test');
});

Route::get('/login', function () {
    return view('login');
});
