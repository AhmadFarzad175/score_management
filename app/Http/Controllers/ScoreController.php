<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Classs;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\ScoreRequest;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students = Student::where('status', null)->latest()->get();
        $subjects = Subject::all();
        $classes = Classs::all();
        return view('scores.createScore', compact('students', 'subjects', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $students = collect();
        $classes = Classs::all();
        $subject = Subject::find(Request('subject_id'));

        $ordinaries = [
            '1' => 'اول',
            '2' => 'دوم',
            '3' => 'سوم',
            '4' => 'چهارم',
            '5' => 'پنجم',
            '6' => 'ششم',
            '7' => 'هفتم',
            '8' => 'هشتم',
            '9' => 'نهم',
            '10' => 'دهم',
            '11' => 'یازدهم',
            '12' => 'دوازدهم',
        ];
        if ($request->classs_id) {
            $students = student::join('scores', 'students.id', '=', 'scores.student_id')
                ->where('scores.classs_id', $request->classs_id)
                ->where('scores.subject_id', $request->subject_id)
                ->where('scores.exam_type', $request->exam_type)
                ->orderBy('first_name')
                ->orderBy('father_name')
                ->get();
        }


        if (!$students->isEmpty()) {
            //
        } else {
            $students = Student::where('status', null)
                ->where('classs_id', $request->classs_id)
                ->orderBy('first_name')->orderBy('father_name')->get();
        }

        return view('scores.createScore', compact('students', 'classes', 'subject', 'ordinaries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(scoreRequest $request)
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
        return redirect()->route('scores.create')->with('success', 'score inserted successfully');
    }




    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        //
    }
}
