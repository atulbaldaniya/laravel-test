<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bookingController;
use App\Http\Middleware\EnsureRedisWorks;
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

Route::prefix("bookings")->middleware([EnsureRedisWorks::class])->group(function () {
	// read booking information
	Route::get("/read", [bookingController::class, "read"]);
	
	//for creating a new booking 
	Route::post("/create", [bookingController::class, "create"]);
});
