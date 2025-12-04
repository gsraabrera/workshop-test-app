<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\ProgramController;
use App\Http\Controllers\Api\V1\StudentProgramController;
use App\Http\Controllers\Api\V1\TermController; 
use App\Http\Controllers\Api\V1\AuthController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    // AUTHENTICATION
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);

        // USERS
        Route::apiResource('users', UserController::class);

        // STUDENTS
        Route::apiResource('students', StudentController::class);

        // PROGRAMS
        Route::apiResource('programs', ProgramController::class);

        // STUDENT PROGRAM RECORDS
        Route::apiResource('student-programs', StudentProgramController::class);

        // TERMS
        Route::apiResource('terms', TermController::class);
    });
});
