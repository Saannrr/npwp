<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdentitasPerusahaanResource extends JsonResource
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
            'nama_perusahaan' => $this->nama_perusahaan,
            'npwp_perusahaan' => $this->npwp_perusahaan,
            'nik_perusahaan' => $this->nik_perusahaan,
            'kategori_perusahaan' => $this->kategori_perusahaan,
            'alamat' => $this->alamat
        ];
    }
}
