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
    $route->get('/dps/transactions', [PdfController::class, 'allDps']);
    $route->get('/dps/{member_id}/transactions', [PdfController::class, 'memberDpsTransactions']);
    $route->get('/loan/transactions', [PdfController::class, 'allLoan']);
    $route->get('/loan/{member_id}/transactions', [PdfController::class, 'memberLoanTransactions']);
    $route->get('/current/dps', [PdfController::class, 'allCurrentDps']);
    $route->get('/paid/dps', [PdfController::class, 'allPaidDps']);
    $route->get('/due/dps', [PdfController::class, 'allDueDps']);
    $route->get('/current/loan', [PdfController::class, 'allCurrentLoan']);
    $route->get('/paid/loan', [PdfController::class, 'allPaidLoan']);
    $route->get('/due/loan', [PdfController::class, 'allDueLoan']);
    $route->get('/savings/{member_id}/transactions', [PdfController::class, 'savingAccountTransactions']);
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
