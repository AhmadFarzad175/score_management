<?php

namespace App\Traits;

use App\Models\Student;
use App\Traits\IsUpdateRequestRulesIfNeeded;

trait ChangeStates
{

    public function ChangeTheStateToMahroom($studentId)
    {
        $student = Student::find($studentId);
        
        $student->update(['status' => 'محروم']);
    }


    public function ChangeTheStateToNull($studentId)
    {
        $student = Student::find($studentId);
        
        $student->update(['status' => null]);
    }
}
