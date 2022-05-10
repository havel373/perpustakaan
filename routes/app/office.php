<?php

use App\Http\Controllers\BorrowDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\office\AuthController;
use App\Http\Controllers\office\OfficeController;
use Illuminate\Support\Facades\Auth;
use office\AdminController;
use office\BooksCategoryController;
use office\EmployeeController;
use office\MemberController;
use App\Http\Controllers\office\BorrowsController;
use App\Http\Controllers\office\BookController;
use office\GaleriController;
use App\Http\Controllers\office\ProfileController;
use App\Http\Controllers\office\UserBorrowController;
use App\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;


Route::group(['domain' => ''], function() {
    
    Route::get('storage-link', function(){
        Artisan::call('storage:link');
        return response()->json([
            'alert' => 'success',
            'message' => 'Storage Linked!'
        ]);
    })->name('storage.link');
    
    Route::prefix('office/')->name('office.')->group(function(){
        Route::get('auth', [AuthController::class, 'index'])->name('auth.index');
        Route::prefix('auth')->name('auth.')->group(function(){
            Route::post('login',[AuthController::class, 'do_login'])->name('login');
            Route::post('forgot',[AuthController::class, 'do_forgot'])->name('forgot');
            Route::post('reset',[AuthController::class, 'do_reset'])->name('reset');
        });
        
        Route::group(['middleware' => ['auth:office']], function () {
            Route::redirect('/', ProvidersRouteServiceProvider::DASHBOARD, 301);
            Route::get('logout',[AuthController::class, 'do_logout'])->name('logout');
            Route::get('dashboard', [OfficeController::class, 'dashboard'])->name('dashboard');
            Route::get('home', [OfficeController::class, 'dashboard'])->name('home');
            
            Route::prefix('books')->name('books.')->group(function(){
                Route::get('index/{id}',  [BookController::class, 'index'])->name('index');
                Route::get('create/{id}',[BookController::class, 'create'])->name('create');
                Route::get('edit/{book}',  [BookController::class, 'edit'])->name('edit');
                Route::post('store',     [BookController::class, 'store'])->name('store');
                Route::post('update/{book}',   [BookController::class, 'update'])->name('update');
                Route::delete('destroy/{book}', [BookController::class, 'destroy'])->name('destroy');
            });
            Route::prefix('borrow')->name('borrow.')->group(function(){
                Route::get('index',  [BorrowsController::class, 'index'])->name('index');
                Route::get('create',[BorrowsController::class, 'create'])->name('create');
                Route::get('edit/{borrow}',  [BorrowsController::class, 'edit'])->name('edit');
                Route::get('show/{borrow}',  [BorrowsController::class, 'show'])->name('show');
                Route::post('store',     [BorrowsController::class, 'store'])->name('store');
                Route::patch('confirm/{borrow}',     [BorrowsController::class, 'confirm'])->name('confirm');
                Route::patch('return/{borrow}',     [BorrowsController::class, 'return'])->name('return');
                Route::patch('update/{borrow}',   [BorrowsController::class, 'update'])->name('update');
                Route::delete('destroy/{borrow}', [BorrowsController::class, 'destroy'])->name('destroy');
            });
            Route::prefix('borrow-detail')->name('borrow-detail.')->group(function(){
                Route::get('index',  [BorrowDetailController::class, 'index'])->name('index');
                Route::get('create',[BorrowDetailController::class, 'create'])->name('create');
                Route::get('edit/{borrowdetail}',  [BorrowDetailController::class, 'edit'])->name('edit');
                Route::get('show/{borrowdetail}',  [BorrowDetailController::class, 'show'])->name('show');
                Route::post('store',     [BorrowDetailController::class, 'store'])->name('store');
                Route::patch('confirm/{borrowdetail}',     [BorrowDetailController::class, 'confirm'])->name('confirm');
                Route::patch('update/{borrowdetail}',   [BorrowDetailController::class, 'update'])->name('update');
                Route::delete('destroy/{borrowdetail}', [BorrowDetailController::class, 'destroy'])->name('destroy');
            });
            Route::prefix('user-borrow')->name('user-borrow.')->group(function(){
                Route::get('index',  [UserBorrowController::class, 'index'])->name('index');
                Route::patch('confirm/{borrow}',     [UserBorrowController::class, 'confirm'])->name('confirm');
                Route::patch('return/{borrow}',     [BorrowsController::class, 'return'])->name('return');
                Route::delete('destroy/{borrow}', [UserBorrowController::class, 'destroy'])->name('destroy');
            });
            Route::prefix('profile')->name('profile.')->group(function(){
                Route::get('index',  [ProfileController::class, 'index'])->name('index');
                Route::get('create',[ProfileController::class, 'create'])->name('create');
                Route::post('update/{book}',   [ProfileController::class, 'update'])->name('update');
                Route::delete('destroy/{borrow}', [ProfileController::class, 'destroy'])->name('destroy');
            });
            Route::resource('book-category', BooksCategoryController::class);
            Route::get('info', [OfficeController::class, 'info'])->name('info');
            Route::get('all-cat', [OfficeController::class, 'shoawall'])->name('book-category.all');
            Route::resource('member', MemberController::class);
            Route::resource('employee', EmployeeController::class);
            Route::resource('galeri', GaleriController::class);
            Route::resource('admin', AdminController::class);
        });
    });
});