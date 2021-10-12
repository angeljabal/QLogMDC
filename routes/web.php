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

Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', 'AuthController@registrationForm');
// Route::post('/register', 'AuthController@register');
// Route::get('/login', 'AuthController@loginForm');
// Route::post('/login', 'AuthController@login');
// Route::get('/logout', 'AuthController@logout');
// Route::get('/verification/{user}/{token}', 'AuthController@verification');


Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');