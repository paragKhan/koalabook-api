<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColoringBookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StoryBookController;
use App\Http\Controllers\ListeningBookController;
use App\Http\Controllers\UserController;
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

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'userRegister']);
    Route::post('login', [AuthController::class, 'userLogin']);
    //todo: include email verification and forgot password and profile update routes

    Route::middleware(['guest_or_user'])->group(function () {
        Route::get('story-books/get-categories', [StoryBookController::class, 'getCategories']);
        Route::apiResource('story-books', StoryBookController::class)->only('index', 'show');

        Route::get('listening-books/get-categories', [ListeningBookController::class, 'getCategories']);
        Route::apiResource('listening-books', ListeningBookController::class)->only('index', 'show');

        Route::get('coloring-books/get-categories', [ColoringBookController::class, 'getCategories']);
        Route::apiResource('coloring-books', ColoringBookController::class)->only('index', 'show');

        Route::apiResource('plans', PlanController::class)->only('index');
    });
});

Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'adminLogin']);

    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('story-books', StoryBookController::class);
        Route::apiResource('listening-books', ListeningBookController::class);
        Route::apiResource('pages', PageController::class)->except('index');
        Route::apiResource('coloring-books', ColoringBookController::class);
        Route::apiResource('plans', PlanController::class);
    });
});
