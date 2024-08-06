<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PengaturanResource extends JsonResource
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
            'user_id' => $this->user_id,
            'bertindak_sebagai' => $this->bertindak_sebagai,
            'identitas' => $this->identitas,
            'nama_penandatangan' => $this->nama_penandatangan,
            'npwp_id' => $this->npwp_id,
            'nik_id' => $this->nik_id,
            'status' => $this->status
        ];
    }
}
