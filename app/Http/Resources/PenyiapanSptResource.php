<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenyiapanSptResource extends JsonResource
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
            'tahun_pajak' => $this->tahun_pajak,
            'masa_pajak' => $this->masa_pajak,
            'pbtl_ke' => $this->pbtl_ke,
            'jumlah_pph_kurang_setor' => $this->jumlah_pph_kurang_setor,
            'status_spt' => $this->status_spt,
            'keterangan_spt' => $this->keterangan_spt,
            'bertindak_sebagai' => $this->bertindak_sebagai,
            'pengaturan_id' => $this->pengaturan_id,
            'lampiran_dopp_id' => $this->lampiran_dopp_id,
            'lampiran_doss_id' => $this->lampiran_doss_id,
            'created_at' => $this->created_at,
        ];
    }
}
