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

class PdfSuketKesehatanJiwaController extends Controller
{
    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new PDF;
    }

    public function hasilsuketjiwa($noregistrasi)
    {

        $unitService  = new PdfService();
        $data = $unitService->showHasilKesehatanJiwabyNoReg($noregistrasi);
        if($data['status']){
            foreach ($data['data'] as $datareg ) {

                // var_dump($datareg);
    
                $GLOBALS['header'] = $datareg;
    
                $this->fpdf->SetAutoPageBreak(TRUE, 35);
                $this->fpdf->AliasNbPages();
                $this->fpdf->AddPage();
    
                $this->fpdf->Cell(0,3,'',0,1);//br
                $this->fpdf->setFont('Arial','BU',10);
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(0,4,'SURAT KETERANGAN KESEHATAN JIWA',0,1,'C');
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(0,4,'Nomor.005/YM-OHC/SKKJ/RSY/II/2023',0,1,'C');
                
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(0,4,'Saya yang bertanda tangan di bawah ini :',0,1);
                $this->fpdf->Cell(0,3,'',0,1);
                
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Nama',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['drPemeriksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'SIP',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['SIPDokter'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Jabatan',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['JabatanDokter'],0,1);
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(0,4,'Atas permintaan tertulis dari :',0,1);
                $this->fpdf->Cell(0,3,'',0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Nama',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['NamaPermintaan'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Jabatan',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['JabatanPermintaan'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Instansi',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->MultiCell(0,4, $datareg['InstansiPermintaan'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Nomor Surat',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['NomorSuratpermintaan'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Perihal',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->MultiCell(0,4, $datareg['PerihalPermintaan'],0,1);
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(0,4,'Telah melakukan pemeriksaan terhadap :',0,1);
                $this->fpdf->Cell(0,3,'',0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Nama',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['NamaDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Tgl Lahir',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['TglLlahirDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Status Pernikahan',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['StatusPernikahanDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Agama',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['AgamaDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Jenis Kelamin',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['JeniskelaminDiperiksa'],0,1);
                
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Alamat',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->MultiCell(0,4, $datareg['AlamatDiperiksa'],0,1);
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(0,4,'Berdasarkan pemeriksaan klinis dan MMPI-2 (Minessota Multiphasic Personality Inventory) pada tanggal',0,1);
                // $this->fpdf->Cell(15,7,'',0,0);
                // $this->fpdf->Cell(45,4,'29 Mei 2020, menyatakan bahwa nama tersebut di atas, saat ini',1,0);
                // $this->fpdf->MultiCell(0,4,'Tidak Ditemukan Adanya Gangguan Jiwa (Psikopatologi) Bermakna Yang Mengganggu Fungsi Dan Aktivitas Sehari-Hari.',1,1);
    
                // $this->fpdf->Rect($this->fpdf->GetX(),$this->fpdf->GetY(),2,0.1);
                $this->fpdf->SetFont('Arial','',10);
                $this->fpdf->Write(5,'$tglpemeriksaan, menyatakan bahwa nama tersebut di atas, saat ini ');
                $this->fpdf->SetFont('Arial','B',10);
                $this->fpdf->Write(5,'Tidak Ditemukan Adanya Gangguan Jiwa (Psikopatologi) Bermakna Yang Mengganggu Fungsi Dan Aktivitas Sehari-Hari.');
                //$this->fpdf->Ln();
    
                $this->fpdf->SetFont('Arial','',10);
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(65,4,'Surat keterangan ini dibuat sebagai :',0,0);
                $this->fpdf->SetFont('Arial','BU',10);
                $this->fpdf->MultiCell(100,4, $datareg['Tujuan'],0,0);
    
                $this->fpdf->SetFont('Arial','',10);
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(0,4,'Demikianlah surat keterangan kesehatan jiwa ini dibuat agar dapat digunakan sebagaimana mestinya.',0,1);
    
                
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Jakarta, 23 Februari 2023',0,1,'C');
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'An. Direktur Rumah Sakit',0,1,'C');
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Dokter yang Memeriksa,',0,1,'C');

                $isiqrcode = $datareg['NamaDiperiksa'];
                $qrcode= QrCode::format('png')->generate($isiqrcode);
                Storage::disk('local')->put($isiqrcode.'.png', $qrcode);
                $gety = $this->fpdf->getY();
                $this->fpdf->Image('../storage/app/'.$isiqrcode.'.png', 140, $gety, 25, 25, "png");
                $this->fpdf->Cell(0,25,'',0,1);
                
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4, $datareg['drPemeriksa'],0,1,'C');
    
            }
    
            $rows = array();
            $pasing['NOREGISTRASI'] = 'ddd';  
            $pasing['pname'] = 'fff';  
            $rows[] = $pasing;
            return $rows;
        }
    }

    public function saveSuketJiwa($noregistrasi){
        $data = $this->hasilsuketjiwa($noregistrasi);  
        if($data <> null){
            $pathfilename = '../storage/app/SKKJ_'.$data[0]['NOREGISTRASI'].'.pdf';
            $filename = "SKKJ_".$data[0]['NOREGISTRASI'].".pdf";
            $this->fpdf->Output('F',$pathfilename,true);
            $unitService  = new PdfService(); 
            return $unitService->uploaPdfMedicalCheckupbyKodeJenis($filename,$data[0]['NOREGISTRASI'],"9");
            exit;
        }else{
            $response = [
                'status' => false, 
                'message' => "Generate PDF Surat bebas Narkoba Tidak Berhasi, Data Tidak Ada.", 
            ];
            return response()->json($response, 200);
        }
    }
  
    public function viewSuketJiwa($noregistrasi){
        $data = $this->hasilsuketjiwa($noregistrasi);
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
