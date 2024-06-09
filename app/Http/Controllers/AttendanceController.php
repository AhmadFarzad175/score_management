<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use App\Models\Attendance;
use App\Traits\ChangeStates;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;

class AttendanceController extends Controller
{
    use ChangeStates;
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        // dd($request);
        // Fetch attendances only if a class ID is provided
        if ($request->classs_id) {
            $students = student::join('attendances', 'students.id', '=', 'attendances.student_id')
                ->where('attendances.classs_id', $request->classs_id)
                ->where('attendances.year', $request->year)
                ->where('attendances.attendance_type', $request->exam_type)
                ->orderBy('first_name')
                ->orderBy('father_name')
                ->get();
        } else {
            $students = []; // If class ID is not provided, return an empty array
        }
        // dd($students);

        return view('attendances.allAttendance', compact('students'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request);
        $students = collect();
        if ($request->classs_id) {


            $students = student::leftJoin('attendances', function ($join) use ($request) {
                $join->on('students.id', '=', 'attendances.student_id')
                    ->where('attendances.classs_id', '=', $request->classs_id)
                    ->where('attendances.year', '=', $request->year)
                    ->where('attendances.attendance_type', '=', $request->exam_type);
            })
                ->where('students.classs_id', $request->classs_id)
                ->orderBy('first_name')
                ->orderBy('father_name')
                ->select(
                    'students.id AS student_id',
                    'first_name',
                    'father_name',
                    'image',
                    'students.classs_id',
                    'attendances.id AS attendances_id',
                    'total_year',
                    'present',
                    'absent',
                    'sick',
                    'leave'
                )
                ->get();
        }

        // dd($students);
        if (!$students->isEmpty()) {
            //
        } else {
            $students = student::where('classs_id', $request->classs_id)
                ->orderBy('first_name')
                ->orderBy('father_name')
                ->select('students.id AS student_id', 'first_name', 'father_name', 'image', 'classs_id')
                ->get();
        }

        // dd($attendances);

        return view('attendances.createAttendance', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        // dd($request);
        $validated = $request->validated();
        // dd($request->classs_id);

        // Loop through the validated attendance data
        foreach ($validated['attendances'] as $studentId => $attendance) {

            $attendanceData = [
                'year' => $validated['year'],
                'attendance_type' => $validated['exam_type'],
                'total_year' => $validated['total_year'],
                'student_id' => $studentId,
                'classs_id' => $validated['classs_id'],
                'present' => $attendance['present'],
                'absent' => $attendance['absent'],
                'sick' => $attendance['sick'],
                'leave' => $attendance['leave'],
            ];


            // Check if the attendance record exists for the student and year
            $existingAttendance = Attendance::where('student_id', $studentId)
                ->where('classs_id', $request->classs_id)
                ->where('year', $validated['year'])
                ->where('attendance_type', $validated['exam_type'])
                ->first();

            if ($existingAttendance) {
                // Update existing attendance record
                $existingAttendance->update($attendanceData);
                $this->ChangeTheStateToNull($studentId);
            } else {
                // Create new attendance record
                Attendance::create($attendanceData);
            }
            // dd($existingAttendance);

            // Check if the student is Mahroom or not
            $status = intval($attendance['absent']) > intval($validated['total_year']) * 0.25;
            if ($status) {
                $this->ChangeTheStateToMahroom($studentId);
            }
        }

        // Redirect back with a success message or any other action you desire
        return redirect()->route('attendances.index', ['classs_id' => $validated['classs_id'], 'year' => $validated['year'], 'exam_type' => $validated['exam_type']])->with('success', 'Attendance inserted successfully');
    }




    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return Attendance::with('student:id,first_name')
            ->firstWhere('id', $attendance->id);
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
    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        $validated = $request->validated();
        // dd($validated);
        $attendance->update($validated);

        $status = intval($attendance['absent']) > $attendance['total_year'] * 0.25;
        if ($status) {
            $this->ChangeTheStateToMahroom($attendance->student_id);
        } else {
            $this->ChangeTheStateToNull($attendance->student_id);
        }

        return redirect()->back()->with('success', "attendance updated successfully");
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
