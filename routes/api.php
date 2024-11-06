<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\AuthenticationController;

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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthenticationController::class, 'login']);

    // Route::group(['middleware' => 'auth:sanctum', 'ensure_json_header'], function () {
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('employees', [EmployeesController::class, 'index']);
        Route::post('assets', [AssetController::class, 'store']);
        Route::get('assets/{id}', [AssetController::class, 'show']);
        Route::put('assets/{id}', [AssetController::class, 'update']);
        Route::delete('assets/{id}', [AssetController::class, 'destroy']);
    // });
});
