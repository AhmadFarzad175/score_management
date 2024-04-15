<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        ddd($this->student->first_name);
        return [
            'id' => $this->id,
            'year' => $this->year,
            'total_educational_year' => $this->total_educational_year,
            'present' => $this->present,
            'apsent' => $this->apsent,
            'sick' => $this->sick,
            'leave' => $this->leave,
            'student' => [
                'id' => $this->student_id,
                'first_name' => $this->student->first_name,
                'father_name' => $this->student->father_name,
                'image' => $this->student->image,
            ]
        ];
    }
}
