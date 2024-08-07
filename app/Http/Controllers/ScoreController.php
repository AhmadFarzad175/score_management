<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Classs;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ScoreRequest;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = [];
        // $classes = Classs::latest()->get();

        if (!$request['year']) {
            $request['classs_id'] = Classs::latest()->first()->id;
            $request['year'] = date('Y');
            $request['exam_type'] = 0;
        }

        $class = Classs::find($request->classs_id);

        if ($class) {

            $studentsData = Student::select(
                'students.id AS student_id',
                'students.first_name',
                'students.father_name',
                'students.image',
                'scores.id AS score_id',
                'scores.mark',
                'scores.classs_id',
                'subjects.id AS subject_id',
                'subjects.name AS subject_name'
            )
                ->leftJoin('scores', 'students.id', '=', 'scores.student_id')
                ->leftJoin('subjects', 'scores.subject_id', '=', 'subjects.id')
                ->where('scores.classs_id', $request->classs_id)
                ->where('scores.exam_type', $request->exam_type)
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year)
                        ->where('classs_id', $request->classs_id);
                })
                ->get()
                ->groupBy('student_id');


            // {{ -- if you show the mahroom students  -- }}
            // $studentsData = Student::select(
            //     'students.id AS student_id',
            //     'students.first_name',
            //     'students.father_name',
            //     'students.image',
            //     'scores.id AS score_id',
            //     'scores.mark',
            //     'scores.classs_id',
            //     'subjects.id AS subject_id',
            //     'subjects.name AS subject_name'
            // )
            //     ->leftJoin('scores', function ($join) use ($request) {
            //         $join->on('students.id', '=', 'scores.student_id')
            //             ->where('scores.classs_id', $request->classs_id)
            //             ->where('scores.exam_type', $request->exam_type);
            //     })
            //     ->leftJoin('subjects', 'scores.subject_id', '=', 'subjects.id')
            //     ->whereHas('studentDetails', function ($query) use ($request) {
            //         $query->where('year', $request->year);
            //     })
            //     ->get()
            //     ->groupBy('student_id');




            foreach ($studentsData as $studentId => $records) {
                $student = [
                    'student_id' => $records[0]->student_id,
                    'first_name' => $records[0]->first_name,
                    'father_name' => $records[0]->father_name,
                    'image' => $records[0]->image,
                    'subjects' => []
                ];

                foreach ($records as $record) {
                    if ($record->subject_id !== null) {
                        $student['subjects'][] = [
                            'subject_id' => $record->subject_id,
                            'subject_name' => $record->subject_name,
                            'score_id' => $record->score_id,
                            'mark' => $record->mark,
                        ];
                    }
                }
                $students[] = $student;
            }
        }

        return view('scores.allScores', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request);
        $students = collect();
        $classes = Classs::latest()->get();

        $subject = Subject::find(Request('subject_id'));


        if ($request->classs_id) {
            $students = Student::where('status', null)
            ->leftJoin('scores', function ($join) use ($request) {
                $join->on('students.id', '=', 'scores.student_id')
                    ->where('scores.classs_id', '=', $request->classs_id)
                    ->where('scores.subject_id', '=', $request->subject_id)
                    ->where('scores.exam_type', '=', $request->exam_type);
            })
                ->join('attendances', 'students.id', '=', 'attendances.student_id')
                ->where('attendances.classs_id', '=', $request->classs_id)
                ->where('attendances.year', '=', $request->year)
                ->orderBy('students.first_name')
                ->orderBy('students.father_name')
                ->get();
        }


        if (!$students->isEmpty()) {
            //
        } else {
            $students = Student::where('status', null)
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year)
                        ->where('classs_id', $request->classs_id);
                })
                ->join('student_details', 'students.id', '=', 'student_details.student_id')
                ->where('student_details.year', $request->year)
                ->where('student_details.classs_id', $request->classs_id)
                ->orderBy('students.first_name')
                ->orderBy('students.father_name')
                ->select(
                    'students.id as student_id',
                    'students.first_name',
                    'students.father_name',
                    'students.image',
                    'student_details.classs_id'
                )
                ->get();
        }

        return view('scores.createScore', compact('students', 'classes', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScoreRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);
        foreach ($validated['students'] as $studentId => $studentData) {
            $scoreData = [
                'student_id' => $studentId,
                'subject_id' => $validated['subject_id'],
                'year' => $validated['year'],
                'classs_id' => $validated['classs_id'],
                'exam_type' => $validated['exam_type'],
                'mark' => $studentData['mark'],
            ];


            $score = Score::where('student_id', $studentId)
                ->where('classs_id', $validated['classs_id'])
                ->where('subject_id', $validated['subject_id'])
                ->where('exam_type', $validated['exam_type'])
                ->first();
            $score ? $score->update($scoreData) : Score::create($scoreData);
        }
        return redirect()->route('scores.index', ['classs_id' => $validated['classs_id'], 'subject_id' => $validated['subject_id'], 'exam_type' => $validated['exam_type'], 'year' => $validated['year']])->with('success', 'score inserted successfully');
    }




    /**
     * Display the specified resource.
     */
    public function show(Request $request, Score $score)
    {
        // dd($request);
        $class = Classs::find($request->classs_id);
        $studentsData = DB::table('students')
            ->select(
                'students.id AS student_id',
                'students.first_name',
                'scores.id AS score_id',
                'scores.mark',
                'scores.exam_type',
                'subjects.id AS subject_id',
                'subjects.name AS subject_name'

            )
            ->leftJoin('scores', 'students.id', '=', 'scores.student_id')
            ->leftJoin('subjects', 'scores.subject_id', '=', 'subjects.id')
            ->whereNull('students.status')
            ->where('scores.student_id', $score->student_id)
            ->where('scores.classs_id', $score->classs_id)
            ->where('scores.exam_type', $score->exam_type)
            ->get();

        return $studentsData;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        $validated = $request->validate([
            'subjects.*' => 'required|numeric|min:0|max:100',
        ]);


        // Loop through the subjects and update each score
        foreach ($validated['subjects'] as $scoreId => $mark) {
            $score = Score::find($scoreId);
            if ($score) {
                $score->mark = $mark;
                $score->save();
            }
        }

        return redirect()->route('scores.index', ['classs_id' => $score->classs_id, 'exam_type' => $score->exam_type, 'year' => $score->year])->with('success', 'Scores updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        // $score->delete();

    }
}
