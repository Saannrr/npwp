<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'token' => $this->whenNotNull($this->token),
            'id' => $this->id,
            'email' => $this->email,
            'passphrase' => $this->passphrase,
            'role' => $this->role,
            'nama' => $this->nama,
            'nip' => $this->nip,
            'jabatan' => $this->jabatan,
            'kategori_perusahaan' => $this->kategori_perusahaan,
            'npwp' => $this->npwp,
            'nik' => $this->nik,
            'alamat' => $this->alamat,
            'created_at' => $this->created_at,
        ];
    }
}
