<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
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
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'user'
], function($route) {
    $route->get('/me', [AuthenticationController::class, 'me']);
    $route->get('/list', [UsersController::class, 'index']);
    $route->post('/register', [UsersController::class, 'register']);
    $route->post('/update', [UsersController::class, 'update']);

    $route->post('/logout', [AuthenticationController::class, 'logout']);
});
