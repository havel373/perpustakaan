<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;
    public $table = "kategori_buku";

    public function user(){
        return $this->BelongsTo(User::class, "created_by","id");
    }
}
