<?php

namespace App\Http\Requests\Dashboard\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'nick_name' => ['required','unique:teachers'],
            'phone_number' => ['required','regex:/(01)[0-9]{9}/','size:11'],
            'avatar' => ['required','mimes:jpg,png,jpeg']
        ];
    }
}
