<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TravelLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('admin/register', [AdminController::class, 'register']);
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('consumer/login',[ConsumerController::class,'login']);
Route::post('consumer/register',[ConsumerController::class,'register']);
Route::apiResource('/hotel', HotelController::class);
Route::apiResource('/travel_location', TravelLocationController::class);
Route::apiResource('/review', ReviewController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
