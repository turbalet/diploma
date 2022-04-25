<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegionController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/regions', [RegionController::class, 'showAll']);
    Route::get('/regions/{id}', [RegionController::class, 'showOne']);
    Route::post('/regions/add', [RegionController::class, 'store']);
    Route::delete('/regions/delete/{id}', [RegionController::class, 'destroy']);
    Route::put('/regions/update/{id}', [RegionController::class, 'update']);

    Route::get('/types', [\App\Http\Controllers\TypeController::class, 'showAll']);
    Route::get('/types/{id}', [\App\Http\Controllers\TypeController::class, 'showOne']);
    Route::post('/types/add', [\App\Http\Controllers\TypeController::class, 'store']);
    Route::delete('/types/delete/{id}', [\App\Http\Controllers\TypeController::class, 'destroy']);
    Route::put('/types/update/{id}', [\App\Http\Controllers\TypeController::class, 'update']);

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'showAll']);
    Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'showOne']);
    Route::post('/categories/add', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::delete('/categories/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);
    Route::put('/categories/update/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
