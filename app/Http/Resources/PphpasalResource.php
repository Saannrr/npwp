<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PphpasalResource extends JsonResource
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
            'nomor_bukti_pemotongan' => 2000000000 + $this->id,  // Menggabungkan 2000000000 dengan id
            'id' => $this->id,
            'tahun_pajak' => $this->tahun_pajak,
            'masa_pajak' => $this->masa_pajak,
            'nama' => $this->nama,
            'identitas' => $this->identitas,
            'npwp_id' => $this->npwp_id,
            'nik_id' => $this->nik_id,
            'dokumen_pph_pasal_id' => $this->dokumen_pph_pasal_id,
            'kode_objek_pajak' => $this->kode_objek_pajak,
            'fasilitas_pajak_penghasilan' => $this->fasilitas_pajak_penghasilan,
            'no_fasilitas' => $this->no_fasilitas,
            'jumlah_penghasilan_bruto' => $this->jumlah_penghasilan_bruto,
            'tarif' => $this->tarif,
            'jumlah_setor' => $this->jumlah_setor,
            'kelebihan_pemotongan' => $this->kelebihan_pemotongan,
            'pengaturan_id' => $this->pengaturan_id,
            'penandatangan_bukti_potong' => $this->penandatangan_bukti_potong,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
