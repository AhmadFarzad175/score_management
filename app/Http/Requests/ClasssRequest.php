<?php

namespace App\Http\Requests;

use App\Traits\UpdateRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class ClasssRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'negaran' => 'required|string|max:255',
            'term_id' => 'required',
        ];

        $this->isMethod('PUT') ? $this->applyUpdateRules($rules) : null;

        return $rules;
    }
}
