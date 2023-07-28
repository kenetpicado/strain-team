<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            '*.name' => 'required|max:255',
            '*.birth' => 'required|date',
            '*.id_number' => 'nullable|alpha_dash|unique:students,id_number',
            '*.phone' => 'nullable|numeric',
            '*.tutor' => 'nullable|max:255',
            '*.degree' => 'nullable|max:255',
            '*.branch_id' => 'required|numeric'
        ];
    }
}
