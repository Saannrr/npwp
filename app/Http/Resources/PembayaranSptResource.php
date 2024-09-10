<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PembayaranSptResource extends JsonResource
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
            'npwp_id' => $this->npwp_id,
            'nama_wp' => $this->nama_wp,
            'alamat_wp' => $this->alamat_wp,
            'ntpn' => $this->ntpn,
            'kode_billing' => $this->kode_billing,
            'kode_jenis_pajak' => $this->kode_jenis_pajak,
            'kode_jenis_setoran' => $this->kode_jenis_setoran,
            'pph_yang_dipotong' => $this->pph_yang_dipotong,
            'jumlah_setor' => $this->jumlah_setor,
            'masa_pajak' => $this->masa_pajak,
            'tahun_pajak' => $this->tahun_pajak,
            'nop' => $this->nop,
            'nomor_ketetapan' => $this->nomor_ketetapan,
            'uraian' => $this->uraian,
            'nama_bank' => $this->nama_bank,
            'nomor_transaksi_bank' => $this->nomor_transaksi_bank,
            'npwp_penyetor' => $this->npwp_penyetor,
            'created_at' => $this->created_at,
        ];
    }
}
