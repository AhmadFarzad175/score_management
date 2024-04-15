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
    public function index()
    {
        $students = Student::with(['classs', 'mainResidence'])->latest()->get();
        return view('students.allStudents', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $classes = Classs::all();
        $provinces = Province::all();

        return view('students.addStudent', compact('classes', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }


        // Create the listing with the validated data
        Student::create($validated);

        return redirect()->route('students.index')->with('success', "Student inserted successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = Classs::all();
        $provinces = Province::all();
        $method = "update";

        return view('students.addStudent', compact('student', 'classes', 'provinces', 'method'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // dd(Request('firstname'));
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    
}
