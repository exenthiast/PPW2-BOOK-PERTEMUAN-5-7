<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'judul'      => $this->judul,
            'pengarang'  => $this->pengarang,
            'harga'      => $this->harga,
            'tgl_terbit' => $this->tgl_terbit,
            'created_at' => $this->created_at,
        ];
    }
}
