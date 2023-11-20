<?php

use App\Http\Controllers\HotelController;
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

Route::post('admin/register', [\App\Http\Controllers\AdminController::class, 'register']);
Route::post('admin/login', [\App\Http\Controllers\AdminController::class, 'login']);
Route::post('consumer/login',[\App\Http\Controllers\ConsumerController::class,'login']);
Route::post('consumer/register',[\App\Http\Controllers\ConsumerController::class,'register']);
Route::apiResource('/hotel', HotelController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
