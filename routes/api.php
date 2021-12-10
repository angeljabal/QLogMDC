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
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('/facilities', ['App\Http\Controllers\Api\ShowFacilitiesController', 'show']);
    Route::get('/purposes', ['App\Http\Controllers\Api\ShowPurposesController', 'show']);
    Route::get('/users', ['App\Http\Controllers\Api\ShowUsersController', 'show']);
    
    Route::group(['prefix' => '/logs'], function(){
        Route::post('create', ['App\Http\Controllers\Api\CreateLogController', 'store']);
        Route::post('walk-in', ['App\Http\Controllers\Api\CreateLogController', 'walkIn']);
    });
});