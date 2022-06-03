<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SubjectController;
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
Route::get('/degrees', [DegreeController::class, 'index']);
Route::get('/degrees/{id}', [DegreeController::class, 'show']);
Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/programs/{id}', [ProgramController::class, 'show']);
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/regions/{id}', [RegionController::class, 'show']);
Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/{id}', [TypeController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/universities', [UniversityController::class, 'index']);
Route::get('/universities/{id}', [UniversityController::class, 'show']);
Route::get('/languages', [LanguageController::class, 'index']);
Route::get('/languages/{id}', [LanguageController::class, 'show']);
Route::get('/specialities', [SpecialityController::class, 'index']);
Route::get('/specialities/{id}', [SpecialityController::class, 'show']);
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/subjects/{id}', [SubjectController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::post('/regions', [RegionController::class, 'store']);
    Route::delete('/regions/{id}', [RegionController::class, 'destroy']);
    Route::put('/regions/{id}', [RegionController::class, 'update']);

    Route::post('/types', [TypeController::class, 'store']);
    Route::delete('/types/{id}', [TypeController::class, 'destroy']);
    Route::put('/types/{id}', [TypeController::class, 'update']);

    Route::post('/categories', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);

    Route::post('/universities', [UniversityController::class, 'store']);
    Route::delete('/universities/{id}', [UniversityController::class, 'destroy']);
    Route::put('/universities/{id}', [UniversityController::class, 'update']);
    Route::post('/universities/image/{id}', [UniversityController::class, 'updateImage']);


    Route::post('/languages', [LanguageController::class, 'store']);
    Route::delete('/languages/{id}', [LanguageController::class, 'destroy']);
    Route::put('/languages/{id}', [LanguageController::class, 'update']);

    Route::post('/specialities', [SpecialityController::class, 'store']);
    Route::delete('/specialities/{id}', [SpecialityController::class, 'destroy']);
    Route::put('/specialities/{id}', [SpecialityController::class, 'update']);

    Route::post('/programs', [ProgramController::class, 'store']);
    Route::delete('/programs/{id}', [ProgramController::class, 'destroy']);
    Route::put('/programs/{id}', [ProgramController::class, 'update']);


    Route::post('/degrees', [DegreeController::class, 'store']);
    Route::delete('/degrees/{id}', [DegreeController::class, 'destroy']);
    Route::put('/degrees/{id}', [DegreeController::class, 'update']);

    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);
    Route::put('/subjects/{id}', [SubjectController::class, 'update']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});


