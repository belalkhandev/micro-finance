<?php

use App\Http\Controllers\PdfController;
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
    $route->get('/member/profile/{member_id}', [PdfController::class, 'memberProfile']);
    $route->get('/dps', [PdfController::class, 'allDps']);
    $route->get('/loan', [PdfController::class, 'allLoan']);
    $route->get('/current/dps', [PdfController::class, 'allCurrentDps']);
    $route->get('/paid/dps', [PdfController::class, 'allPaidDps']);
    $route->get('/due/dps', [PdfController::class, 'allDueDps']);
    $route->get('/current/loan', [PdfController::class, 'allCurrentLoan']);
    $route->get('/paid/loan', [PdfController::class, 'allPaidLoan']);
    $route->get('/due/loan', [PdfController::class, 'allDueLoan']);
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
