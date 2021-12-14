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
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin|editor'], function(){
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['store','update', 'destroy']);
        Route::resource('purposes', \App\Http\Controllers\Admin\PurposeController::class)->except(['store','update', 'destroy']);
        Route::resource('logs', \App\Http\Controllers\Admin\LogsController::class)->except(['store','update', 'destroy']);
        Route::resource('facilities', \App\Http\Controllers\Admin\FacilityController::class)->except(['store','update', 'destroy']);
    });

    /**
     * 
     */
    Route::group(['prefix' => '/'], function(){
        Route::get('dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('logs', [\App\Http\Controllers\HomeController::class, 'logs'])->name('logs');
        Route::get('generate-qrcode', [\App\Http\Controllers\HomeController::class, 'generate'])->name('generate-qrcode');
        Route::post('/loginAsAdmin', [\App\Http\Controllers\HomeController::class, 'loginAsAdmin'])->name('loginAsAdmin');
        Route::resource('queues', \App\Http\Controllers\Admin\QueueController::class)->except(['store','update', 'destroy']);

        Route::group(['prefix' => '/profile'], function(){
            Route::get('/', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
            Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit-profile');

        });

        Route::group(['prefix' => '/facility', 'middleware' => 'role:head'], function(){
            Route::resource('/', \App\Http\Controllers\Head\FacilityController::class)->except(['store','update', 'destroy']);
            Route::resource('/queue', \App\Http\Controllers\Head\QueueController::class)->except(['store','update', 'destroy']);
        });
        // Route::get('generate-qrcode', [\App\Http\Controllers\HomeController::class, 'generate'])->name('generate-qrcode');
    });
    
});

require __DIR__.'/auth.php';
