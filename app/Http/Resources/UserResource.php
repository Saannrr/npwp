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
            'id' => $this->id,
            'email' => $this->email,
            'passphrase' => $this->passphrase,
            'role' => $this->role,
            'profile' => $this->whenLoaded('profileable', function () {
                if ($this->profileable instanceof \App\Models\IdentitasOrang) {
                    return new IdentitasResource($this->profileable);
                } elseif ($this->profileable instanceof \App\Models\IdentitasPerusahaan) {
                    return new IdentitasPerusahaanResource($this->profileable);
                }
                return null;
            }),
            'token' => $this->whenNotNull($this->token)
        ];
    }
}
