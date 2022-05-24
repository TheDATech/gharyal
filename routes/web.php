<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
    Route::resource('profile', App\Http\Controllers\ProfileController::class);
    Route::resource('chat', App\Http\Controllers\ChatController::class);    
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('groups', App\Http\Controllers\GroupController::class);
    Route::post('update-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('update_password');
    Route::post('/convert-to-group', [App\Http\Controllers\GroupController::class, 'convertChatToGroup'])->name('convert-to-group');
    Route::post('/create-group', [App\Http\Controllers\GroupController::class, 'createCustomGroup'])->name('create-group');
});

Route::get('/status', [App\Http\Controllers\UserController::class, 'userOnlineStatus']);