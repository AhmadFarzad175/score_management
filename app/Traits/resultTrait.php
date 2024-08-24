<?php

namespace App\Traits;

use App\Models\Student;

trait resultTrait
{

    public function midTermResult($students)
    {
        foreach ($students as $student) {
            if ($student->status == Null && $student->subject_count > 0) {

                $student->average_marks = round($student->total_marks / $student->subject_count, 2);

                // Determine the grade
                if ($student->marks_under_16 > 0 || $student->average_marks < 20) {
                    $student->grade = 'F';
                } elseif ($student->average_marks >= 36) {
                    $student->grade = 'الف';
                } elseif ($student->average_marks >= 30) {
                    $student->grade = 'ب';
                } elseif ($student->average_marks >= 24) {
                    $student->grade = 'ج';
                } elseif ($student->average_marks >= 20) {
                    $student->grade = 'د';
                } else {
                    $student->grade = 'F'; // Fallback case, though should be covered by the previous conditions
                }

                // Determine the result based on the grade
                if (in_array($student->grade, ['الف', 'ب', 'ج', 'د'])) {
                    $student->result = 'موفق';
                } else {
                    $student->result = 'تلاش بیشتر';
                }
            } else {
                $student->average_marks = 0;
                $student->grade = 0;
                $student->result = 0;
            }
        }

        return $students;
    }

    public function finalTermResult($students)
    {
        foreach ($students as $student) {
            if ($student->status == Null && $student->subject_count > 0) {

                $student->average_marks = round($student->total_marks / $student->subject_count, 2);

                // Determine the grade
                if ($student->marks_under_16 > 3 || $student->average_marks < 50) {
                    $student->grade = 'ه';
                    $student->result = 'تکرار صنف';
                } elseif ($student->average_marks >= 50 && ($student->marks_under_16 < 4 && $student->marks_under_16 > 0)) {
                    $student->grade = 'ه';
                    $student->result = 'مشروط';
                } elseif ($student->average_marks >= 90) {
                    $student->grade = 'الف';
                } elseif ($student->average_marks >= 75) {
                    $student->grade = 'ب';
                } elseif ($student->average_marks >= 60) {
                    $student->grade = 'ج';
                } elseif ($student->average_marks >= 50) {
                    $student->grade = 'د';
                }

                // Determine the result based on the grade
                if (in_array($student->grade, ['الف', 'ب', 'ج', 'د'])) {
                    $student->result = 'ارتقا صنف';
                }
            } else {
                $student->average_marks = 0;
                $student->grade = 0;
                $student->result = 0;
            }
        }

        return $students;
    }




    public function midTermPdf($students)
    {
        foreach ($students as $student) {
            // dd($student['status']);
            if ($student['status'] == Null && $student['subject_count'] > 0) {

                $student['average_marks'] = round($student['total_marks'] / $student['subject_count'], 2);

                // Determine the grade
                if ($student['marks_under_16'] > 0 || $student['average_marks'] < 20) {
                    $student['grade'] = 'F';
                } elseif ($student['average_marks'] >= 36) {
                    $student['grade'] = 'الف';
                } elseif ($student['average_marks'] >= 30) {
                    $student['grade'] = 'ب';
                } elseif ($student['average_marks'] >= 24) {
                    $student['grade'] = 'ج';
                } elseif ($student['average_marks'] >= 20) {
                    $student['grade'] = 'د';
                } else {
                    $student['grade'] = 'F'; // Fallback case, though should be covered by the previous conditions
                }

                // Determine the result based on the grade
                if (in_array($student['grade'], ['الف', 'ب', 'ج', 'د'])) {
                    $student['result'] = 'موفق';
                } else {
                    $student['result'] = 'تلاش بیشتر';
                }
            } else {
                $student['average_marks'] = 0;
                $student['grade'] = 0;
                $student['result'] = 0;
            }
        }
        return $students;
    }




    public function ChangeTheStateToNull($studentId)
    {
        $student = Student::find($studentId);

        $student->update(['status' => null]);
    }
}
