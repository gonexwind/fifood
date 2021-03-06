<?php

use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
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

Route::prefix('v1')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);

    Route::get('foods', [FoodController::class, 'all']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [UserController::class, 'fetch']);
        Route::post('user', [UserController::class, 'updateProfile']);
        Route::post('user/photo', [UserController::class, 'updatePhoto']);
        Route::get('logout', [UserController::class, 'logout']);

        Route::get('transactions', [TransactionController::class, 'all']);
        Route::post('transactions/{id}', [TransactionController::class, 'update']);
    });
});
