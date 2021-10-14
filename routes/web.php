<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    
    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
    // Users

    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->except(['store','update', 'destroy']);
});

Route::get('/', function () {
    return view('welcome');
});
