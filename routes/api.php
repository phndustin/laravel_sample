<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;


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

Route::post('/signup', [AuthController::class, 'signUp'])->name('user.signup');
Route::post('/signin', [AuthController::class, 'signIn'])->name('user.signin');;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/signout', [AuthController::class, 'signOut']);

    Route::prefix('me')->group(function () {
        Route::get('/', [UserController::class, 'me']);
    });

    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::post('/{notification}/read', [NotificationController::class, 'read']);
    });

    Route::prefix('payment')->group(function () {
    });
});
