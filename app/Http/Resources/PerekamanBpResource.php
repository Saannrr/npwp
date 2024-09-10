<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerekamanBpResource extends JsonResource
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
            'pajak_penghasilan_id' => $this->pajak_penghasilan_id,
            'tahun_pajak' => $this->tahun_pajak,
            'masa_pajak' => $this->masa_pajak,
            'jenis_pajak' => $this->jenis_pajak,
            'jenis_setoran' => $this->jenis_setoran,
            'pph_yang_dipotong' => $this->pph_yang_dipotong,
            'id_billing' => $this->id_billing,
            'pph_yang_disetor' => $this->pph_yang_disetor,
            'selisih' => $this->selisih,
            'created_at' => $this->created_at,
        ];
    }
}
