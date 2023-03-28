<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassRoomResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'prerequisite_exam' => $this->prerequisite_exam,
            'status' => $this->status,
            'registration_deadline' => date_format($this->created_at, 'Y m-d h:i:s'),
            'start_date' => date_format($this->created_at, 'Y m-d h:i:s'),
            'max_capacity' => $this->max_capacity,
            'min_grade' => $this->min_grade,
            'min_selected' => $this->min_selected,
        ];
    }
}
