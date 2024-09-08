<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PajakPenghasilanResource extends JsonResource
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
            'is_posted' => $this->is_posted,
            'posting_date' => $this->posting_date,
            'tipe_pph' => $this->tipe_pph,
            'pphpasal' => new PphpasalResource($this->whenLoaded('pphpasal')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
