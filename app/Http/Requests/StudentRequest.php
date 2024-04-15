<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'dob' => 'required|date',
            'classs_id' => 'required|integer|exists:classses,id',
            'base_number' => 'required|string|max:30|unique:students,base_number',
            'tazkira_number' => 'required|string|max:50|unique:students,tazkira_number',
            'current_residence' => 'required|string|max:255',
            'main_residence' => 'required|string|max:255',
        ];
    }
}
