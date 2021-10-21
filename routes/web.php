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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Route is grouped into 'auth' middleware
 */
Route::group(['middleware' => ['auth', 'verified']], function(){

    /**
     * Route is grouped into 'admin' middleware,
     * Since it is inside a parent group with 'auth' middleware, it inherits the middleware as well
     * 
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->except(['store','update', 'destroy']);
    });

    /**
     * 
     */
    Route::group(['prefix' => '/'], function(){
        Route::get('dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('logs', [\App\Http\Controllers\HomeController::class, 'logs'])->name('logs');
    });
    
});

require __DIR__.'/auth.php';
