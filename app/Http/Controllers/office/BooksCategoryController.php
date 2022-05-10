<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BooksCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() )
        {
            $keywords = $request->keywords;
            $collection = BookCategory::where('nama_kategori','like','%'.$keywords.'%')->paginate(5);
            return view('pages.office.category.list',compact('collection'));
        }
        return view('pages.office.category.main');
    }

    public function create()
    {
        return view('pages.office.category.modal',["bookCategory"=> new BookCategory]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('nama')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nama'),
                ]);
            }else if($errors->has('deskripsi')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('deskripsi'),
                ]);
            }
        }
        $category = new BookCategory;
        $category->nama_kategori = Str::title($request->nama);
        $category->deskripsi = $request->deskripsi;
        $category->created_by = Auth::user()->id;
        $category->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Kategori '. $request->titles . ' Tersimpan',
        ]);
    }

    public function show(BookCategory $bookCategory)
    {
        //   
    }

    public function edit(BookCategory $bookCategory)
    {
        return view('pages.office.category.modal',compact('bookCategory'));
    }

    public function update(Request $request, BookCategory $bookCategory)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('nama')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nama'),
                ]);
            }else if($errors->has('deskripsi')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('deskripsi'),
                ]);
            }
        }
        $bookCategory->nama_kategori = Str::title($request->nama);
        $bookCategory->deskripsi = $request->deskripsi;
        $bookCategory->created_by = Auth::user()->name;
        $bookCategory->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Kategori '. $request->titles . ' Diubah',
        ]);
    }

    public function destroy(BookCategory $bookCategory)
    {
        $bookCategory->delete();
        $book = Book::find($bookCategory->id);
        return response()->json([
            'alert' => 'success',
            'message' => 'Kategori ' . $bookCategory->nama_kategori . ' Terhapus',
        ]);
    }
}
