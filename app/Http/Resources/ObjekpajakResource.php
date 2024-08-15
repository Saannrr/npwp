<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ObjekpajakResource extends JsonResource
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
            'kode_pajak' => $this->kode_pajak,
            'nama_pajak' => $this->nama_pajak,
            'persen' => $this->persen,
            'netto' => $this->netto,
            'jenis' => $this->jenis,
        ];
    }
}
