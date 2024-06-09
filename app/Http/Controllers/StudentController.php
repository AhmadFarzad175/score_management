<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $classes = Classs::latest()->get();
        if($request['classs_id']){
            $students = Student::with(['classs', 'mainResidence'])->where('classs_id', $request->classs_id)->latest()->get();
            return view('flows.students', compact('students', 'classes'));
        }
        $students = [];
        return view('flows.students', compact('classes', 'students'));
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

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Create the listing with the validated data
        Student::create($validated);
        return redirect()->route('students.index', ['classs_id' => $validated['classs_id']])->with('success', "Student inserted successfully");
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
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index',['classs_id' => $student->classs_id])->with('success', "Student deleted successfully");
    }

    public function classsProvince()
    {
        $classes = Classs::latest()->get();
        $provinces = Province::all();
        return response()->json(['classes' => $classes, 'provinces' => $provinces]);
    }
}
