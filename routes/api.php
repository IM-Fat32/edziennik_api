<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('userdetails', \App\Http\Controllers\UserDetaiilsController::class);
    Route::apiResource('classroom', \App\Http\Controllers\ClassroomController::class);
    Route::apiResource('grade', \App\Http\Controllers\GradesController::class);
    Route::apiResource('lesson_plan', \App\Http\Controllers\LessonPlanController::class);
    Route::apiResource('message', \App\Http\Controllers\MessageController::class);
    Route::apiResource('subject', \App\Http\Controllers\SubjectController::class);
    Route::apiResource('school_class', \App\Http\Controllers\SchoolClassController::class);
    
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});