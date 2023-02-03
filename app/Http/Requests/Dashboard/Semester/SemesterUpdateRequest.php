<?php

namespace App\Http\Requests\Dashboard\Semester;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SemesterUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:semesters,id,:' . $this->id],
            'status' => ['required', Rule::in(1, 0)],
            'academic_year_id' => ['required'],
        ];
    }
}
