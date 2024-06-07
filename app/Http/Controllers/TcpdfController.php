<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use PhpAidc\LabelPrinter\Enum\Unit;
use PhpAidc\LabelPrinter\Enum\Anchor;
use PhpAidc\LabelPrinter\Enum\Charset;
use PhpAidc\LabelPrinter\Printer;
use PhpAidc\LabelPrinter\Label\Label;
use PhpAidc\LabelPrinter\Label\Element;
use PhpAidc\LabelPrinter\CompilerFactory;
use PhpAidc\LabelPrinter\Connector\NetworkConnector;
use PhpAidc\LabelPrinter\Language\Tspl;
use PhpAidc\LabelPrinter\Language\Fingerprint;

class TcpdfController extends Controller
{
    //
    public function createPDF(Request $request)
    {
        // set certificate file
        // $certificate = 'file://'.base_path().'/public/laragon.crt';
            $certificate = 'file://'.base_path().'/public/server.crt';
                dd($certificate);
                // $certificate = 'file://'.base_path().'/public/tcpdf.crt';
                $certificate2 = 'file://'.base_path().'/public/server.key';
            // $certificate = 'file://'. __DIR__ .'/your/relative/path/to/this/file/tcpdf.crt';

        // set additional information in the signature
        $info = array(
            'Name' => 'Akad Ijaroh',
            'Location' => 'RS YARSI',
            'Reason' => 'Document Legal',
            'ContactInfo' => 'https://rsyarsi.co.id/',
        );

        // set document signature
        PDF::setSignature($certificate, $certificate2, 'tcpdfdemo', '', 2, $info);
        
        PDF::SetFont('helvetica', '', 12);
        PDF::SetTitle('Websolutionstuff');
        PDF::AddPage();

        // print a line of text
        $text = view('tcpdf');

        // add view content
        PDF::writeHTML($text, true, 0, true, 0);

        // add image for signature
        PDF::Image('tcpdf.png', 180, 60, 15, 15, 'PNG');
        
        // define active area for signature appearance
        PDF::setSignatureAppearance(180, 60, 15, 15);
        
        // save pdf file
        PDF::Output(public_path('hello_world.pdf'), 'F');

        PDF::reset();

        dd('pdf created');
    }
    public function tscprinter(){
        $label = Label::create()
 
        ->for(Tspl::class, static function (Label $label) {
            $label->add(Element::textLine(10, 10, 'Hello!', 'ROMAN.TTF', 8));
        })
    ;
    $connector = new NetworkConnector('172.16.40.18',5130);
    $printer = new Printer($connector,CompilerFactory::tspl());
    $printer->print($label); 
        
    }
}
