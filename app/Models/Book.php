<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $table = "buku";
    use HasFactory;
    public $timestamps = false;
    public function category(){
        return $this->belongsTo(BookCategory::class,'kategori_id','id');
    }

    public function getImageAttribute()
    {
        return asset('storage/' . $this->foto);
    }

    public function user(){
        return $this->BelongsTo(User::class, "created_by","id");
    }
}
