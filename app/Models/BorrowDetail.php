<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowDetail extends Model
{
    use HasFactory;
    public $table = 'detail_peminjaman';

    public function borrow(){
        return $this->belongsTo(Borrow::class,'id_peminjaman','id');
    }

    public function books(){
        return $this->belongsTo(Book::class,'id_buku','id');
    }

    // public function category(){
    //     return $this->belongsTo(BookCategory::class,'id_buku','id');
    // }
}
