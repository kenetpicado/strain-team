<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'course_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'info' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'teacher_id' => "profesor",
            'course_id' => "curso",
        ];
    }
}
