<?php

namespace App\Http\Requests;

use App\Traits\UpdateRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    use UpdateRequestRules;

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
    public function rules()
    {

        $rules = [
            'first_name' => 'required|string|max:255',  
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'dob' => 'required|date',
            'year' => 'required',
            'classs_id' => 'required|integer|exists:classses,id',
            'base_number' => 'required|string|max:30',
            'tazkira_number' => 'required|string|max:50',
            'current_residence' => 'required|string|max:255',
            'main_residence' => 'required|string|max:255',
        ];

        $this->isMethod('PUT') ? $this->applyUpdateRules($rules) : null;

        return $rules;
    }
}
