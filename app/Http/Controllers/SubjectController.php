<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ordinary = [
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
        // Retrieve class with id = 4 and relevant student attributes using eager loading
        $subjects = Subject::Where('classs_id', $request->classs_id)->get();
        $classes = Classs::all();

        // Pass the data to the view
        return view('subjects.allSubjects', compact('subjects', 'classes', 'ordinary'));
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
            'classs_id' => "required",
        ]);
        Subject::create($validated);

        return redirect()->route('subjects.index', ['classs_id' => $request->classs_id])->with('success', "subject inserted successfully");
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
        return redirect()->route('subjects.index', ['classs_id' => $subject->classs_id])->with('success', 'Subject deleted successfully');
    }
}
