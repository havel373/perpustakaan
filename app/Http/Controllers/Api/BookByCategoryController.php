<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Models\Book;

class BookByCategoryController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth:api');
    }

     public function index(BookCategory $booksCategory)
    {
        return Book::with('category')->where('kategori_id', $booksCategory->id)->get();
    }

}
