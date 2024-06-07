<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfMergeController extends Controller
{
    public function process(Request $request) {
            Storage::disk('local')->put('first.pdf',file_get_contents('http://www.africau.edu/images/default/sample.pdf'));
            Storage::disk('local')->put('second.pdf',file_get_contents('http://www.africau.edu/images/default/sample.pdf'));
             $pdf = PDF::loadView('pdfview');
            Storage::disk('local')->put('testttttt.pdf',$pdf->download('pdfview.pdf'));
        $files = [Storage::disk('local')->path("first.pdf"), Storage::disk('local')->path('second.pdf'), Storage::disk('local')->path('testttttt.pdf')];
        $this->merge($files,Storage::disk('local')->path('Gabung.pdf'));
        return response()->file(Storage::disk('local')->path('Gabung.pdf'));
    }

    public function merge($files, $outputPath)
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
    public function pdfview(Request $request)
    {
       // $items = DB::table("items")->get();
        //view()->share('items',$items);

        // GENERATE PDF LAB
        //if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return Storage::disk('local')->put('testttttt.pdf',$pdf->download('pdfview.pdf'));
        // }

        // GENERATE PDF RAD
        

        return view('pdfview');
    }
}
