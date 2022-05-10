<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    public $table = "galeri";
    public $timestamps = false;

    public function getImageAttribute()
    {
        return asset('storage/' . $this->foto);
    }
}
