<?php

use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\GetCurrentUserController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\ListUserFollowersController;
use App\Http\Controllers\ListUserFollowingsController;
use App\Http\Controllers\ShowUserController;
use App\Http\Controllers\UnfollowUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('me')
    ->middleware('auth:sanctum')
    ->name('me.')
    ->group(static function () {
        Route::get('/', GetCurrentUserController::class)
            ->name('current_user');
        Route::get('followers', ListUserFollowersController::class)
            ->name('followers');
        Route::get('followings', ListUserFollowingsController::class)
            ->name('followings');
    });

Route::prefix('user')
    ->middleware('auth:sanctum')
    ->name('user.')
    ->group(static function () {
        Route::get('{user}', ShowUserController::class)
            ->name('show');
        Route::post('{user}/follow', FollowUserController::class)
            ->name('follow');
        Route::delete('{user}/unfollow', UnfollowUserController::class)
            ->name('unfollow');
    });

Route::get('users', ListUserController::class)
    ->name('users.list');
