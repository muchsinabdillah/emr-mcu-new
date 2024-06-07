<?php

namespace App\Http\Controllers;
use App\Traits\AwsTrait;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Http\Service\PdfService;
use Illuminate\Support\Facades\Storage;

class PDF extends Fpdf {
    function Header() {
        
    	$this->setFont('Arial','',9);
        // $this->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World', 20, 5, 40, 0, 'PNG');
        $this->Image('assets/img/yarsi.png', 20, 10, 60, 0);
        $this->Cell(125,4,'',0,0);
        $this->Cell(59 ,5,'Jl. Letjen Soeprapto kav XIII Cempaka Putih,',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(34 ,4,'Jakarta Pusat 10510',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(30 ,4,'Telp : 021 80618618 / 80618618 (Hunting).',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(34 ,4,'Fax  : 021 4243172',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(34 ,4,'www.rsyarsi.co.id',0,1);
        //Margin top
            
            //BR
            $this->Cell(0,4,'',0,1);

            //Garis---
            $this->SetFont('Arial','U',12);
            $this->Cell(15,4,'',0,0);
            $this->Cell(10,1,'                                                                                                                                          ',0,0);
            $this->Cell(10,3,'',0,1);
            $this->Cell(10,2,'',0,1);

            //Line 1
            $this->SetFont('Arial','B',12);
            $this->Cell(0,1,'RADIOLOGY RESULT',0,0,'C');
            //BR
            $this->Cell(0,4,'',0,1);
            //BR
            $this->Cell(0,4,'',0,1);


        $this->Cell(10,1,'',0,1);
      $this->SetFont('Arial','',10);
      //row 1 (left)-------------------
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Name',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(60,0,': '.$GLOBALS['header']['PATIENT_NAME'],0,0);
      //row 1 (right)
      $this->Cell(10,0,'No. Order',0,0);
      $this->Cell(17,0,'',0,0);
      $this->Cell(0,0,': '.$GLOBALS['header']['WOID'] . ' / ' . $GLOBALS['header']['PATIENT_LOCATION'],0,1);

      //row 2 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Medical Record',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(60,0,': '.$GLOBALS['header']['MRN'],0,0);
      //row 2 (right)
      $this->Cell(10,0,'Accession No',0,0);
      $this->Cell(17,0,'',0,0);
      $this->Cell(0,0,': '.$GLOBALS['header']['ACCESSION_NO'],0,1);

      //row 3 (left)-----------------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'BirthDate ',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(20,0,': '.date('d/m/Y', strtotime( $GLOBALS['header']['DateOfBirth'])),0,0);
      $this->Cell(15,0,' ',0,0);
      $this->Cell(25,0,' ',0,0);
      //row 3 (right)
      $this->Cell(10,0,'Order Date',0,0);
      $this->Cell(17,0,'',0,0);
      $this->Cell(0,0,': '.date('d/m/Y H:i:s', strtotime( $GLOBALS['header']['ORDER_DATE'])),0,1);

      //row 4 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'No. Register',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(60,0,': '.$GLOBALS['header']['NOREGISTRASI'],0,0);
      //row 4 (right)
      $this->Cell(10,0,'Doctor',0,0);
      $this->Cell(17,0,'',0,0);
      $this->Cell(0,0,': '.$GLOBALS['header']['NamaDokter'],0,1);

      //blank

        //BR
        $this->Cell(0,4,'',0,1);

        //Garis---
        $this->SetFont('Arial','U',12);
        $this->Cell(15,4,'',0,0);
        $this->Cell(10,1,'                                                                                                                                          ',0,0);
        $this->Cell(10,3,'',0,1);
        $this->Cell(10,2,'',0,1);
    }
    function Footer() {
    	$datenowx = date('d/m/y      H:i');
        // Position at 1.5 cm from bottom
                        $this->SetTextColor(0,0,0);
            $this->SetY(-37);
        $this->SetFont('Arial','U',8);
        $this->Cell(15,4,'',0,0);
        $this->Cell(10,4,'                                                                                                                                           Approved by Radiologist : dr. Tia Bonita Sp.Rad' ,0,1);
        $this->SetFont('Arial','',8);
        $this->Cell(15,4,'',0,0);
        //$this->Cell(65,4,'Validated by :'.$GLOBALS['footer']['Validate_by'],0,0);
        $this->Cell(65,4,'Taken by Radiographer:',0,0);
        $this->Cell(55,4,'*(do not need sign)',0,0);
        $this->Cell(35,4,$datenowx,0,1);
        $this->Cell(15,4,'',0,0);
        $this->Cell(55,4,'Sri Mulyani,A.Md.Rad',0,0);
        $this->Image('assets/img/footer2.png',175,265,30);
        $this->Image('assets/img/footer_1.png',1,283,208, 13);
    }

    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

      //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
    }
}

class PdfHasilRadiologiController extends Controller
{
    protected $fpdf;
    use AwsTrait;
    public function __construct()
    {
        $this->fpdf = new PDF;
    }

    public function hasilradiologi($noregistrasi) 
    {
        $unitService  = new PdfService();
        $data = $unitService->showviewOrderRadbyNoReg($noregistrasi);
        //$GLOBALS['header'] = $data['data'][0];
  
        foreach ($data['data'] as $datareg ) {
            $GLOBALS['header'] = $datareg;

            $this->fpdf->SetAutoPageBreak(TRUE, 35);
            $this->fpdf->AliasNbPages();
            $this->fpdf->AddPage();

            
             $dataHasil = $unitService->showviewHasilRadiology($datareg['ACCESSION_NO']);
             if ($dataHasil['status'] == true){
             $viewHasilAd = $dataHasil['data'];
             
            $REPORT_TEXT = $viewHasilAd['REPORT_TEXT'];
            $CONCLUSION = $viewHasilAd['CONCLUSION'];

//$this->fpdf->Image('../../img/bismillah.png',80,30,50,'C');
//pdf->Ln(10);

$this->fpdf->Cell(0,3,'',0,1);//br
$this->fpdf->setFont('Arial','',10);
      $this->fpdf->Cell(15,7,'',0,0);
      $this->fpdf->Cell(25,6,'Diagnose',0,0);
      $this->fpdf->Cell(3,6,':',0,0);
      //diagnosa
      $this->fpdf->MultiCell(141,6,$datareg['DIAGNOSIS'],0,1);
      $this->fpdf->Cell(0,1,'',0,1);//br

       //row 6-------------------
      $this->fpdf->Cell(15,7,'',0,0);
      $this->fpdf->Cell(25,6,'Examination ',0,0);
      $this->fpdf->Cell(3,6,':',0,0);
      //pemeriksaan
      $this->fpdf->Cell(0,6,$datareg['SCHEDULED_PROC_DESC'],0,1);
      $this->fpdf->Cell(0,5,'',0,1);//br
      $this->fpdf->Cell(43,6,'',0,0);
      $this->fpdf->MultiCell(141,6,$REPORT_TEXT,0,1);
      $this->fpdf->Cell(0,5,'',0,1);//br


      //Garis---
      $this->fpdf->SetFont('Arial','U',12);
      $this->fpdf->Cell(43,4,'',0,0);
      $this->fpdf->Cell(10,1,'                                                                                                                      ',0,0);
      $this->fpdf->Cell(10,1,'',0,1);
      $this->fpdf->Cell(10,1,'',0,1);
      
    //   new line

      $this->fpdf->Cell(0,1,'',0,1);//br
      $this->fpdf->setFont('Arial','',10);

      $this->fpdf->Cell(15,7,'',0,0);
      $this->fpdf->Cell(25,6,'',0,0);
      $this->fpdf->Cell(3,1,'',0,0);
      $this->fpdf->MultiCell(141,6,$CONCLUSION,0,1);
      $this->fpdf->Cell(0,1,'',0,1);//br
    }
       
       
        //Storage::put('public/pdf/invoice.pdf', $this->fpdf->Output());
        //$this->fpdf->Output('F','../storage/app/'.$datareg['ACCESSION_NO'].'.pdf',true); 

        // Storage::disk('local')->put('first.pdf',$this->fpdf->Output());
        //Storage::disk('local')->put('public/'.$datareg['ACCESSION_NO'].'.pdf',$this->fpdf->Output());
        //exit;
        }
        $rows = array();
        $pasing['NOREGISTRASI'] = $data['data'][0]['NOREGISTRASI'];  
        $pasing['pname'] = $data['data'][0]['PATIENT_NAME'];  
        $rows[] = $pasing;
        return $rows;

       // $this->fpdf->Output();
    }

    public function saveHasilRadiologi($noregistrasi){
        $data = $this->hasilradiologi($noregistrasi);
        if($data <> null){
            $pathfilename = '../storage/app/RADIOLOGI_'.$data[0]['NOREGISTRASI'].'.pdf';
            $filename = "RADIOLOGI_".$data[0]['NOREGISTRASI'].".pdf";
            $this->fpdf->Output('F',$pathfilename,true); 
            $unitService  = new PdfService(); 
            return $unitService->uploaPdfMedicalCheckupbyKodeJenis($filename,$data[0]['NOREGISTRASI'],"3");
            exit;
        }else{
            $response = [
                'status' => false, 
                'message' => "Generate PDF Surat bebas Narkoba Tidak Berhasi, Data Tidak Ada.", 
            ];
            return response()->json($response, 200);
        }
    }
  
    public function viewHasilRadiolgi($noregistrasi){
        $data = $this->hasilradiologi($noregistrasi);
        if($data <> null){
            $fileName = $data[0]['pname'].' - '.$data[0]['NOREGISTRASI'].'.pdf';
            $this->fpdf->Output($fileName, 'I');
            exit;
        }else{
            $response = [
                'status' => false, 
                'message' => "Generate PDF Surat bebas Narkoba Tidak Berhasi, Data Tidak Ada.", 
            ];
            return response()->json($response, 200);
        }
    }
}
