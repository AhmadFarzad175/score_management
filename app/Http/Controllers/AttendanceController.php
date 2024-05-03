<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\Attendance;
use App\Traits\ChangeStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AttendanceRequest;

class AttendanceController extends Controller
{
    use ChangeStates;
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $classes = Classs::all();

        $years = Attendance::select(DB::raw('year'))->distinct()->orderBy('year','desc')->get();
        // Fetch attendances only if a class ID is provided
        if ($request->filled('classs_id')) {
            $attendances = Attendance::with('student')
                ->where('classs_id', $request->classs_id)
                ->where('year', $request->year)
                ->get();
        } else {
            $attendances = []; // If class ID is not provided, return an empty array
        }
        return view('attendances.allAttendance', compact('attendances', 'classes', 'years'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $classes = Classs::all();
        if ($request['classs_id']) {
            $students = Student::where('classs_id', $request['classs_id'])->orderBy('first_name')->orderBy('father_name')->get();
            return view('attendances.createAttendance', compact('classes', 'students'));
        }

        $students = [];
        return view('attendances.createAttendance', compact('classes', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {

        $validated = $request->validated();

        // Loop through the validated attendance data
        foreach ($validated['attendances'] as $studentId => $attendance) {


            // Create new attendance record if not found
            Attendance::create([
                'year' => $validated['year'],
                'total_educational_year' => $validated['total_year'],
                'student_id' => $studentId,
                'classs_id' => Request('classs_id'),
                'present' => $attendance['present'],
                'absent' => $attendance['absent'],
                'sick' => $attendance['sick'],
                'leave' => $attendance['leave'],
            ]);

            //CHECK IF THE STUDENT IS MAHROOM OR NOT
            $status = intval($attendance['absent']) > intval($validated['total_year']) * 0.25;
            if ($status) {
                $this->ChangeTheStateToMahroom($studentId);
            }
        }

        // Redirect back with a success message or any other action you desire
        return redirect()->route('attendances.index', ['classs_id' => $request->classs_id, 'year' => $validated['year']])->with('success', 'Attendance inserted successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        $attendance->student->status = "Deleted";
        $attendance->student->save();
        return redirect()->route('attendances.index')->with('success', 'attendance deleted successfully');
    }
}
