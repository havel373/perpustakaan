<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Capsule\Manager;
class BookController extends Controller
{
    public function index(Request $request,$id)
    {
        if($request->ajax() ){
            $keywords = $request->keywords;
            // SELECT * from books where kategori_id =".$id . "AND judul LIKE %$keywords% OR pengarang LIKE %$keywords% OR penerbit LIKE %$keywords%
            $collection = Book::where('kategori_id', '=',$id)
            ->where(function($query) use ($keywords){
                $query->where('pengarang','like','%'.$keywords.'%');
                $query->orWhere('judul','like','%'.$keywords.'%');
                $query->orWhere('penerbit','like','%'.$keywords .'%');
            })->orderBy('created_at', 'desc')
            ->paginate(5);
            // dd($collection);
            // Book::where
            // DB::table('books')->where('kategori_id',$id)
            // ->paginate(5);
            // ->where('judul','like','%'.$keywords.'%', 'OR')
            // ->where('penerbit','like','%'.$keywords.'%', 'OR')
            // ->where('pengarang','like','%'.$keywords.'%')
            // WHERE pengarang LIKE %'.$keywords.'% OR WHERE penerbit LIKE %' . $keywords.'% ')
            // ->paginate(5);
            // dd($collection);
            // ->orWhere('pengarang','like','%'.$keywords.'%')
            // ->where('penerbit','like','%'.$keywords.'%')->paginate(5);
            // where('judul','like','%'.$keywords.'%')->
            // Where('pengarang','like','%'.$keywords.'%')->
            // Where('penerbit','like','%'.$keywords.'%')->paginate(5);
            // dd($collection);
            return view('pages.office.book.list',compact('collection'));
        }
        $category = BookCategory::where('id',$id)->first();
        return view('pages.office.book.main',compact('category'));
    }

    public function create($id)
    {
        return view('pages.office.book.modal',["book"=> new Book,"id"=>$id]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:100',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'foto' => 'required',
            'tahun_terbit' => 'required',
            'edisi_buku' => 'required',
            'jumlah_buku' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('judul')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('judul'),
                ]);
            }else if($errors->has('pengarang')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('pengarang'),
                ]);
            }else if($errors->has('penerbit')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('penerbit'),
                ]);
            }else if($errors->has('jumlah_halaman')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('jumlah_halaman'),
                ]);
            }else if($errors->has('foto')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('foto'),
                ]);
            }else if($errors->has('tahun_terbit')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tahun_terbit'),
                ]);
            }else if($errors->has('edisi_buku')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('edisi_buku'),
                ]);
            }else if($errors->has('jumlah_buku')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('jumlah_buku'),
                ]);
            }
        }
        $book = new Book;
        $book->judul = Str::title($request->judul);
        $book->kategori_id = $request->id;
        $book->pengarang = $request->pengarang;
        $book->penerbit = $request->penerbit;
        $book->jumlah_halaman = $request->jumlah_halaman;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->edisi_buku = $request->edisi_buku;
        $book->jumlah_buku = $request->jumlah_buku;
        $book->created_by = Auth::user()->id;
        $book->created_at = date('Y-m-d H:i:s');
        $file = request()->file('foto')->store("buku");
        $book->foto = $file;
        $book->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Buku '. $request->judul . ' Tersimpan',
        ]);
    }

    public function show(Request $request)
    {
        // 
    }

    public function edit(Book $book)
    {
        return view('pages.office.book.modal',compact('book'));
    }

    public function update(Book $book, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:100',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'tahun_terbit' => 'required',
            'edisi_buku' => 'required',
            'jumlah_buku' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('judul')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('judul'),
                ]);
            }else if($errors->has('pengarang')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('pengarang'),
                ]);
            }else if($errors->has('penerbit')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('penerbit'),
                ]);
            }else if($errors->has('jumlah_halaman')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('jumlah_halaman'),
                ]);
            }else if($errors->has('foto')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('foto'),
                ]);
            }else if($errors->has('tahun_terbit')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tahun_terbit'),
                ]);
            }else if($errors->has('edisi_buku')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('edisi_buku'),
                ]);
            }else if($errors->has('jumlah_buku')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('jumlah_buku'),
                ]);
            }
        }
        $book->judul = Str::title($request->judul);
        $book->kategori_id = $request->id;
        $book->pengarang = $request->pengarang;
        $book->penerbit = $request->penerbit;
        $book->jumlah_halaman = $request->jumlah_halaman;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->edisi_buku = $request->edisi_buku;
        $book->jumlah_buku = $request->jumlah_buku;
        if($request->foto){
            Storage::delete($book->foto);
            $file = request()->file('foto')->store("buku");
            $book->foto = $file;
        }
        $book->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Buku '. $request->judul . ' Diubah',
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        Storage::delete($book->foto);
        return response()->json([
            'alert' => 'success',
            'message' => 'Buku ' . $book->judul . ' Terhapus',
        ]);
    }
}
