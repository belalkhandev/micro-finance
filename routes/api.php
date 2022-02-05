<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BdLocationsController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PostOfficeController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VillageController;
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
    'middlware' => 'auth:sanctum'
], function () {

    Route::group([
        'prefix' => 'user'
    ], function($route) {
        $route->get('/me', [AuthenticationController::class, 'me']);
        $route->get('/list', [UsersController::class, 'index']);
        $route->post('/register', [UsersController::class, 'register']);
        $route->post('/update', [UsersController::class, 'update']);

        $route->post('/logout', [AuthenticationController::class, 'logout']);
    });

    //village api
    Route::get('/division/list', [BdLocationsController::class, 'divisions']);
    Route::get('/district/list', [BdLocationsController::class, 'districts']);
    Route::get('/upazilla/list', [BdLocationsController::class, 'upazillas']);
    Route::get('/union/list', [BdLocationsController::class, 'unions']);

    //village api
    Route::group([
        'prefix' => 'village'
    ], function($route) {
        $route->get('/list', [VillageController::class, 'index']);
        $route->post('/create', [VillageController::class, 'store']);
        $route->put('/update/{id}', [VillageController::class, 'update']);
        $route->delete('/delete/{id}', [VillageController::class, 'destroy']);
    });

    //post-office api
    Route::group([
        'prefix' => 'post-office'
    ], function($route) {
        $route->get('/list', [PostOfficeController::class, 'index']);
        $route->post('/create', [PostOfficeController::class, 'store']);
        $route->put('/update/{id}', [PostOfficeController::class, 'update']);
        $route->delete('/delete/{id}', [PostOfficeController::class, 'destroy']);
    });

    //post-office api
    Route::group([
        'prefix' => 'expense'
    ], function($route) {
        $route->get('/category/list', [ExpenseCategoryController::class, 'index']);
        $route->post('/category/create', [ExpenseCategoryController::class, 'store']);
        $route->put('/category/update/{id}', [ExpenseCategoryController::class, 'update']);
        $route->delete('/category/delete/{id}', [ExpenseCategoryController::class, 'destroy']);

        $route->get('/list', [ExpenseController::class, 'index']);
        $route->post('/create', [ExpenseController::class, 'store']);
        $route->put('/update/{id}', [ExpenseController::class, 'update']);
        $route->delete('/delete/{id}', [ExpenseController::class, 'destroy']);
    });
});