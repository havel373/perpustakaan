<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    public $table = 'peminjaman';

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function detail(){
        return $this->hasMany(BorrowDetail::class,'id_peminjaman','id');
    }
}
