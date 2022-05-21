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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('chat', App\Http\Controllers\ChatController::class);    
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('groups', App\Http\Controllers\GroupController::class);
});

Route::get('/status', [App\Http\Controllers\UserController::class, 'userOnlineStatus']);