<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\parchaPdfService;
use Illuminate\Support\Facades\DB;


class PdfController extends Controller
{
    protected $parchaPdfService;

    public function __construct(parchaPdfService $parchaPdfService)
    {
        $this->parchaPdfService = $parchaPdfService;
    }

    public function generateParchaPdf(Request $request)
    {
        $year = $request->year ? $request->year : date('Y');
        $exam_type = $request->exam_type ? $request->exam_type : 0;
        $classs_id = $request->classs_id ? $request->classs_id : Classs::latest()->first()->id;

        $students = Student::with(['scores' => function ($query) use ($year, $classs_id, $exam_type) {
            $query->where('classs_id', $classs_id)
                ->where('year', $year)
                ->where('exam_type', $exam_type);
        }, 'scores.subject' => function ($query) {
            $query->select('id', 'name');
        }, 'attendances' => function ($query) use ($year, $classs_id) {
            $query->where('year', $year)
                ->where('classs_id', $classs_id)
                ->where('attendance_type', 0);
        }])
            ->whereHas('studentDetails', function ($query) use ($year, $classs_id) {
                $query->where('year', $year)
                    ->where('classs_id', $classs_id);
            })
            ->get();

        dd($students);

        $html = view('pdf.parcha')->render(); // Assume you have a view file 'resources/views/pdf/template.blade.php'
        return $this->parchaPdfService->generatePdf($html);
    }
}
