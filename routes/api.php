<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::group(['domain' => ''], function ($router) {
    Route::prefix('auth')->group(function(){
        Route::post('login','Api\AuthController@login');
        Route::post('register','Api\AuthController@register');
        Route::post('logout','Api\AuthController@logout');
    });
    Route::patch('request/{id}','Api\BorrowController@request');
    Route::patch('confirm/{id}','Api\BorrowController@confirm');
    Route::patch('return/{id}','Api\BorrowController@return');
    Route::get('book-category/{booksCategory}','Api\BookByCategoryController@index');
    Route::post('borrow/{book}','Api\BorrowController@borrow');
    Route::apiResource('/books','Api\BookController');
    Route::apiResource('/booksCategory','Api\BookCategoryController');
});