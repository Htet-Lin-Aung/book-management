<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\ReportController;

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

Route::post('register', [AuthController::class,'register'])->name('customer.register');
Route::post('login', [AuthController::class,'login'])->name('customer.login');

Route::middleware('auth:sanctum')->group(function () {

    //Category
    Route::apiResource('category', CategoryController::class);
    Route::get('/category/search/categories', [CategoryController::class, 'search'])->name('category.search');

    //Book
    Route::apiResource('book', BookController::class);
    Route::get('/book/search/books', [BookController::class, 'search'])->name('book.search');

    //Customer
    Route::apiResource('customer', CustomerController::class)->except('store');
    Route::get('/customer/search/customers', [CustomerController::class, 'search'])->name('customer.search');

    //Sale
    Route::apiResource('sale', SaleController::class);
    Route::get('/sale/search/sales', [SaleController::class, 'search'])->name('sale.search');

    //Report
    Route::apiResource('report', ReportController::class)->only('index');
    Route::get('/report/search/reports', [ReportController::class, 'search'])->name('report.search');
});
