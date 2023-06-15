<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $c_id=$this->category_id;
        $category=Category::where('id',$c_id)->first();

        $s_id=$this->category_id;
        $subject=Subject::where('id',$s_id)->first();

        $t_id=$this->category_id;
        $teacher=Teacher::where('id',$t_id)->first();


        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'image' => "Product_image/".$this->image,
            'subject' => $subject->name,
            'teacher' => $teacher->name,
            'category' => $category->name,
            'status' => $this->status ? 'on' : 'off',
        ];
    }
}
