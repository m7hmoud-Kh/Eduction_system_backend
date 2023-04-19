<?php

namespace App\Http\Resources;

use App\Models\Governorate;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $gov = Governorate::find($this->governorate_id);
        return [
            'id' => $this->id ,
            'f_name' => $this->f_name,
            'm_name' => $this->m_name,
            'l_name' => $this->l_name,
            'full_name' => $this->f_name .'_'.strtoupper($this->m_name[0]) . '_' . $this->l_name,
            'phone_name' => $this->phone_number,
            'guardian_number' => $this->guardian_number,
            'email' => $this->email,
            'brith_day' => $this->year.'-'.$this->month.'-'.$this->day,
            'acedemic_year' => [$this->acedemic_year, $this->yearNameFormat($this->acedemic_year)],
            'division' => [$this->division, $this->divisionNameFormat($this->division)],
            'national_id_card' => 'Subject_image/'.$this->national_id_card,
            'governorate_id' => [$this->governorate_id, $gov->name] ,
            'created_at' => date_format($this->created_at, 'Y m-d h:i:s'),
        ];

    }
}