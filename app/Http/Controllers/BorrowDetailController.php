<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;

class BorrowDetailController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function confirm(BorrowDetail $borrowdetail)
    {
        $borrowdetail->st = 'dikonfirmasi';
        $borrowdetail->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Tersimpan',
        ]);
    }

    public function show(BorrowDetail $borrowdetail)
    {
        //
    }

    public function edit(BorrowDetail $borrowdetail)
    {
        //
    }

    public function update(Request $request, BorrowDetail $borrowdetail)
    {
        //
    }

    public function destroy(BorrowDetail $borrowdetail)
    {
        if($borrowdetail->where('id_peminjaman', $borrowdetail->id_peminjaman)->count() <= 1){
            Borrow::where('id', $borrowdetail->id_peminjaman)->delete();
            $borrowdetail->delete();
            return response()->json([
                'alert' => 'success',
                'message' => 'Peminjaman Dihapus',
            ]);
        }
        $borrowdetail->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dihapus',
        ]);
    }
}
