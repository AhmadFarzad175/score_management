<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use Illuminate\Http\Request;
use App\Http\Requests\ClasssRequest;
use Illuminate\Support\Facades\Config;

class ClasssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classs::latest()->get();
        return view('classes.allClasses', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasssRequest $request)
    {
        $validated = $request->validated();
        Classs::create($validated);


        return redirect()->route('classes.index')->with('success', "Class inserted successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Classs $class)
    {
        return response()->json($class);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classs $classs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClasssRequest $request, Classs $classs)
    {
        dd($classs);
        $validated = $request->validated();
        $classs->update();
        
        return redirect()->back()->with('success', "Class updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classs $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully');
    }
}
