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
Route::get('/logout',[Controllers\UserController::class,'logout']);

Route::get('/profile',[Controllers\UserController::class,'profile'])->middleware('isLogged');
Route::post('/update-user/{id}',[Controllers\UserController::class,'updateUser']);
Route::get('/reset-password',[Controllers\UserController::class,'resetPassword'])->middleware('isLogged');
Route::post('/reset-password/{id}',[Controllers\UserController::class,'resetUserPassword']);

Route::get('/users', [Controllers\UserController::class,'showUser'])->middleware('isLogged');

Route::get('/hotels', [Controllers\HotelController::class,'hotelOverview']);
Route::get('/hotels/{id}', [Controllers\HotelController::class,'hotelDetail']);
Route::get('/hotel-areaview', [Controllers\HotelController::class,'hotelAreaview']);

Route::get('/', [Controllers\HotelController::class,'about']);
Route::get('/about', [Controllers\HotelController::class,'about']);

Route::get('/stores', [Controllers\StoreController::class,'storeOverview']);
Route::get('/stores/{id}', [Controllers\StoreController::class,'storeDetail']);





