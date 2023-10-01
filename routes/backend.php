<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\ReportController;

Route::get('/', function(){
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function(){

    //Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //User
    Route::resource('user', UserController::class);
    Route::get('/user/search/users', [UserController::class, 'searchUser'])->name('user.search');
    Route::get('users-export', [UserController::class, 'exportExcel'])->name('user.export');

    //Role
    Route::resource('role', RoleController::class);

    //Category
    Route::resource('category', CategoryController::class);
    Route::get('/category/search/categories', [CategoryController::class, 'search'])->name('category.search');

    //Book
    Route::resource('book', BookController::class);
    Route::get('/book/search/books', [BookController::class, 'search'])->name('book.search');

    //Customer
    Route::resource('customer', CustomerController::class);
    Route::get('/customer/search/customers', [CustomerController::class, 'search'])->name('customer.search');

    //Sale
    Route::resource('sale', SaleController::class);
    Route::get('/sale/search/sales', [SaleController::class, 'search'])->name('sale.search');

    //Report
    Route::resource('report', ReportController::class)->except(['create','update','delete']);
    Route::get('/report/search/reports', [ReportController::class, 'search'])->name('report.search');

    //Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
