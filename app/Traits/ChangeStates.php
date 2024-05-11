<?php

namespace App\Traits;

use App\Models\Student;
use App\Traits\IsUpdateRequestRulesIfNeeded;

trait ChangeStates
{

    public function ChangeTheStateToMahroom($studentId)
    {
        $student = Student::find($studentId);
        
        $student->update(['status' => 'Mahroom']);
    }


    public function ChangeTheStateToNull($studentId)
    {
        $student = Student::find($studentId);
        
        $student->update(['status' => null]);
    }
}
