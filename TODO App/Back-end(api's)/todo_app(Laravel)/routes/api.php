<?php

use App\Http\Controllers\API\Auth\AuthenticationController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\HomePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::middleware('auth:sanctum')->get('logout', [AuthenticationController::class, 'logout']);

Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('home', [HomePageController::class, 'home']);
//test authentication
Route::middleware('auth:sanctum')->get('/test', function () {
    return Auth::user();
});
