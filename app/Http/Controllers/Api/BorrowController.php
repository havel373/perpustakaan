<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BorrowController extends Controller
{
    // use ReplyJson;
    public function __construct()
    { 
        $this->middleware('auth:api');
    }

    public function borrow(Book $book)
    {
        $borrow = new Borrow;
        $borrow->id_user = request()->user()->id;
        $borrow->tanggal = now();
        $borrow->st = 'pending';
        $borrow->created_at = now();
        $borrow->updated_at = now();
        $borrow->save();
        $detail = new BorrowDetail;
        $detail->id_peminjaman = $borrow->id;
        $detail->id_buku = $book->id;
        $detail->tanggal_pinjam = now();
        $detail->st = 'pending';
        $detail->save();
        return response()->json(['message'=>'Buku Berhasil Dipinjam!'],201);
    }


    public function request($id){
        $data = Borrow::where('id', $id)->first();
        $data->st = 'menunggu konfirmasi';
        $data->update();
        $peminjaman = BorrowDetail::where('id_peminjaman', $id)->first();
        $peminjaman->st = 'menunggu konfirmasi';
        $peminjaman->update();
        return response()->json(['message'=>'Permintaan Berhasil Dikonfirmasi!'],201);
    }
    
    public function confirm($id){
        $data = Borrow::where('id', $id)->first();
        $data->st = 'dikonfirmasi';
        $data->update();
        $peminjaman = BorrowDetail::where('id_peminjaman', $id)->first();
        $peminjaman->st = 'dikonfirmasi';
        $peminjaman->update();
        return response()->json(['message'=>'Permintaan Berhasil Dikonfirmasi!'],201);
    }
    
    public function return($id){
        $data = Borrow::where('id', $id)->first();
        $data->st = 'dikembalikan';

        $data->update();
        $peminjaman = BorrowDetail::where('id_peminjaman', $id)->first();
        $peminjaman->tanggal_pengembalian = now();
        $interval = $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_pengembalian);
        $days = $interval->format('%a');
        dd($days);
        // if( ){

        // }
        $peminjaman->st = 'dikembalikan';
        $peminjaman->update();
        return response()->json(['message'=>'Buku Berhasil Dikembalikan!'],201);
    }
}
