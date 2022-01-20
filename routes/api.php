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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [\App\Http\Controllers\UserController::class, "store"]);
Route::post('/login', [\App\Http\Controllers\UserController::class, "login"]);

//creating hotel rooms
Route::post('/create/hotels', [\App\Http\Controllers\RoomsController::class, "store"]);
Route::get('/all/hotels', [\App\Http\Controllers\RoomsController::class, "list"]);
Route::get('/hotel/{id}', [\App\Http\Controllers\RoomsController::class, "show"]);
Route::post('/hotel/location', [\App\Http\Controllers\RoomsController::class, "location"]);
//booking
Route::post('/hotel/book', [\App\Http\Controllers\BookingsController::class, "book"]);
Route::get('/booked', [\App\Http\Controllers\BookingsController::class, "list"]);
Route::post('/customer/booked/', [\App\Http\Controllers\BookingsController::class, "listcustomer"]);