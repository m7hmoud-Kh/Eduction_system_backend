<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'description' => $this->description,
            'start_at' => $this->examDateFormate($this->start_at),
            'end_at' => $this->examDateFormate($this->end_at),
            'status' => $this->status ? 'Puplished' : 'unPulished',
            'type' => $this->type ? 'Normal Exam' : 'Prerequest Exam',
            'classroom_name' => $this->classRoom->name
        ];
    }
}
