<?php

use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmployeesController;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1'], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('employees', [EmployeesController::class, 'index']);
    Route::get('assets', [AssetController::class, 'index']);
    Route::post('assets', [AssetController::class, 'store']);
    Route::get('assets/{id}', [AssetController::class, 'show']);
    Route::put('assets/{id}', [AssetController::class, 'update']);
    Route::delete('assets/{id}', [AssetController::class, 'destroy']);
});