<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function export(Request $request)
    {
        $row = ['K','O', 'S', 'X'];
        $students = Student::with(['classs', 'scores', 'attendances'])
        ->whereNull('students.status')
        ->whereHas('scores', function ($query) use ($request) {
            $query->where('exam_type', $request->exam_type);
        })
        ->whereHas('attendances', function ($query) use ($request) {
            $query->where('classs_id', $request->classs_id);
        })
        ->where('students.classs_id', $request->classs_id)
        ->get();
        dd($students);
        // Path to the existing Excel file
        $filePath = storage_path('app/public/ScoreResult.xlsx');
        
        // Load the existing Excel file
        $spreadsheet = IOFactory::load($filePath);
        
        // Get the active sheet (or you can specify a sheet by name or index)
        $sheet = $spreadsheet->getActiveSheet();
        
        // Insert data into the desired cell
        $cellValue = $sheet->getCell('I27')->getValue();
        $sheet->setCellValue('K5', $cellValue);
        $sheet->setCellValue('FS14', '1978-07-08');
        // $sheet->setCellValue('B1', 'This is a test'); 
        
        // Path to save the modified file
        $savePath = storage_path('app/public/Result.xlsx');
        
        // Save the modified file
        $writer = new Xlsx($spreadsheet);
        $writer->save($savePath);
        
        return response()->download($savePath);  
    }
}
