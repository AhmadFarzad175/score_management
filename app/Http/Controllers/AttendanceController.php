<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Attendance;
use App\Traits\ChangeStates;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    use ChangeStates;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Retrieve class with id = 4 and relevant student attributes using eager loading
        $attendances = Attendance::with(['student:id,first_name,father_name,status'])
            ->whereHas('student', function ($query) {
                $query->where('classs_id', 4);
            })
            ->get();

        // Pass the data to the view
        return view('attendances.allAttendance', compact('attendances'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve class with id = 4 and relevant student attributes using eager loading
        $classes = Classs::with(['students'])
            ->where('id', 4)
            ->first();


        // Pass the data to the view
        return view('attendances.createAttendance', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        $validated = $request->validated();

        // Loop through the validated attendance data
        foreach ($validated['classes'] as $studentId => $attendance) {


            // Create new attendance record if not found
            Attendance::create([
                'year' => $validated['year'],
                'total_educational_year' => $validated['total_year'],
                'student_id' => $studentId,
                'present' => $attendance['present'],
                'absent' => $attendance['absent'],
                'sick' => $attendance['sick'],
                'leave' => $attendance['leave'],
            ]);

            //CHECK IF THE STUDENT IS MAHROOM OR NOT
            $status = intval($attendance['absent']) > intval($validated['total_year']) * 0.25;
            if($status){
                $this->ChangeTheStateToMahroom($studentId);

            }
        }

        // Redirect back with a success message or any other action you desire
        return redirect()->route('attendances.index')->with('success', 'Attendance inserted successfully.');
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
