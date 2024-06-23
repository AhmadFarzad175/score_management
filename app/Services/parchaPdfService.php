<?php

namespace App\Services;

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

class ParchaPdfService
{
    protected $mpdf;

    public function __construct()
    {
        // Define the path to your font directory
        $fontDirs = (new ConfigVariables())->getDefaults()['fontDir'];
        $fontDirs[] = storage_path('fonts');

        // Define the available font data
        $fontData = (new FontVariables())->getDefaults()['fontdata'];
        $fontData['vazir'] = [
            'R' => 'Lalezar-Regular.ttf',
            'B' => 'vazir-bold.ttf',
        ];

        // Initialize mPDF with RTL and bidi support
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

    public function generatePdf($html, $filename = 'parcha.pdf', $outputMode = 'I')
    {

        $this->mpdf->WriteHTML($html);
        return $this->mpdf->Output($filename, $outputMode); // 'I' for inline view, 'D' for download
    }
}
