<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DokumenPphpasalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_dokumen' => $this->nama_dokumen,
            'no_dokumen' => $this->no_dokumen,
            'tgl_dokumen' => $this->tgl_dokumen,
            'pphpasal_id' => $this->pphpasal_id,
            'created_at' => $this->created_at,
        ];
    }
}
