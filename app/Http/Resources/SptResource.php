<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Ensure masa_tahun_pajak and tanggal_kirim are instances of Carbon
        $masaTahunPajak = $this->masa_tahun_pajak instanceof Carbon ? $this->masa_tahun_pajak : Carbon::parse($this->masa_tahun_pajak);
        $tanggalKirim = $this->tanggal_kirim instanceof Carbon ? $this->tanggal_kirim : Carbon::parse($this->tanggal_kirim);

        return [
            'id' => $this->id,
            'no_bpe_ntte' => $this->no_bpe_ntte,
            'masa_tahun_pajak' => $masaTahunPajak->format('Y-m'),
            'pbtl_ke' => $this->pbtl_ke,
            'tanggal_kirim' => $tanggalKirim->format('d-m-Y'),
        ];
    }
}
