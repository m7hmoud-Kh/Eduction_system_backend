<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'question' => $this->question,
            'type' => $this->formateQuestionType($this->type),
            'point' => $this->point,
            'image' => 'Question_image/' . $this->image,
            'explanation' => $this->explanation,
            'exam_name' => $this->exam->name
        ];
    }
}
