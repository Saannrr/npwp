<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RekamSptBpResource extends JsonResource
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
            'jenis_bukti_penyetoran' => $this->jenis_bukti_penyetoran,
            'npwp_id' => $this->npwp_id,
            'ntpn_id' => $this->ntpn_id,
            'nomor_pemindahbukuan' => $this->nomor_pemindahbukuan,
            'tahun_pajak' => $this->tahun_pajak,
            'masa_pajak' => $this->masa_pajak,
            'jenis_pajak' => $this->jenis_pajak,
            'jenis_setoran' => $this->jenis_setoran,
            'jumlah_setor' => $this->jumlah_setor,
            'pph_yang_dipotong' => $this->pph_yang_dipotong,
            'tanggal_setor' => $this->tanggal_setor,
            'beda_npwp_id' => $this->beda_npwp_id,
            'created_at' => $this->created_at,
        ];
    }
}
