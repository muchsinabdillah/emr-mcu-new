<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Service\PdfService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDF extends Fpdf {
    function Header() {
        
    	$this->setFont('Arial','',9);
        // $this->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World', 20, 5, 40, 0, 'PNG');
        $this->Image('assets/img/yarsi.png', 20, 10, 60, 0);
        $this->Cell(125,4,'',0,0);
        $this->Cell(64,5,'No. 022/FRM/IRJ/RSY/V/Rev0/2020',1,1);
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
            

            // //BR
            // $this->Cell(0,4,'',0,1);

            // //Garis---
            // $this->SetFont('Arial','U',12);
            // $this->Cell(15,4,'',0,0);
            // $this->Cell(10,1,'                                                                                                                                          ',0,0);
            // $this->Cell(10,3,'',0,1);
            // $this->Cell(10,2,'',0,1);

            // //Line 1
            // $this->SetFont('Arial','B',12);
            // $this->Cell(0,1,'Hasil Pemeriksaan Radiologi',0,0,'C');
            // //BR
            // $this->Cell(0,4,'',0,1);
            // //BR
            // $this->Cell(0,4,'',0,1);

    }
    function Footer() {
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

class PdfHasilPemeriksaanTreadmillController extends Controller
{
    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new PDF;
    }

    public function hasilpemeriksaantreadmill($noregistrasi) 
    {

        $unitService  = new PdfService();
        $data = $unitService->showHasilPemeriksaanTreadmillbyNoReg($noregistrasi);
        //dd($data);
        if($data['status']){
            foreach ($data['data'] as $datareg ) {
                $GLOBALS['header'] = $datareg;
    
                // var_dump($datareg);
    
                $this->fpdf->SetAutoPageBreak(TRUE, 35);
                $this->fpdf->AliasNbPages();
                $this->fpdf->AddPage();
    
    
                $this->fpdf->Cell(0,3,'',0,1);//br
                $this->fpdf->setFont('Arial','BU',10);
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(0,4,'HASIL PEMERIKSAAN TREADMILL STRESS TEST',0,1,'C');
                $this->fpdf->setFont('Arial','',10);
                // $this->fpdf->Cell(0,4,'Nomor.005/YM-OHC/SKKJ/RSY/II/2023',0,1,'C');
                
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(60,5,'IDENTITAS',1,0,'L');
                $this->fpdf->Cell(5,5,'',1,0,'C');
                $this->fpdf->Cell(90,5,'',1,0);
                $this->fpdf->Cell(0,5,'',0,1);
                
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'        No.RM',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['NoMR'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'        Nama Pasien',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5,$datareg['PatientName'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'        Tanggal Lahir (Umur)',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5,'$TanggalLahir'.' -replacethis',1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'        Tanggal Pemeriksaan',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Tanggal'],1,1,'L');
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'A.  ANAMNESIS',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Anamnesis'],1,1,'L');
    
                // $this->fpdf->setFont('Arial','B',10);
                // $this->fpdf->Cell(15,7,'',0,0);
                // $this->fpdf->Cell(60,4,'B.  OBAT_OBATAN YANG',1,0);
                // $this->fpdf->setFont('Arial','',10);
                // $this->fpdf->Cell(5,4,':',1,0,'C');
                // $this->fpdf->Cell(90,4,'$Anamnesis'.' -replacethis',1,1,'L');
                // $this->fpdf->setFont('Arial','B',10);
                // $this->fpdf->Cell(15,7,'',0,0);
                // $this->fpdf->Cell(60,4,'      SEDANG DIGUNAKAN',1,0);
                // $this->fpdf->setFont('Arial','',10);
                // $this->fpdf->Cell(5,4,'',1,0,'C');
                // $this->fpdf->Cell(90,4,'',1,1,'L');
    
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->MultiCell(60,5,'B.  OBAT_OBATAN YANG SEDANG DIGUNAKAN',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Ln(-10);
                $this->fpdf->Cell(75,0,'',0,0);
                $this->fpdf->Cell(5,10,':',1,0,'C');
                // $this->fpdf->Ln(-8);
                // $this->fpdf->Cell(80,0,'',0,0);
                $this->fpdf->MultiCell(90,10, $datareg['Obat_Obatan'],1,1);
    
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'C.  PEMERIKSAAN',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(30,5,'Tekanan Darah',1,0,'L');
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(55,5,$datareg['Tekanan_Darah'].' mmHG',1,1,'L');
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(30,5,'Resting HR',1,0,'L');
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(55,5,$datareg['Resting_HR'].' mmHG',1,1,'L');
    
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'D.  RESTING ECG',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Testing_ECG'],1,1,'L');
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(155,5,'E.  TREADMILL TEST',1,1);
    
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Protocol',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Protokol'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Lama nya Tes',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Lama_Menit'].' Menit'.' '. $datareg['Lama_Detik'].' Detik',1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Alasan Tes Dihentikan',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Alasan_Henti'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Kapasitas Fungsional',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Kapasitas_Fungsional'],1,1,'L');
                
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Respon HR',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Respon_HR'],1,1,'L');
            
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Respon BP',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Respon_BP'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Nyeri Dada',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Nyeri_Dada'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Aritmia',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Aritmia'],1,1,'L');
    
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- ST Change',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['ST_Change'],1,1,'L');
                
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(5,5,'  ',1,0);
                $this->fpdf->Cell(55,5,'- Kesan Keseluruhan ',1,0);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->Cell(90,5, $datareg['Kesan_Keseluruhan'],1,1,'L');
    
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'F.  KESIMPULAN',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->MultiCell(90,5, $datareg['Kesimpulan'],1,1);
    
                $this->fpdf->setFont('Arial','B',10);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(60,5,'G.  SARAN',1,0);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(5,5,':',1,0,'C');
                $this->fpdf->MultiCell(90,5, $datareg['Saran'],1,1);
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Jakarta, 23 Februari 2023',0,1,'C');
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'An. Direktur Rumah Sakit',0,1,'C');
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Dokter yang Memeriksa,',0,1,'C');
                
                $isiqrcode = $datareg['NoMR'];
                $qrcode= QrCode::format('png')->generate($isiqrcode);
                Storage::disk('local')->put($isiqrcode.'.png', $qrcode);
                $gety = $this->fpdf->getY();
                $this->fpdf->Image('../storage/app/'.$isiqrcode.'.png', 140, $gety, 25, 25, "png");
                $this->fpdf->Cell(0,25,'',0,1);
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,$datareg['DokterPemeriksa'],0,1,'C');
            }
            $rows = array();
            $pasing['NOREGISTRASI'] = $datareg['NoRegistrasi'];  
            $pasing['pname'] = 'fff';  
            $rows[] = $pasing;
            return $rows;
        } 
    }

    public function savePemeriksaanTreadmill($noregistrasi){

        $data = $this->hasilpemeriksaantreadmill($noregistrasi);
        if($data <> null){
        $pathfilename = '../storage/app/TREADMILL_'.$noregistrasi.'.pdf';
        $filename = "TREADMILL_".$noregistrasi.".pdf";
        $this->fpdf->Output('F',$pathfilename,true);
        $unitService  = new PdfService();
        return $unitService->uploaPdfMedicalCheckupbyKodeJenis($filename,$noregistrasi,"5");
        exit;
        }else{
            $response = [
                'status' => false, 
                'message' => "Generate PDF Treadmil Tidak Berhasi, Data Tidak Ada.", 
            ];
            return response()->json($response, 200);
        }
    }
  
    public function viewHasilTreadmill($noregistrasi){
        $data = $this->hasilpemeriksaantreadmill($noregistrasi);
        if($data <> null){
            $fileName = $data[0]['pname'].' - '.$noregistrasi.'.pdf';
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
