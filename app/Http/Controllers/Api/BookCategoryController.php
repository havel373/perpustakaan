<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCategoriesResource;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller{
    
     public function __construct()
    { 
        $this->middleware('auth:api',['except'=>['index']]);
    }

     public function index()
    {
        return BookCategoriesResource::collection(
            BookCategory::paginate(5)
        );
    }

    public function show(BookCategory $booksCategory)
    {
        return new BookCategoriesResource(
            BookCategory::where('id', $booksCategory->id)->first()
        );
    }
    
}