<?php

use App\Http\Controllers\Admin\QueueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/ids', function () {
    return view('ids');
});
Route::get('/idlog', function () {
    return view('ids-log');
});


Route::get('/', [QueueController::class, 'landing']);
Route::get('login',  [AuthController::class, 'loginForm'])->name('login');
Route::post('login',  [AuthController::class, 'login']);
Route::get('logout',  [AuthController::class, 'logout'])->name('logout');
Route::post('/process-queue', [QueueController::class, 'process']);
// Route::get('/process-queue', [QueueController::class, 'process']);
Route::get('queues', [\App\Http\Controllers\Admin\QueueController::class, 'index']);

// Route::get('queue/process/{user}/{purpose}', [QueueController::class, 'store']);
/**
 * Route is grouped into 'auth' middleware
 */
Route::group(['middleware' => 'auth'], function () {
    // Route::get('queue/process', [QueueController::class, 'selectTransaction']);
    // Route::get('queue/process/{id}', [QueueController::class, 'process']);
    Route::get('queue/confirm/{id}', [QueueController::class, 'confirm']);
    Route::get('queue/complete', [QueueController::class, 'complete']);
    /**
     * Route is grouped into 'admin' middleware,
     * Since it is inside a parent group with 'auth' middleware, it inherits the middleware as well
     *
     */
    // Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function () {
    //     Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['store', 'update', 'destroy']);
    // });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['store', 'update', 'destroy'])
            ->middleware(['role:admin']);
        Route::group(['middleware' => 'role:admin'], function () {
            Route::resource('purposes', \App\Http\Controllers\Admin\PurposeController::class)->except(['store', 'update', 'destroy']);
            Route::resource('logs', \App\Http\Controllers\Admin\LogsController::class)->except(['store', 'update', 'destroy']);
            Route::resource('facilities', \App\Http\Controllers\Admin\FacilityController::class)->except(['store', 'update', 'destroy']);
        });
    });

    Route::group(['prefix' => '/'], function () {
        Route::get('dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('logs', [\App\Http\Controllers\HomeController::class, 'logs'])->name('logs');
        Route::get('generate-qrcode/{user}', [\App\Http\Controllers\HomeController::class, 'generate']);
        Route::post('/loginAsAdmin', [\App\Http\Controllers\HomeController::class, 'loginAsAdmin'])->name('loginAsAdmin');
        Route::get('facilities', [\App\Http\Controllers\ShowFacilitiesController::class, 'show'])->name('facilities');

        // Route::group(['prefix' => '/profile'], function () {
        //     Route::get('/', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
        //     Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit-profile');
        //     Route::get('/change-password', [\App\Http\Controllers\ProfileController::class, 'changePassword'])->name('change-password');
        // });

        Route::group(['prefix' => '/facility', 'middleware' => 'role:office-head'], function () {
            Route::resource('/', \App\Http\Controllers\Head\FacilityController::class)->except(['store', 'update', 'destroy']);
            Route::resource('/queue', \App\Http\Controllers\Head\QueueController::class)->except(['store', 'update', 'destroy']);
        });
    });
});

// require __DIR__.'/auth.php';
