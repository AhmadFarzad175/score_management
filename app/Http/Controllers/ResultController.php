<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    use ResultTrait;
    public function index(Request $request)
    {

        $students = collect();

        if (!$request['year']) {
            $request['classs_id'] = Classs::latest()->first()->id;
            $request['year'] = 2025;
            $request['exam_type'] = 0;
        }


        if ($request->exam_type == 0) {
            $students = Student::query()
                ->select('first_name', 'father_name', 'image')
                ->addSelect(DB::raw('(SELECT COALESCE(SUM(mark), 0) FROM scores WHERE student_id = students.id AND exam_type = "' . $request->exam_type . '" AND year = "' . $request->year . '") as total_marks'))
                ->addSelect(DB::raw('(SELECT COUNT(*) FROM scores WHERE student_id = students.id AND exam_type = "' . $request->exam_type . '" AND year = "' . $request->year . '" AND mark < 16) as marks_under_16'))
                ->addSelect(DB::raw('(SELECT COUNT(DISTINCT subject_id) FROM scores WHERE student_id = students.id AND exam_type = "' . $request->exam_type . '" AND year = "' . $request->year . '") as subject_count'))
                ->with(['scores' => function ($query) use ($request) {
                    $query->select('id', 'student_id', 'mark', 'subject_id')
                        ->where('exam_type', $request->exam_type)
                        ->where('year', $request->year);
                }])
                ->whereNull('status')
                ->where('classs_id', $request->classs_id)
                ->whereHas('scores', function ($query) use ($request) {
                    $query->where('exam_type', $request->exam_type)
                        ->where('year', $request->year);
                })
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year);
                })
                ->get();

            $this->midTermResult($students);
        }








        if ($request->exam_type == 1) {
            $students = Student::query()
                ->select('first_name', 'father_name', 'image')
                ->addSelect(DB::raw('(SELECT COALESCE(SUM(mark), 0) FROM scores WHERE student_id = students.id AND (exam_type = 0 OR exam_type = 1) AND year = "' . $request->year . '") as total_marks'))
                ->addSelect(DB::raw('(
                    SELECT COUNT(*)
                    FROM (
                        SELECT student_id, subject_id, SUM(mark) as total_subject_marks
                        FROM scores
                        WHERE (exam_type = 0 OR exam_type = 1)
                        AND year = "' . $request->year . '"
                        GROUP BY student_id, subject_id
                        HAVING SUM(mark) < 40
                    ) as subject_totals
                    WHERE subject_totals.student_id = students.id
                ) as marks_under_16'))
                ->addSelect(DB::raw('(SELECT COUNT(DISTINCT subject_id) FROM scores WHERE student_id = students.id AND exam_type = "' . $request->exam_type . '" AND year = "' . $request->year . '") as subject_count'))
                ->with(['scores' => function ($query) use ($request) {
                    $query->select('id', 'student_id', 'mark', 'subject_id')
                        ->where('exam_type', $request->exam_type)
                        ->where('year', $request->year);
                }])
                ->whereNull('status')
                ->where('classs_id', $request->classs_id)
                ->whereHas('scores', function ($query) use ($request) {
                    $query->where('exam_type', $request->exam_type)
                        ->where('year', $request->year);
                })
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year);
                })
                ->get();

            $this->finalTermResult($students);

            // dd($students);
        }







        return view('result.result', compact('students'));
    }



    public function promote(Request $request)
    {
        $students = Student::where();
    }
}
