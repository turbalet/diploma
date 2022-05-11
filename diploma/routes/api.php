<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TypeController;
use \App\Http\Controllers\UniversityController;
use \App\Http\Controllers\LanguageController;
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
    Route::get('/regions', [RegionController::class, 'index']);
    Route::get('/regions/{id}', [RegionController::class, 'show']);
    Route::post('/regions', [RegionController::class, 'store']);
    Route::delete('/regions/{id}', [RegionController::class, 'destroy']);
    Route::put('/regions/{id}', [RegionController::class, 'update']);

    Route::get('/types', [TypeController::class, 'index']);
    Route::get('/types/{id}', [TypeController::class, 'show']);
    Route::post('/types', [TypeController::class, 'store']);
    Route::delete('/types/{id}', [TypeController::class, 'destroy']);
    Route::put('/types/{id}', [TypeController::class, 'update']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);

    Route::get('/universities', [UniversityController::class, 'index']);
    Route::get('/universities/{id}', [UniversityController::class, 'show']);
    Route::post('/universities', [UniversityController::class, 'store']);
    Route::delete('/universities/{id}', [UniversityController::class, 'destroy']);
    Route::put('/universities/{id}', [UniversityController::class, 'update']);

    Route::get('/languages', [LanguageController::class, 'index']);
    Route::get('/languages/{id}', [LanguageController::class, 'show']);
    Route::post('/languages', [LanguageController::class, 'store']);
    Route::delete('/languages/{id}', [LanguageController::class, 'destroy']);
    Route::put('/languages/{id}', [LanguageController::class, 'update']);

    Route::get('/specialities', [ProgramController::class, 'index']);
    Route::get('/specialities/{id}', [ProgramController::class, 'show']);
    Route::post('/specialities', [ProgramController::class, 'store']);
    Route::delete('/specialities/{id}', [ProgramController::class, 'destroy']);
    Route::put('/specialities/{id}', [ProgramController::class, 'update']);

    Route::get('/programs', [ProgramController::class, 'index']);
    Route::get('/programs/{id}', [ProgramController::class, 'show']);
    Route::post('/programs', [ProgramController::class, 'store']);
    Route::delete('/programs/{id}', [ProgramController::class, 'destroy']);
    Route::put('/programs/{id}', [ProgramController::class, 'update']);

    Route::get('/degrees', [DegreeController::class, 'index']);
    Route::get('/degrees/{id}', [DegreeController::class, 'show']);
    Route::post('/degrees', [DegreeController::class, 'store']);
    Route::delete('/degrees/{id}', [DegreeController::class, 'destroy']);
    Route::put('/degrees/{id}', [DegreeController::class, 'update']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
