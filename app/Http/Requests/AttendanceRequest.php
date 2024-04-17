<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttendanceRequest extends FormRequest
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
    public function rules()
    {
        return [
            'year' => 'required|numeric|integer',
            'total_year' => 'required|numeric|integer',
            'attendances.*.present' => 'required|numeric|integer|min:0',
            'attendances.*.absent' => 'required|numeric|integer|min:0',
            'attendances.*.sick' => 'required|numeric|integer|min:0',
            'attendances.*.leave' => 'required|numeric|integer|min:0',
        ];
    }
}
