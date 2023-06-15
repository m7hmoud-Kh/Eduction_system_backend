<?php

namespace App\Http\Resources;

use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $id=$this->branche_id;
        $branch=Branch::where('id',$id)->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'branche' => $branch->name,
        ];
       
    }
}
