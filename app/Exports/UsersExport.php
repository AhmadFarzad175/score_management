<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UsersExport implements WithEvents
{
    protected $data;
    protected $filePath;

    public function __construct($data, $filePath)
    {
        $this->data = $data;
        $this->filePath = $filePath;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                foreach ($this->data as $cell => $value) {
                    $sheet->setCellValue($cell, $value);
                }
            },
        ];
    }

    public function export()
    {
        // Load the existing spreadsheet
        $spreadsheet = IOFactory::load($this->filePath);

        // Get the first sheet (or specify a different sheet if needed)
        $sheet = $spreadsheet->getActiveSheet();

        // Insert the data into the specified cells
        foreach ($this->data as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Save the modified spreadsheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $outputFilePath = storage_path('app/public/modified_ScoreResult.xlsx');
        $writer->save($outputFilePath);

        // Return the path to the modified file
        return $outputFilePath;
    }
}
