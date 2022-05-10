<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kategori' => ucfirst($this->category->nama_kategori),
            'judul' => $this->judul,
            'pengarang' => $this->pengarang,
            'penerbit' => $this->penerbit,
            'jumlah_halaman' => $this->jumlah_halaman,
            'tahun_terbit' => $this->tahun_terbit,
            'edisi_buku' => $this->edisi_buku,
            'jumlah_buku' => $this->jumlah_buku,
            'dibuat_pada' => $this->created_at,
            'dibuat_oleh' => $this->user->name,
            'Gambar' => $this->image,
        ];
    }
}
