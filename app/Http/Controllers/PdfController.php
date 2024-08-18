<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Classs;
use App\Models\Student;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Mpdf\Config\FontVariables;
use Mpdf\Config\ConfigVariables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PdfController extends Controller
{
    use ResultTrait;
    protected $mpdf;

    public function __construct()
    {
        // Initialize mPDF with RTL and bidi support
        $fontDirs = (new ConfigVariables())->getDefaults()['fontDir'];
        $fontDirs[] = storage_path('fonts');

        $fontData = (new FontVariables())->getDefaults()['fontdata'];
        $fontData['vazir'] = [
            'R' => 'vazir.ttf',
        ];

        $this->mpdf = new Mpdf([
            'fontDir' => $fontDirs,
            'fontdata' => $fontData,
            'default_font' => 'vazir',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'showWatermarkText' => true,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'mirrorMargins' => true,
            'mode' => 'utf-8',
            'directionality' => 'rtl',
            'default_font_size' => 12,
        ]);
    }

    public function generateParchaPdf(Request $request)
    {
        $year = $request->year ?: date('Y');
        $exam_type = $request->exam_type ?: 0;
        $classs = $request->classs_id ? Classs::find($request->classs_id) : Classs::latest()->first();

        $studentsRaw = $this->getStudentsRaw($year, $exam_type, $classs);

        $students = [];
        $counter = 1;

        $this->midTermResult($studentsRaw);

        foreach ($studentsRaw as $student) {
            // Throw an error message for less subjects
            if ($student->subject_count < 17 && $student->subject_count > 0) {
                throw ValidationException::withMessages([
                    'subject_count' => "Students have less score data"
                ]);
            }

            // Assuming only one attendance record per student
            $attendance = $student->attendances->first();

            // Initialize an array to hold the scores for the student
            $studentScores = [];

            foreach ($student->scores as $score) {
                $studentScores[$score->subject->abb] = $score->mark;
            }

            $dobShamsi = Jalalian::fromCarbon(\Carbon\Carbon::parse($student->dob))->format('Y-m-d');

            // Combine the scores and the rest of the student data
            $students[] = array_merge($studentScores, [
                'number' => $counter,
                'id' => $student->id,
                'first_name' => $student->first_name,
                'first_name_en' => $student->first_name_en,
                'last_name' => $student->last_name,
                'last_name_en' => $student->last_name_en,
                'father_name' => $student->father_name,
                'father_name_en' => $student->father_name_en,
                'grand_father' => $student->grand_father,
                'dob' => $student->dob,
                'dobShamsi' => $dobShamsi,
                'base_number' => $student->base_number,
                'tazkira_number' => $student->tazkira_number,
                'main_residence' => $student->mainResidence->name,
                'status' => $student->status,
                'classs_name' => $classs->name,
                'negaran' => $classs->negaran,
                'year' => $year,
                'total_year' => $attendance ? $attendance->total_year : 0,
                'present' => $attendance ? $attendance->present : 0,
                'absent' => $attendance ? $attendance->absent : 0,
                'leave' => $attendance ? $attendance->leave : 0,
                'sick' => $attendance ? $attendance->sick : 0,
                'total_marks' => $student->total_marks,
                'marks_under_16' => $student->marks_under_16,
                'subject_count' => $student->subject_count,
                'average_marks' => $student->average_marks,
                'grade' => $student->grade,
                'result' => $student->result,
            ]);

            $counter++;
        }



        // Initialize an empty array to store HTML for each page
        $htmlPages = [];

        // Loop to generate HTML content for each page
        foreach ($students as $student) {
            $htmlPages[] = view('pdf.parcha', $student)->render();
        }

        // Use the $this->mpdf instance initialized in the constructor
        $mpdf = $this->mpdf;

        foreach ($htmlPages as $html) {
            $mpdf->WriteHTML($html);
            $mpdf->AddPage();
        }

        // Output the PDF
        return $mpdf->Output('parcha.pdf', 'I'); // 'I' for inline view, 'D' for download
        // Your PDF generation logic here
    }

    public function generateJadwalPdf(Request $request)
    {
        $year = $request->year ?: date('Y');
        $exam_type = $request->exam_type ?: 0;
        $classs = $request->classs_id ? Classs::find($request->classs_id) : Classs::latest()->first();

        $studentsRaw = $this->getStudentsRaw($year, $exam_type, $classs);

        $students = [];
        $tempGroup = [];
        $counter = 1;

        foreach ($studentsRaw as $student) {
            // Throw an error message for less subjects
            if ($student->subject_count < 17 && $student->subject_count > 0) {
                throw ValidationException::withMessages([
                    'subject_count' => "Students have less score data"
                ]);
            }

            // Assuming only one attendance record per student
            $attendance = $student->attendances->first();

            // Initialize an array to hold the scores for the student
            $studentScores = [];
            foreach ($student->scores as $score) {
                $studentScores[$score->subject->abb] = $score->mark;
            }

            $dobShamsi = Jalalian::fromCarbon(\Carbon\Carbon::parse($student->dob))->format('Y-m-d');

            // Combine the scores and the rest of the student data
            $studentData = array_merge($studentScores, [
                'number' => $counter,
                'id' => $student->id,
                'first_name' => $student->first_name,
                'first_name_en' => $student->first_name_en,
                'last_name' => $student->last_name,
                'last_name_en' => $student->last_name_en,
                'father_name' => $student->father_name,
                'father_name_en' => $student->father_name_en,
                'grand_father' => $student->grand_father,
                'dob' => $student->dob,
                'dobShamsi' => $dobShamsi,
                'base_number' => $student->base_number,
                'tazkira_number' => $student->tazkira_number,
                'main_residence' => $student->mainResidence->name,
                'status' => $student->status,
                'classs_name' => $classs->name,
                'negaran' => $classs->negaran,
                'year' => $year,
                'total_year' => $attendance ? $attendance->total_year : 0,
                'present' => $attendance ? $attendance->present : 0,
                'absent' => $attendance ? $attendance->absent : 0,
                'leave' => $attendance ? $attendance->leave : 0,
                'sick' => $attendance ? $attendance->sick : 0,
                'total_marks' => $student->total_marks,
                'marks_under_16' => $student->marks_under_16,
                'subject_count' => $student->subject_count,
                'average_marks' => $student->average_marks,
                'grade' => $student->grade,
                'result' => $student->result,
            ]);

            $tempGroup[] = $studentData;
            $counter++;

            // When we have 3 students, combine them into one record
            if (count($tempGroup) === 3) {
                $combinedStudent = [];
                for ($i = 0; $i < 3; $i++) {
                    foreach ($tempGroup[$i] as $key => $value) {
                        $combinedStudent["{$key}_" . ($i + 1)] = $value;
                    }
                }
                $students[] = $combinedStudent;
                $tempGroup = []; // Reset the temporary group
            }
        }

        // Handle any remaining students (if the total count isn't a multiple of 3)
        if (count($tempGroup) > 0) {
            $combinedStudent = [];
            for ($i = 0; $i < count($tempGroup); $i++) {
                foreach ($tempGroup[$i] as $key => $value) {
                    $combinedStudent["{$key}_" . ($i + 1)] = $value;
                }
            }
            $students[] = $combinedStudent;
        }

        // Generate and return the view
        return view('pdf.jadwal', ['students' => $students]);
    }



    private function getStudentsRaw($year, $exam_type, $classs)
{
    $studentsRaw = Student::with([
        'scores' => function ($query) use ($year, $classs, $exam_type) {
            $query->where('classs_id', $classs->id)
                ->where('year', $year)
                ->where('exam_type', $exam_type);
        },
        'scores.subject' => function ($query) {
            $query->select('id', 'name', 'abb');
        },
        'mainResidence' => function ($query) {
            $query->select('id', 'name');
        },
        'attendances' => function ($query) use ($year, $classs) {
            $query->where('year', $year)
                ->where('classs_id', $classs->id)
                ->where('attendance_type', 0);
        }
    ])
    ->whereHas('studentDetails', function ($query) use ($year, $classs) {
        $query->where('year', $year)
            ->where('classs_id', $classs->id);
    })
    ->selectRaw('
        students.*, 
        COALESCE((
            SELECT SUM(mark)
            FROM scores
            WHERE scores.student_id = students.id
            AND (scores.exam_type = 0)
            AND scores.year = ?
        ), 0) as total_marks,
        COALESCE((
            SELECT COUNT(*)
            FROM (
                SELECT student_id, subject_id, SUM(mark) as total_subject_marks
                FROM scores
                WHERE (scores.exam_type = 0)
                AND scores.year = ?
                GROUP BY student_id, subject_id
                HAVING SUM(mark) < 16
            ) as subject_totals
            WHERE subject_totals.student_id = students.id
        ), 0) as marks_under_16,
        COALESCE((
            SELECT COUNT(DISTINCT subject_id)
            FROM scores
            WHERE scores.student_id = students.id
            AND scores.exam_type = ?
            AND scores.year = ?
        ), 0) as subject_count
    ', [$year, $year, $exam_type, $year])
    ->orderBy('total_marks', 'desc')
    ->get();

    $this->midTermResult($studentsRaw);

    return $studentsRaw;
}

}






    // public function generateJadwalPdf(Request $request)
    // {
    //     // $html = view('pdf.jadwal')->render(); // Ensure you have a view file 'resources/views/pdf/jadwal.blade.php'

    //     // // Use the $this->mpdf instance initialized in the constructor
    //     // $mpdf = $this->mpdf;

    //     // // Write the single HTML content to the PDF
    //     // $mpdf->WriteHTML($html);

    //     // // Output the PDF
    //     // return $mpdf->Output('jadwal.pdf', 'I');


    //     // $year = $request->year ? $request->year : date('Y');
    //     // $exam_type = $request->exam_type ? $request->exam_type : 0;
    //     // $classs = $request->classs_id ? Classs::find($request->classs_id) : Classs::latest()->first();



    //     $students = [];









    //     // Initialize an empty array to store HTML for each page
    //     $htmlPages = [];

    //     // Loop to generate HTML content for each page
    //     for ($i = 0; $i < 3; $i++) {
    //         $htmlPages[] = view('pdf.jadwal')->render();
    //     }

    //     // Use the $this->mpdf instance initialized in the constructor
    //     $mpdf = $this->mpdf;

    //     foreach ($htmlPages as $html) {
    //         $mpdf->WriteHTML($html);
    //         $mpdf->AddPage();
    //     }

    //     // Output the PDF
    //     return $mpdf->Output('jadwal.pdf', 'D'); // 'I' for inline view, 'D' for download
    // }




    // public function generateJadwalPdf(Request $request)
    // {
    //     $year = $request->year ? $request->year : date('Y');
    //     $exam_type = $request->exam_type ? $request->exam_type : 0;
    //     $classs = $request->classs_id ? Classs::find($request->classs_id) : Classs::latest()->first();

    //     // Validate year and exam_type to be numeric
    //     if (!is_numeric($year) || !is_numeric($exam_type)) {
    //         return response()->json(['error' => 'Invalid year or exam type.'], 400);
    //     }

    //     $students = []; // Assuming you will populate this later

    //     // Initialize an empty array to store HTML for each page
    //     $htmlPages = [];

    //     // Loop to generate HTML content for each page
    //     for ($i = 0; $i < 3; $i++) {
    //         $html = view('pdf.jadwal')->render();

    //         // Check if the HTML content is empty
    //         if (empty($html)) {
    //             return response()->json(['error' => 'Rendered HTML content is empty.'], 500);
    //         }

    //         $htmlPages[] = $html;
    //     }

    //     // Check if the $htmlPages array is populated
    //     if (empty($htmlPages)) {
    //         return response()->json(['error' => 'HTML pages array is empty.'], 500);
    //     }

    //     // Use the $this->mpdf instance initialized in the constructor
    //     $mpdf = $this->mpdf;

    //     // Iterate through each HTML page content and add it to the PDF
    //     foreach ($htmlPages as $index => $html) {
    //         // Add the page content
    //         $mpdf->WriteHTML($html);

    //         // Add a new page after each page except the last one
    //         if ($index < count($htmlPages) - 1) {
    //             $mpdf->AddPage();
    //         }
    //     }

    //     // Output the PDF
    //     return $mpdf->Output('jadwal.pdf', 'D'); // 'I' for inline view, 'D' for download
    // }
