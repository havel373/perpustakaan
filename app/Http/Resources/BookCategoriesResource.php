<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookCategoriesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_katgori' => ucfirst($this->nama_kategori),
            'deskripsi' => $this->deskripsi,
            'dibuat_oleh' => $this->user->name,
            'dibuat_pada' => $this->created_at
        ];
    }
}
