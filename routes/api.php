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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/message', [App\Http\Controllers\MessageController::class, 'save']);
Route::post('/get-message', [App\Http\Controllers\MessageController::class, 'getMessages']);
Route::post('/customer/register', [App\Http\Controllers\AuthController::class, 'store']);
Route::post('/customer/send-message', [App\Http\Controllers\AuthController::class, 'store']);
Route::post('/video-call', [App\Http\Controllers\VideoCallController::class, 'store']);