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

class PDF extends Fpdf {
  
    function Header() {
        
        //$this->Image(url('../public/images/yarsi.png'),10,8,50);
        //$this::Image(URL::to('src/images/timbreCDDOC.png'),10,6,30);
                        $this->SetTextColor(0,0,0);
        $this->Image('assets/img/yarsi.png', 20, 10, 60, 0);
        $this->Ln(-2);
    	$this->setFont('Arial','',9);

        $this->Cell(125,4,'',0,0);
        $this->Cell(59 ,5,'Jl. Letjen Soeprapto kav XIII Cempaka Putih,',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(34 ,4,'Jakarta Pusat 10510',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(30 ,4,'Phone (021) 80618618',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(34 ,4,'Fax (021) 80618619',0,1);

        $this->Cell(125,4,'',0,0);
        $this->Cell(34 ,4,'www.rsyarsi.co.id',0,1);
        //Margin top
            $this->Cell(10,12,'',0,1);
            //Line 1
            $this->SetFont('Arial','B',12);
            $this->Cell(0,7,'LABORATORY RESULT',0,0,'C');

            //BR
            $this->Cell(0,4,'',0,1);

            //Garis---
            $this->SetFont('Arial','U',12);
            $this->Cell(15,4,'',0,0);
            $this->Cell(10,1,'                                                                                                                                          ',0,0);
            $this->Cell(10,3,'',0,1);

            

        $this->Cell(10,3,'',0,1);
      $this->SetFont('Arial','',10);
      //row 1 (left)-------------------
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Name',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(2,0,':',0,0);
      $this->CellFitScale(58,0,$GLOBALS['header']['PatientName'] == null ? '-' : $GLOBALS['header']['PatientName'],0,0);
      //row 1 (right)
      $this->Cell(10,0,'Request Lab',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(0,0,': '.$GLOBALS['header']['NoLAB'],0,1);

      //row 2 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Medical Record',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(60,0,': '.$GLOBALS['header']['NoMR'],0,0);
      //row 2 (right)
      $this->Cell(10,0,'Doctor',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(2,0,':',0,0);
      $this->CellFitScale(0,0,$GLOBALS['header']['NamaDokter'] == null ? '-' : $GLOBALS['header']['NamaDokter'],0,1);

      //row 3 (left)-----------------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'BirthDate/Age',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(35,0,': '.date('d/m/Y', strtotime($GLOBALS['header']['DateOfBirth'])),0,0);
      $this->Cell(25,0,'('.$GLOBALS['header']['as_year'].'Y)',0,0);
      //row 3 (right)
      $this->Cell(10,0,'Location',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(2,0,':',0,0);
      $this->CellFitScale(0,0,$GLOBALS['header']['locname'] == null ? '-' : $GLOBALS['header']['locname'],0,1);

      if ($GLOBALS['header']['Sex'] == 'P'){
        $gender = 'Female';
      }else{
        $gender = 'Male';
      }

      //row 4 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Gender',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(60,0,': '.$gender,0,0);
      //row 4 (right)
      $this->Cell(10,0,'Payer',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(2,0,':',0,0);
      $this->CellFitScale(0,0,$GLOBALS['header']['asuransi'] == null ? '-' : $GLOBALS['header']['asuransi'],0,1);

      //$this->Cell(1,0,'',0,0);
      //$this->Cell(80,0,$tipepasien,0,1);

      //row 4 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Address',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(2,0,':',0,0);
      $this->CellFitScale(58,0,$GLOBALS['header']['Alamat'] == null ? '-' : $GLOBALS['header']['Alamat'],0,0);
      //row 4 (rigth)--------------------
      //row 4 (right)
      $this->Cell(10,0,'Order Date',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(0,0,': '.date('d/m/Y', strtotime($GLOBALS['header']['request_dt'])),0,1);

      //row 5 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Phone / Email',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(60,0,': '.$GLOBALS['header']['MobilePhone'],0,0);
      //row 5 (rigth)--------------------
      $this->Cell(10,0,'Page',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(0,0,': '.$this->PageNo().'/{nb}',0,1);
      //nama jaminan jika Anda

      //row 6 (left)---------------------
      $this->Cell(10,5,'',0,1);
      $this->Cell(15,7,'',0,0);
      $this->Cell(10,0,'Identity Type',0,0);
      $this->Cell(15,0,'',0,0);
      if ($GLOBALS['header']['TipeIdCard'] == 'PASPORT'){
        $tipecard = 'PASSPORT';
      }else{
        $tipecard = $GLOBALS['header']['TipeIdCard'];
      }
      $this->Cell(60,0,': '.$tipecard,0,0);
      //row 6 (rigth)--------------------
      //row 6 (right)
      $this->Cell(10,0,'Identity Number',0,0);
      $this->Cell(15,0,'',0,0);
      $this->Cell(0,0,': '.$GLOBALS['header']['NoIdCard'],0,1);

      //blank

      //BR
      $this->Cell(0,2,'',0,1);

      //Garis---
      $this->SetFont('Arial','U',12);
      $this->Cell(15,4,'',0,0);
      $this->Cell(10,1,'                                                                                                                                          ',0,0);
      $this->Cell(10,3,'',0,1);

      //Header-------------------------
      $this->SetFont('Arial','B',10);
      $this->Cell(15,4,'',0,0);
      $this->Cell(78,4,'LABORATORY TEST',0,0);
      $this->Cell(18,4,'RESULT',0,0,'C');
      $this->Cell(7,4,'',0,0,'C');
      $this->Cell(10,4,'UNIT',0,0,'C');
      $this->Cell(7,4,'',0,0,'C');
      $this->Cell(40,4,'REFERENCE RANGE',0,1,'C');
      //$this->Cell(26,4,'Keterangan',0,1,'R');
      $this->SetFont('Arial','U',10);
      $this->Cell(15,4,'',0,0);
      $this->Cell(10,0,'                                                                                                                                                                     ',0,1);
      $this->Cell(10,3,'',0,1);
      //#End Header----------------------
    }
    function Footer() {
    	$datenowx = date('d/m/y      H:i');
        // Position at 1.5 cm from bottom
                        $this->SetTextColor(0,0,0);
            $this->SetY(-37);
        $this->SetFont('Arial','U',8);
        $this->Cell(15,4,'',0,0);
        $this->Cell(10,4,'                                                                                                                                              Clinical Pathologist :'.$GLOBALS['header']['Validate_by'],0,1);
        $this->SetFont('Arial','',8);
        $this->Cell(15,4,'',0,0);
        $this->Cell(65,4,'Validated by :'.$GLOBALS['header']['Validate_by'],0,0);
        $this->Cell(55,4,'*(do not need sign)',0,0);
        $this->Cell(35,4,$datenowx,0,1);
        $this->Cell(15,4,'',0,0);
        $this->Cell(55,4,'002/FRM/LAB/RSY/Rev0/II/2020',0,0);
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

class PdfController extends Controller
{
  use AwsTrait;
  use MergePDFTrait;
  use StuffTrait;
    protected $fpdf;
 
    public function __construct()
    {
        
        $this->fpdf = new PDF('p','mm','A4');
    }

    public function hasillab($noregistrasi) 
    {

        $unitService  = new PdfService();
        $data = $unitService->showviewOrderLabbyNoReg($noregistrasi);
        
        
        foreach ($data['data'] as $key) {
          //var_dump($key);exit;

        $GLOBALS['header'] = $key;
        
        $dataResult = $unitService->showviewHasilLaboratorium($key['NoLAB']);

        $this->fpdf->SetAutoPageBreak(TRUE, 35);
        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();
        
                     $first = true;
                     $lastitem = '';
                     $ispcr = false;
                     foreach ($dataResult['data'] as $row) {
                    $contentx = 15;
                    $contentxx = 0;
                    
                        $contentx = 15;
                        $contentxx = 0;


                         $chapter = $row['CHAPTER'];

                        if ($lastitem==$chapter) {
                            $name = $row['Nama Tes'];
                            $contentxx = 3;
                        } else {
                            //Judul--------------->>>>>
                        $this->fpdf->SetFont('Arial','B',10);
                        $this->fpdf->Cell(15,5,'',0,0);
                        $this->fpdf->CellFitScale(78,5,$chapter,0,1);
                        $name = $row['Nama Tes'];
                        $contentxx = 3;
                        }

                        $lastitem = $chapter;
                        
                        //Content-----
                        if($row['FLAG']==''){
                            $color = $this->fpdf->SetTextColor(0,0,0);
                          }elseif($row['FLAG']=='N'){
                            $color = $this->fpdf->SetTextColor(0,0,0);
                          }else{
                            $color = $this->fpdf->SetTextColor(214,0,0);
                          }
                        $color;

                        $this->fpdf->SetFont('Arial','',10);
                        $this->fpdf->Cell(15,5,'',0,0);
                        $this->fpdf->CellFitScale(78,5,$name,0,0);
                         $this->fpdf->SetTextColor(0,0,0);
                        
                        if($row['HASIL'] == null){
                          $hasil = ' ';
                        }else{
                          $hasil = $row['HASIL'];
                        }

                        $count_str = strlen($row['HASIL']);

                        if($count_str > 15){
                          $this->fpdf->MultiCell(100,5,$hasil,0,1);
                        //netral kan lagi warnanya

                        }else{
                          $this->fpdf->CellFitScale(18,5,$hasil,0,0,'C');
                        $this->fpdf->Cell(7,5,'',0,0,'C');
                        //netral kan lagi warnanya
                       
                        $this->fpdf->Cell(10,5,$row['SATUAN'],0,0,'C');
                        $this->fpdf->Cell(7,5,'',0,0,'C');
                        $this->fpdf->Cell(40,5,$row['NILAI_RUJUKAN'],0,1,'C');

                        }
                        
                        //versi 2-----
                        if (trim($row['KOMENTAR_HASIL']) != '' && $row['pcr'] == '1'){
                        $this->fpdf->Cell(95,5,'',0,0,'C');
                        $this->fpdf->Cell(0,5,'('.$row['KOMENTAR_HASIL'].')',0,1,'L');
                        }

                        //versi 2-----
                        if ( $row['pcr'] == '1'){
                            $this->fpdf->Cell(15,5,'',0,0,'C');
                            $this->fpdf->SetFont('Arial','',9);
                            if (strpos($name, 'Antigen') !== false){
                                $keterangan = 'Specimen collection is done by Swab Oropharyngeal';
                            }else{
                                $keterangan = 'Specimen collection is done by Swab Nasopharyngeal and Oropharyngeal';
                            }
                            $this->fpdf->MultiCell(70,5,$keterangan,0,1);
                            }

                        if ($row['pcr'] == '1'){
                          $ispcr = true;
                        }
                    }


                    if ($ispcr){
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'Notes:',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'This result is based on the conditions',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'when taking the specimen.',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'If you experience clinical symptoms or',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'having contact with an infected patient,',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'please contact the nearest doctor or',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'health care.',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'Re-examination/ check-up can be done',0,1);
                        $this->fpdf->Cell(115,4,'',0,0);
                        $this->fpdf->Cell(40,4,'based on doctor`s recommendation.',0,1);
                      //   $pdf->Cell(115,4,'',0,0);
                      //   $pdf->Cell(40,4,'Specimen collection is done',0,1);
                      //   $pdf->Cell(115,4,'',0,0);
                      //   $pdf->Cell(40,4,'by SWAB Nasopharyngeal and Oropharyngeal',0,1);
                        }
  
                       
  
                        $this->fpdf->SetFont('Arial','',10);
                        $this->fpdf->Cell(15,6,'',0,0);
                        $this->fpdf->Cell(10,2,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _',0,1);
  
                          $datenow2 = date('d/m/Y H.i.s');
  
                        $this->fpdf->SetFont('Arial','I',8);
                        $this->fpdf->Cell(15,6,'',0,0);
                        $this->fpdf->Cell(42,6,'Sampling Date :'.date('d/m/y', strtotime($GLOBALS['header']['DT_Terima'])),0,0);
                        $this->fpdf->Cell(42,6,'Sampling Time :'.date('H:i', strtotime($GLOBALS['header']['DT_Terima'])),0,0);
                        $this->fpdf->Cell(42,6,'Release Date :'.date('d/m/y', strtotime($GLOBALS['header']['DT_Validasi'])),0,0);
                        $this->fpdf->Cell(42,6,'Release Time :'.date('H:i', strtotime($GLOBALS['header']['DT_Validasi'])),0,1);
                        $this->fpdf->Cell(15,6,'',0,0);
                        $this->fpdf->Cell(50,6,'',0,0);
                        $this->fpdf->Cell(35,6,'',0,0);
                        $this->fpdf->Cell(40,6,'Print Date :',0,0,'R');
                        $this->fpdf->Cell(40,6,'Jakarta '.$datenow2,0,0);
                      }

                        $rows = array();
                        $pasing['NoRegRI'] = $data['data'][0]['NoRegRI'];   
                        $pasing['PatientName'] = $data['data'][0]['NoLAB'];   
                        $rows[] = $pasing;
                        return $rows;
         
        //$this->fpdf->Output();

        //exit;
    }

    public function saveHasilLab($noregistrasi){
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
              'message' => "Generate PDF Surat bebas Narkoba Tidak Berhasi, Data Tidak Ada.", 
          ];
          return response()->json($response, 200);
      }
    }

    public function viewHasilLab($noregistrasi){
      $data = $this->hasillab($noregistrasi);
      if($data <> null){
        $fileName = $data[0]['PatientName'].' - '.$data[0]['NoRegRI'].'.pdf';
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
    
    public function mergehasilmcu($noregistrasi) {

      // BIKIN API BUAT LOOPING DATA FILES
      $unitService  = new PdfService();
      $data = $unitService->listDocumentMCU($noregistrasi);
      $rows = array();
      foreach ($data['data'] as $key ) {
        $files[] = storage_path() . "/app/". $key['Url_Pdf_Local'];
      }
  
      $filenameMerge = "GabungHasilMCU_".$noregistrasi.".pdf";
      $this->mergePdfFiles($files,Storage::disk('local')->path($filenameMerge));
    
      $urlfiles = $this->UploadtoAWS($filenameMerge);
      $unitService  = new PdfService();

      foreach ($data['data'] as $key ) {
        unlink(storage_path() . "/app/". $key['Url_Pdf_Local']);
      }
      
      unlink(storage_path('app/'.$filenameMerge));
      return  $unitService->uploaPdfHasilMCUFinish($urlfiles,$noregistrasi);
      //return response()->file(Storage::disk('local')->path('GabungHasilMCU.pdf'));

    }
    public function listDocumentMCU(Request $request){
      $unitService  = new PdfService();
      $data = $unitService->listDocumentMCU($request->NoRegistrasi);
      return $data['data'];
    }
    public function uploadPDFMCU(Request $request){
      
      $validation = Validator::make($request->all(), [
        'select_file' => 'required|mimes:pdf|max:10000'
       ]);
       if($validation->passes())
       {
            $image = $request->file('select_file');
            $namadocument = $this->NamaDocumentConvert($request->jenisdocument);
            $new_name = $namadocument.$request->noregistrasi. '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/'), $new_name);
            $unitService  = new PdfService();
            $unitService->uploaPdfMedicalCheckupbyKodeJenis($new_name,$request->noregistrasi,$request->jenisdocument);
            return response()->json([
            'message'   => 'Image Upload Successfully',
            'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
            'class_name'  => 'alert-success'
            ]);
       }
       else
       {
            return response()->json([
            'message'   => $validation->errors()->all(),
            'uploaded_image' => '',
            'class_name'  => 'alert-danger'
            ]);
       }
    }
    public function listDocumentMCUPDFReport(Request $request){
      $unitService  = new PdfService();
      $data = $unitService->listDocumentMCUPDFReport($request);
      return $data['data'];
    }


    // public function getRegistrationMCUbyDate($data = null)
    // {
    //     $unitService  = new PdfService();
    //     $dataunit = $unitService->getRegistrationMCUbyDate($data);
    //     $dataJO = json_decode(json_encode((object) $dataunit['data']), FALSE);
    //     return view('main.mcu.pdfmcu', [
    //         'data' => $dataJO,
    //     ]);
    // }

    public function getRegistrationMCUbyDate(Request $request){
      $unitService  = new PdfService();
      $data = $unitService->getRegistrationMCUbyDate($request);
      return $data['data'];
    }

    
}
