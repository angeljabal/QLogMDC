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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/purposes', [\App\Http\Controllers\Api\LogController::class, 'showPurposes']);
    Route::post('/users', [\App\Http\Controllers\Api\LogController::class, 'loadUsers']);
    Route::post('/users/find', [\App\Http\Controllers\Api\LogController::class, 'findUser']);
    Route::post('/facilities', [\App\Http\Controllers\Api\LogController::class, 'showFacilities']);
    Route::get('/logs', [\App\Http\Controllers\Api\LogController::class, 'showLogs']);
    Route::post('/logs/create', [\App\Http\Controllers\Api\LogController::class, 'store']);
    Route::post('/logs/walk-in', [\App\Http\Controllers\Api\LogController::class, 'walkInLog']);
    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'me']);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::post('/test', ['\App\Http\Controllers\Api\LogController', 'createLog']);
});