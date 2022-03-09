<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BdLocationsController;
use App\Http\Controllers\Api\DpsController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\MemberGroupController;
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
    'middleware' => 'auth:sanctum'
], function () {

    Route::group([
        'prefix' => 'user'
    ], function($route) {
        $route->get('/me', [AuthenticationController::class, 'me']);
        $route->get('/list', [UsersController::class, 'index']);
        $route->post('/create', [UsersController::class, 'create']);
        $route->post('/update', [UsersController::class, 'update']);
        $route->delete('/delete/{id}', [UsersController::class, 'destroy']);

        $route->post('/logout', [AuthenticationController::class, 'logout']);
    });

    Route::get('/role/list', [UsersController::class, 'roles']);

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
        $route->get('/list', [ExpenseController::class, 'index']);
        $route->post('/create', [ExpenseController::class, 'store']);
        $route->put('/update/{id}', [ExpenseController::class, 'update']);
        $route->delete('/delete/{id}', [ExpenseController::class, 'destroy']);
        //expense categories route
        $route->get('/category/list', [ExpenseCategoryController::class, 'index']);
        $route->post('/category/create', [ExpenseCategoryController::class, 'store']);
        $route->put('/category/update/{id}', [ExpenseCategoryController::class, 'update']);
        $route->delete('/category/delete/{id}', [ExpenseCategoryController::class, 'destroy']);

    });

    //member group
    Route::group([
        'prefix' => 'member-group'
    ], function($route) {
        $route->get('/list', [MemberGroupController::class, 'index']);
        $route->post('/create', [MemberGroupController::class, 'store']);
        $route->put('/update/{id}', [MemberGroupController::class, 'update']);
        $route->delete('/delete/{id}', [MemberGroupController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'member'
    ], function($route) {
        $route->get('/list', [MemberController::class, 'index']);
        $route->post('/create', [MemberController::class, 'store']);
        $route->put('/update/{id}', [MemberController::class, 'update']);
        $route->delete('/delete/{id}', [MemberController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'application/dps'
    ], function($route) {
        $route->get('/list', [DpsController::class, 'index']);
        $route->post('/create', [DpsController::class, 'store']);
        $route->put('/update/{id}', [DpsController::class, 'update']);
        $route->delete('/delete/{id}', [DpsController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'application/loan'
    ], function($route) {
        $route->get('/list', [LoanController::class, 'index']);
        $route->post('/create', [LoanController::class, 'store']);
        $route->put('/update/{id}', [LoanController::class, 'update']);
        $route->delete('/delete/{id}', [LoanController::class, 'destroy']);
    });
});
