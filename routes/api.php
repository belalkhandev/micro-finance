<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PostOfficeController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VillageController;
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

//village api
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'village'
], function($route) {
    $route->get('/list', [VillageController::class, 'index']);
    $route->post('/create', [VillageController::class, 'store']);
    $route->put('/update/{id}', [VillageController::class, 'update']);
    $route->delete('/delete/{id}', [VillageController::class, 'destroy']);
});

//post-office api
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'post-office'
], function($route) {
    $route->get('/list', [PostOfficeController::class, 'index']);
    $route->post('/create', [PostOfficeController::class, 'store']);
    $route->put('/update/{id}', [PostOfficeController::class, 'update']);
    $route->delete('/delete/{id}', [PostOfficeController::class, 'destroy']);
});

//post-office api
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'expense'
], function($route) {
    $route->get('/list', [ExpenseController::class, 'index']);
    $route->post('/create', [ExpenseController::class, 'store']);
    $route->put('/update/{id}', [ExpenseController::class, 'udpate']);
    $route->delete('/delete/{id}', [ExpenseController::class, 'destroy']);

    $route->get('/category/list', [ExpenseCategoryController::class, 'index']);
    $route->post('/category/create', [ExpenseCategoryController::class, 'store']);
    $route->put('/category/update/{id}', [ExpenseCategoryController::class, 'udpate']);
    $route->delete('/category/delete/{id}', [ExpenseCategoryController::class, 'destroy']);
});