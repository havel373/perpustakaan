<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BorrowsController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() ){
            $keywords = $request->keywords;
            $collection = Borrow::select('peminjaman.*')->join('users','peminjaman.created_by','=','users.id')
                ->where('users.role','!=','member')
                ->orderBy('peminjaman.created_at','DESC')
                ->paginate(5);
            return view('pages.office.borrow.list',compact('collection'));
        }
        return view('pages.office.borrow.main');
    }
    
    public function create()
    {
        $books = Book::get();
        $users = User::get();
        return view('pages.office.borrow.input',compact('books','users'),['borrow' => new Borrow]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'books.*' => 'required',
            'users' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('books.*')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('books.*'),
                ]);
            }else if($errors->has('users')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('users'),
                ]);
            }
        }
        $borrow = new Borrow;
        $borrow->id_user = $request->users;
        $borrow->tanggal = now();
        $borrow->st = 'pending';
        $borrow->created_at = now();
        $borrow->created_by = Auth::user()->id;
        $borrow->updated_at = now();
        $borrow->save();
        foreach ($request->books as $key => $value) {
            $detail = new BorrowDetail;
            $detail->id_peminjaman = $borrow->id;
            $detail->id_buku = $value;
            $detail->tanggal_pinjam = now();
            $detail->st = 'pending';
            $detail->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Tersimpan',
        ]);
    }

    public function show(Borrow $borrow)
    {
        $detail = BorrowDetail::where('id_peminjaman',$borrow->id)->get();
        return view('pages.office.borrow.show',compact('borrow','detail'));
    }

    public function confirm(Borrow $borrow)
    {
        BorrowDetail::where('id_peminjaman',$borrow->id)->update(['st'=>'dikonfirmasi']);
        $borrow->st = 'dikonfirmasi';
        $borrow->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Tersimpan',
        ]);
    }

    public function edit(Borrow $borrow)
    {
        $books = Book::get();
        $users = User::get();
        return view('pages.office.borrow.input',compact('books','users','borrow'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        $validator = Validator::make($request->all(), [
            'books.*' => 'required',
            'users' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('books.*')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('books.*'),
                ]);
            }else if($errors->has('users')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('users'),
                ]);
            }
        }
        $borrow->id_user = $request->users;
        $borrow->updated_at = now();
        $borrow->update();
        $data = BorrowDetail::where('id_peminjaman',$borrow->id)->get();
        $count = $data->count();
        // if($count <= 1){
            foreach ($request->books as $key => $value) {

                dd($key,$value);
                $detail = BorrowDetail::whereIn('id_buku',[$value])
                ->where('id_peminjaman',$borrow->id)->get();
                
                dd($detail);
                $detail->id_buku = $value;
                $detail->tanggal_pinjam = now();
                $detail->update();
                // ->update([ 
                //     'id_buku'=>$value,
                //     'tanggal_pinjam' => now() 
                // ]);
                // BorrowDetail::where('id_peminjaman',$borrow->id)->update([ 'id_buku'=>$value,'tanggal_pinjam' => now() ]);
            }
        // }else{
        //     foreach ($request->books as $key => $value) {
        //         $detail = new BorrowDetail;
        //         $detail->id_peminjaman = $borrow->id;
        //         $detail->id_buku = $value;
        //         $detail->tanggal_pinjam = now();
        //         $detail->st = 'pending';
        //         $detail->save();
        //     }
        // }
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Diubah',
        ]);
    }

    public function return(Borrow $borrow){
        BorrowDetail::where('id_peminjaman',$borrow->id)->update(['st'=>'dikembalikan']);
        $borrow->st = 'dikembalikan';
        $books =  BorrowDetail::where('id_peminjaman',$borrow->id)->get();
        foreach ($books as $key => $value) {
            $value->tanggal_pengembalian = now();
            $value->update();
        }
        /* if($borrow->tanggal_pengembalian > ){
                $borrow->denda = 5000;
        }
        */
        $borrow->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman berhasil dikembalikan',
        ]);
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dihapus',
        ]);
    }
}
