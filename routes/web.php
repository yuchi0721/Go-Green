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
Route::post('/users/{id}', [Controllers\UserController::class,'adminUpdateUser']);


Route::get('/', [Controllers\HotelController::class,'hotels']);
Route::get('/hotels', [Controllers\HotelController::class,'hotelOverview']);
Route::get('/hotel-areaview', [Controllers\HotelController::class,'hotelAreaview']);
Route::get('/hotel-areaview/{area}', [Controllers\HotelController::class,'findHotel']);
Route::post('/create-hotel', [Controllers\HotelController::class,'createHotel'])->middleware('isLogged');
Route::get('/admin-hotels', [Controllers\HotelController::class,'showHotels'])->middleware('isLogged');
Route::delete('/delete-hotel/{id}', [Controllers\HotelController::class,'deleteHotel'])->middleware('isLogged');
Route::patch('/edit-hotel/{id}', [Controllers\HotelController::class,'editHotel'])->middleware('isLogged');
Route::post('/create-hotel-comment', [Controllers\HotelController::class,'createComment'])->middleware('isLogged');
Route::delete('/delete-hotel-comment/{id}', [Controllers\HotelController::class,'deleteComment'])->middleware('isLogged');
Route::get('/hotels/search', [Controllers\HotelController::class,'readHotel']);
Route::get('/hotels/{id}', [Controllers\HotelController::class,'hotelDetail']);

Route::get('/about', [Controllers\HotelController::class,'about']);

Route::get('/stores', [Controllers\StoreController::class,'storeOverview']);
Route::get('/store-areaview', [Controllers\StoreController::class,'storeAreaview']);
Route::get('/store-areaview/{area}', [Controllers\StoreController::class,'findStore']);
Route::post('/create-store', [Controllers\StoreController::class,'createStore'])->middleware('isLogged');
Route::get('/admin-stores', [Controllers\StoreController::class,'showStores'])->middleware('isLogged');
Route::delete('/delete-store/{id}', [Controllers\StoreController::class,'deleteStore'])->middleware('isLogged');
Route::patch('/edit-store/{id}', [Controllers\StoreController::class,'editStore'])->middleware('isLogged');
Route::post('/create-store-comment', [Controllers\StoreController::class,'createComment'])->middleware('isLogged');
Route::delete('/delete-store-comment/{id}', [Controllers\StoreController::class,'deleteComment'])->middleware('isLogged');
Route::get('/stores/search', [Controllers\StoreController::class,'readStore']);
Route::get('/stores/{id}', [Controllers\StoreController::class,'storeDetail']);




