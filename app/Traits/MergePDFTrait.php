<?php

namespace App\Traits;

use Aws\S3\S3Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequisition;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

trait MergePDFTrait
{
    //Your Function Here
    public function mergePdfFiles($files, $outputPath)
    { 
        $fpdi = new FPDI;
        foreach ($files as $file) {
            $filename  = $file;
            $count = $fpdi->setSourceFile($filename);
            for ($i=1; $i<=$count; $i++) {
                $template   = $fpdi->importPage($i);
                $size       = $fpdi->getTemplateSize($template);
                $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                $fpdi->useTemplate($template);
            }

        }
        $fpdi->Output($outputPath, 'F');
    } 
}
