<?php

namespace App\Http\Resources;

use App\Models\Item\Merk;
use Illuminate\Http\Resources\Json\JsonResource;

class KodeBarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $merk = Merk::findOrFail($this->merk_id);
        return [
            'id' => $this->id,
            'merk' => new MerkResource($merk),
            'code' => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
