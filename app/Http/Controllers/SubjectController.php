<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve class with id = 4 and relevant student attributes using eager loading
        $subjects = Subject::Where('classs', 'دهم')->get();

        // Pass the data to the view
        return view('subjects.allSubjects', compact('subjects'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => "required|string|max:255",
            'classs' => "required|string|max:255",
        ]);
        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', "subject inserted successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return response()->json($subject);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => "sometimes|string|max:255",
            // 'classs' => "sometimes|string|max:255",
        ]);
        $subject->update($validated);

        return redirect()->route('subjects.index')->with('success', "subject updated successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }
}
