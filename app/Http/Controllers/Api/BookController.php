<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use Illuminate\Http\Request;
// use App\Http\Traits\ReplyJson;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // use ReplyJson;
    public function __construct()
    { 
        $this->middleware('auth:api',['except'=>['index']]);
        // return auth()->shouldUse('api');
    }

    public function index()
    {
        return BooksResource::collection(
            Book::with('category')->paginate(5)
        );
    }

    // public function store(Request $request)
    // {
    //      $validator = Validator::make($request->all(), [
    //         'judul' => 'required|max:100',
    //         'pengarang' => 'required',
    //         'penerbit' => 'required',
    //         'jumlah_halaman' => 'required',
    //         'foto' => 'required',
    //         'tahun_terbit' => 'required',
    //         'edisi_buku' => 'required',
    //         'jumlah_buku' => 'required',
    //     ]);
    //     if($validator->fails()) {
    //         return response()->json($validator->messages(),422);
    //     }
    
    //     $book = new Book;
    //     $book->judul = Str::title($request->judul);
    //     $book->kategori_id = $request->kategori_id;
    //     $book->pengarang = $request->pengarang;
    //     $book->penerbit = $request->penerbit;
    //     $book->jumlah_halaman = $request->jumlah_halaman;
    //     $book->tahun_terbit = $request->tahun_terbit;
    //     $book->edisi_buku = $request->edisi_buku;
    //     $book->jumlah_buku = $request->jumlah_buku;
    //     $book->created_by = Auth::user()->id;
    //     $book->updated_by = Auth::user()->id;
    //     // $file = request()->file('foto')->store("buku");
    //     // $book->foto = $file;
    //     $book->foto = $request->foto;
    //     $book->save();
    //     return response()->json(['message'=>'Berhasil Ditambahkan!'],201);
    // }

    public function show(Book $book)
    {
        return new BooksResource(
            Book::with('category')->where('id', $book->id)->first()
        );
    }

    // public function update(Request $request, Book $book)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'judul' => 'required|max:100',
    //         'pengarang' => 'required',
    //         'penerbit' => 'required',
    //         'jumlah_halaman' => 'required',
    //         'foto' => 'required',
    //         'tahun_terbit' => 'required',
    //         'edisi_buku' => 'required',
    //         'jumlah_buku' => 'required',
    //     ]);
    //     if($validator->fails()) {
    //         return response()->json($validator->messages(),422);
    //     }
    
    //     $book->judul = Str::title($request->judul);
    //     $book->kategori_id = $request->kategori_id;
    //     $book->pengarang = $request->pengarang;
    //     $book->penerbit = $request->penerbit;
    //     $book->jumlah_halaman = $request->jumlah_halaman;
    //     $book->tahun_terbit = $request->tahun_terbit;
    //     $book->edisi_buku = $request->edisi_buku;
    //     $book->jumlah_buku = $request->jumlah_buku;
    //     $book->created_by = Auth::user()->id;
    //     $book->updated_by = Auth::user()->id;
    //     // $file = request()->file('foto')->store("buku");
    //     // $book->foto = $file;
    //     $book->foto = $request->foto;
    //     $book->update();
    //     return response()->json(['message'=>'Berhasil Diubah!'],201);
    // }

    // public function destroy(Book $book)
    // {
    //     $book->delete();
    //      return response()->json(['message'=>'Berhasil Diubah!'],201);
    // }
}
