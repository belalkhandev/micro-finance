<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//pdf routes
Route::group([
    'prefix' => 'download',
    'middleware' => ['api']
], function ($route) {
    $route->get('/member/profile', [\App\Http\Controllers\PdfController::class, 'memberProfile']);
    $route->get('/dps', [\App\Http\Controllers\PdfController::class, 'allDps']);
    $route->get('/loan', [\App\Http\Controllers\PdfController::class, 'allLoan']);
    $route->get('/current/dps', [\App\Http\Controllers\PdfController::class, 'allCurrentDps']);
    $route->get('/paid/dps', [\App\Http\Controllers\PdfController::class, 'allPaidDps']);
    $route->get('/due/dps', [\App\Http\Controllers\PdfController::class, 'allDueDps']);
    $route->get('/current/loan', [\App\Http\Controllers\PdfController::class, 'allCurrentLoan']);
    $route->get('/paid/loan', [\App\Http\Controllers\PdfController::class, 'allPaidLoan']);
    $route->get('/due/loan', [\App\Http\Controllers\PdfController::class, 'allDueLoan']);
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
