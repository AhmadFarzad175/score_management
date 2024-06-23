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
        if (!$request['year']) {
            $request['classs_id'] = Classs::latest()->first()->id;
            $request['year'] = date('Y');
            $request['exam_type'] = 0;
        }

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
        $students = collect();

        if (!$request['year']) {
            $request['classs_id'] = Classs::latest()->first()->id;
            $request['year'] = date('Y');
            $request['exam_type'] = 0;
        }

        if ($request->classs_id) {


            $students = Student::leftJoin('attendances', function ($join) use ($request) {
                $join->on('students.id', '=', 'attendances.student_id')
                    ->where('attendances.classs_id', '=', $request->classs_id)
                    ->where('attendances.year', '=', $request->year)
                    ->where('attendances.attendance_type', '=', $request->exam_type);
            })
                ->join('student_details', 'students.id', '=', 'student_details.student_id')
                ->where('student_details.year', $request->year)
                ->where('student_details.classs_id', $request->classs_id)
                ->orderBy('students.first_name')
                ->orderBy('students.father_name')
                ->select(
                    'students.id AS student_id',
                    'students.first_name',
                    'students.father_name',
                    'students.image',
                    'student_details.classs_id',
                    'attendances.id AS attendances_id',
                    'attendances.total_year',
                    'attendances.present',
                    'attendances.absent',
                    'attendances.sick',
                    'attendances.leave',
                    'students.status'
                )
                ->get();
        }

        if (!$students->isEmpty()) {
            //
        } else {
            $students = Student::whereNull('status')
                ->whereHas('studentDetails', function ($query) use ($request) {
                    $query->where('year', $request->year)
                        ->where('classs_id', $request->classs_id);
                })
                ->join('student_details', 'students.id', '=', 'student_details.student_id')
                ->where('student_details.year', $request->year)
                ->where('student_details.classs_id', $request->classs_id)
                ->orderBy('students.first_name')
                ->orderBy('students.father_name')
                ->select(
                    'students.id AS student_id',
                    'students.first_name',
                    'students.father_name',
                    'students.image',
                    'students.status',
                    'student_details.classs_id'
                )
                ->get();
        }
        // dd($students);



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

            // Check if the student is Mahroom or not
            $status = intval($attendance['absent']) > intval($validated['total_year']) * 0.25;
            if ($status) {
                $this->ChangeTheStateToMahroom($studentId);
            }
        }

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
        // $attendance->student->status = "Deleted";
        // $attendance->student->save();
        return redirect()->route('attendances.index')->with('success', 'attendance deleted successfully');
    }
}
