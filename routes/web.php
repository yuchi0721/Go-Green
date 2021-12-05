<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/signup', [Controllers\UserController::class,'signup'])->middleware('AlreadyLoggedIn');
Route::post('/signup', [Controllers\UserController::class,'createUser'])->name('auth.create'); // "->name('form action name')"
Route::post('/check', [Controllers\UserController::class,'check'])->name('auth.check');
Route::get('/login', [Controllers\UserController::class,'login'])->middleware('AlreadyLoggedIn');
Route::get('/users', [Controllers\UserController::class,'showUser']);
Route::get('/hotels', [Controllers\HotelController::class,'hotelOverview']);
Route::get('/hotels/{id}', [Controllers\HotelController::class,'hotelDetail']);

Route::get('/stores', [Controllers\StoreController::class,'storeOverview']);
Route::get('/stores/{id}', [Controllers\StoreController::class,'storeDetail']);

Route::get('/profile',[Controllers\UserController::class,'profile'])->middleware('isLogged');
Route::get('/logout',[Controllers\UserController::class,'logout']);

Route::get('/hotelAreaview', function () {
    return view('hotelAreaview',['user_logged_in'=>false]);
});
Route::get('/about', function () {
    return view('about',['user_logged_in'=>false]);
});
