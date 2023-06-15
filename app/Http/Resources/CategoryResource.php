<?php

namespace App\Http\Resources;

use App\Models\Shop;
use Illuminate\Http\Resources\Json\JsonResource;


class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

   
    public function toArray($request)
    {
        $id=$this->shop_id;
        $shop=Shop::where('id',$id)->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'shop' => $shop->name,
            'status' => $this->status ? 'on' : 'off',
        ];
    }
}
