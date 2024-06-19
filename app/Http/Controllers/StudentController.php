<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\Province;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;
use App\Models\StudentDetails;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    use ImageManipulation;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if(! $request['classs_id']){
            $request['classs_id'] = Classs::latest()->first()->id;
            $request['year'] = date('Y');
        }

        if ($request['classs_id']) {
            $students = Student::with(['classs', 'mainResidence'])
                ->where('classs_id', $request->classs_id)
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year);
                })
                ->latest()
                ->get();
            return view('flows.students', compact('students'));
        }
        $students = [];
        return view('flows.students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        // dd($request->method());
        $validated = $request->validated();

        $request->hasFile('image') ? $this->storeImage($request, $validated, 'images') : null;


        // Create the listing with the validated data
        $student = Student::create($validated);
        StudentDetails::create([
            'student_id' => $student->id,
            'classs_id' => $student->classs_id,
            'year' => $validated['year']
        ]);
        return redirect()->route('students.index', ['classs_id' => $validated['classs_id'], 'year' => $validated['year']])->with('success', "Student inserted successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
    {
        $validated = $request->validated();
        $this->updateImage($student, $request, $validated, 'images');

        $student->update($validated);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        StudentDetails::where('student_id', $student->id)
            ->where('classs_id', $student->classs_id)
            ->where('year', request('year'))
            ->delete();

        $student->delete();
        return redirect()->route('students.index', ['classs_id' => $student->classs_id, 'year' => request('year')])->with('success', "Student deleted successfully");
    }

    public function classsProvince()
    {
        $classes = Classs::latest()->get();
        $provinces = Province::all();
        return response()->json(['classes' => $classes, 'provinces' => $provinces]);
    }
}
