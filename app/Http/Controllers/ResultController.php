<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\StudentDetails;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    use ResultTrait;
    public function index(Request $request)
    {

        $students = collect();
        $year = $request->year ? $request->year : date('Y');
        $exam_type = $request->exam_type ? $request->exam_type : 0;
        $classs_id = $request->classs_id ? $request->classs_id : Classs::latest()->first()->id;


        if ($request->exam_type == 0) {
            $sql = "
        SELECT 
            students.id, 
            students.first_name, 
            students.father_name, 
            students.image, 
            students.status,
            COALESCE(SUM(scores.mark), 0) as total_marks,
            SUM(CASE WHEN scores.mark < 16 THEN 1 ELSE 0 END) as marks_under_16,
            COUNT(DISTINCT scores.subject_id) as subject_count
        FROM students
        LEFT JOIN scores ON students.id = scores.student_id
            AND scores.exam_type = '$exam_type'
            AND scores.year = '$year'
        LEFT JOIN student_details ON students.id = student_details.student_id
            AND student_details.year = '$year'
            AND student_details.classs_id = '$classs_id'
        WHERE students.deleted_at IS NULL
        AND EXISTS (
            SELECT 1
            FROM student_details
            WHERE student_details.student_id = students.id
            AND student_details.year = '$year'
            AND student_details.classs_id = '$classs_id'
        )
        GROUP BY students.id, students.first_name, students.father_name, students.image, students.status
    ";

            // Execute the query and get the results
            $students = DB::select($sql);



            // dd($students);


            $this->midTermResult($students);
        }








        if ($request->exam_type == 1) {
            // Write the raw SQL query
            $sql = "
    SELECT 
        students.id, 
        students.first_name, 
        students.father_name, 
        students.image, 
        students.status,
        COALESCE((
            SELECT SUM(mark)
            FROM scores
            WHERE scores.student_id = students.id
            AND (scores.exam_type = 0 OR scores.exam_type = 1)
            AND scores.year = '$year'
        ), 0) as total_marks,
        COALESCE((
            SELECT COUNT(*)
            FROM (
                SELECT student_id, subject_id, SUM(mark) as total_subject_marks
                FROM scores
                WHERE (scores.exam_type = 0 OR scores.exam_type = 1)
                AND scores.year = '$year'
                GROUP BY student_id, subject_id
                HAVING SUM(mark) < 40
            ) as subject_totals
            WHERE subject_totals.student_id = students.id
        ), 0) as marks_under_16,
        COALESCE((
            SELECT COUNT(DISTINCT subject_id)
            FROM scores
            WHERE scores.student_id = students.id
            AND scores.exam_type = '$exam_type'
            AND scores.year = '$year'
        ), 0) as subject_count
    FROM students
    LEFT JOIN student_details ON students.id = student_details.student_id
        AND student_details.year = '$year'
        AND student_details.classs_id = '$classs_id'
    WHERE students.deleted_at IS NULL
    AND EXISTS (
        SELECT 1
        FROM student_details
        WHERE student_details.student_id = students.id
        AND student_details.year = '$year'
        AND student_details.classs_id = '$classs_id'
    )
    GROUP BY students.id, students.first_name, students.father_name, students.image, students.status
";

            // Execute the query and get the results
            $students = DB::select($sql);



            // dd($students);
            $this->finalTermResult($students);
        }


        return view('result.result', compact('students'));
    }



    public function promote(Request $request)
    {
        $students = Student::whereHas('studentDetails', function ($query) use ($request) {
            $query->where('year', $request->year)
                ->where('classs_id', $request->from);
        })->get();

        foreach ($students as $student) {
            StudentDetails::create([
                'student_id' => $student->id,
                'classs_id' => $request->to,
                'year' => $request->year + 1,
            ]);
        }

        return redirect()->back()->with('success', 'Students promoted successfully');
    }
}
