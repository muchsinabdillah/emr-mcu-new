<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Traits\AwsTrait;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Traits\MergePDFTrait;
use App\Http\Service\PdfService;
use App\Traits\StuffTrait;
use Illuminate\Support\Facades\Storage;
use Validator;

class PdfHasilLaboratoriumController extends Controller
{
  use AwsTrait;
  use MergePDFTrait;
  use StuffTrait;
    protected $fpdf;

    public function hasillab($noregistrasi) 
    {
      
        $unitService  = new PdfService();
        $data = $unitService->showviewOrderLabbyNoReg($noregistrasi);

        if ($data['status'] == false){
            return null;
        }

        foreach ($data['data'] as $key) {

        $GLOBALS['header'] = $key;
        
        $dataResult = $unitService->showviewHasilLaboratorium($key['NoLAB']);
        
        if ($dataResult['status'] == false){
          return null;
        }
        //dd($dataResult);exit;
        $GLOBALS['footer'] = [
          'Validate_by' => null ,
          'DT_Order' => null ,
          'DT_Order' => null ,
          'DT_Terima' => null ,
          'DT_Terima' => null ,
          'DT_Validasi' => null ,
          'DT_Validasi' => null ,
          'DT_Cetak' => null ,
          'DT_Cetak' => null ,
        ];
        $pdf = include('../resources/views/pdfview/laboratorium/header.php');
                      
        }

        $rows = array();
        $pasing['NoRegRI'] = $data['data'][0]['NoRegRI'];   
        $pasing['PatientName'] = $data['data'][0]['NoLAB']; 
        $pasing['pdf'] = $pdf;  
        $rows[] = $pasing;
        return $rows;
    }

    public function saveHasilLab($noregistrasi){
      //dd($noregistrasi);
      $data = $this->hasillab($noregistrasi);
      if($data <> null){
        $pathfilename = '../storage/app/LABORATORIUM_'.$data[0]['NoRegRI'].'.pdf';
        $filename = "LABORATORIUM_".$data[0]['NoRegRI'].".pdf";
        $this->fpdf->Output('F',$pathfilename,true);
        $unitService  = new PdfService();
        return  $unitService->uploaPdfMedicalCheckupbyKodeJenis($filename,$data[0]['NoRegRI'],"2");
        exit;
      }else{
          $response = [
              'status' => false, 
              'message' => "Generate PDF Laboratorium Tidak Berhasi, Data Tidak Ada.", 
          ];
          return response()->json($response, 200);
      }
    }

    public function viewHasilLab($noregistrasi){
      $data = $this->hasillab($noregistrasi);
      if($data <> null){
        $fileName = $data[0]['PatientName'].' - '.$data[0]['NoRegRI'].'.pdf';
        $data[0]['pdf']->Output($fileName, 'I');
        exit;
      }else{
        $pdf = include('../resources/views/pdfview/blank.php');
        $pdf->Output('', 'I');
        $response = [
            'status' => false, 
            'message' => "Generate PDF Laboratorium Tidak Berhasi, Data Tidak Ada.", 
        ];
        return response()->json($response, 200);
      }
    }
    
}
