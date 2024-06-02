<?php

namespace App\Http\Requests;

use App\Traits\UpdateRequestRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttendanceRequest extends FormRequest
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
        // dd(Request());  
        if($this->isMethod('PUT')){
            $rules=[
            'present' => 'required|numeric|integer|min:0',
            'absent' => 'required|numeric|integer|min:0',
            'sick' => 'required|numeric|integer|min:0',
            'leave' => 'required|numeric|integer|min:0',
            ];
        }
        else{
        $rules = [
            'year' => 'required|numeric|integer',
            'total_year' => 'required|numeric|integer',
            'exam_type' => 'required',
            'classs_id' => 'required',
            'attendances.*.present' => 'required|numeric|integer|min:0',
            'attendances.*.absent' => 'required|numeric|integer|min:0',
            'attendances.*.sick' => 'required|numeric|integer|min:0',
            'attendances.*.leave' => 'required|numeric|integer|min:0',
        ];
    }
    

        

        return $rules;
    }
}
