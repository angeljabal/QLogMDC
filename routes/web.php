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

Route::group(['prefix' => 'admin', 'name' => 'admin.'], function(){
    
    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    });
    // Users

    Route::get('/users', [\App\Http\Controllers\HomeController::class, 'display']);
});

Route::get('/', function () {
    return view('welcome');
});
