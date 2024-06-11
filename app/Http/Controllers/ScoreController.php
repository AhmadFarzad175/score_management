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
        $classes = Classs::latest()->get();
        $class = Classs::find($request->classs_id);

        if ($class) {
            // $studentsData = DB::table('students')
            //     ->select(
            //         'students.id AS student_id',
            //         'students.first_name',
            //         'students.father_name',
            //         'students.image',
            //         'scores.id AS score_id',
            //         'scores.mark',
            //         'scores.classs_id',
            //         'subjects.id AS subject_id',
            //         'subjects.name AS subject_name'
            //     )
            //     ->leftJoin('scores', 'students.id', '=', 'scores.student_id')
            //     ->leftJoin('subjects', 'scores.subject_id', '=', 'subjects.id')
            //     ->whereNull('students.status')
            //     ->where('scores.classs_id', $request->classs_id)
            //     ->where('scores.exam_type', $request->exam_type)

            //     ->get()
            //     ->groupBy('student_id');

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
                ->whereNull('students.status')
                ->where('scores.classs_id', $request->classs_id)
                ->where('scores.exam_type', $request->exam_type)
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year);
                })
                ->get()
                ->groupBy('student_id');



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

        return view('scores.allScores', compact('students', 'classes'));
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
            $students = student::join('scores', 'students.id', '=', 'scores.student_id')
                ->where('scores.classs_id', $request->classs_id)
                ->where('scores.subject_id', $request->subject_id)
                ->where('scores.exam_type', $request->exam_type)
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year);
                })
                ->orderBy('first_name')
                ->orderBy('father_name')
                ->get();
        }


        if (!$students->isEmpty()) {
            //
        } else {
            $students = Student::where('status', null)
                ->where('classs_id', $request->classs_id)
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year);
                })
                ->orderBy('first_name')->orderBy('father_name')
                ->select('id as student_id', 'first_name', 'father_name', 'image', 'classs_id')->get();
        }

        return view('scores.createScore', compact('students', 'classes', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScoreRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['students'] as $studentId => $studentData) {
            $scoreData = [
                'student_id' => $studentId,
                'subject_id' => $validated['subject_id'],
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
        $messages = [
            'subjects.*.required' => 'The mark for each subject is required.',
            // 'subjects.*.numeric' => 'The mark for each subject must be a number.',
            // 'subjects.*.min' => 'The mark for each subject must be at least :min.',
            // 'subjects.*.max' => 'The mark for each subject must not be greater than :max.',
        ];
        // Validate the incoming request data
        $request->validate([
            'subjects.*' => 'required|numeric|min:0|max:100',
        ], $messages);


        // Loop through the subjects and update each score
        foreach ($request->input('subjects') as $scoreId => $mark) {
            $score = Score::find($scoreId);
            if ($score) {
                $score->mark = $mark;
                $score->save();
            }
        }

        return redirect()->route('scores.index', ['classs_id' => $score->classs_id, 'exam_type' => $score->exam_type])->with('success', 'Scores updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        //
    }
}
