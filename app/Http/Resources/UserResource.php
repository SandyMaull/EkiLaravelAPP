<?php

namespace App\Http\Resources;

use App\Models\Item\Kywn_Code;
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
        $kywn = Kywn_Code::findOrFail($this->kywn_id);
        return [
            'id' => $this->id,
            'kywn_code' => new KywnCodeResource($kywn),
            'no_telp' => $this->no_telp,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
