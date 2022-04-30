<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TypeController;
use \App\Http\Controllers\UniversityController;
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
    Route::post('/regions', [RegionController::class, 'store']);
    Route::delete('/regions/{id}', [RegionController::class, 'destroy']);
    Route::put('/regions/{id}', [RegionController::class, 'update']);

    Route::get('/types', [TypeController::class, 'showAll']);
    Route::get('/types/{id}', [TypeController::class, 'showOne']);
    Route::post('/types', [TypeController::class, 'store']);
    Route::delete('/types/{id}', [TypeController::class, 'destroy']);
    Route::put('/types/{id}', [TypeController::class, 'update']);

    Route::get('/categories', [CategoryController::class, 'showAll']);
    Route::get('/categories/{id}', [CategoryController::class, 'showOne']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);

    Route::get('/universities', [UniversityController::class, 'index']);
    Route::get('/universities/{id}', [UniversityController::class, 'show']);
    Route::post('/universities', [UniversityController::class, 'store']);
    Route::delete('/universities/{id}', [UniversityController::class, 'destroy']);
    Route::put('/universities/{id}', [UniversityController::class, 'update']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
