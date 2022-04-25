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
    Route::get('/regions/one', [RegionController::class, 'showOne']);
    Route::get('/regions/add', [RegionController::class, 'store']);
    Route::get('/regions/delete', [RegionController::class, 'destroy']);
    Route::get('/regions/update', [RegionController::class, 'update']);

    Route::get('/types', [\App\Http\Controllers\TypeController::class, 'showAll']);
    Route::get('/types/one', [RegionController::class, 'showOne']);
    Route::get('/types/add', [RegionController::class, 'store']);
    Route::get('/types/delete', [RegionController::class, 'destroy']);
    Route::get('/types/update', [RegionController::class, 'update']);

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'showAll']);
    Route::get('/categories/one', [RegionController::class, 'showOne']);
    Route::get('/categories/add', [RegionController::class, 'store']);
    Route::get('/categories/delete', [RegionController::class, 'destroy']);
    Route::get('/categories/update', [RegionController::class, 'update']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
