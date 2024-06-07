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
        $this->Cell(64,5,'No. 023/FRM/IRJ/RSY/V/Rev0/2020',1,1);
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

class PdfSuketBebasNarkoba extends Controller
{
    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new PDF;
    }

    public function hasilbebasnarkoba($noregistrasi) 
    {
        $unitService  = new PdfService();
        $data = $unitService->showHasilSKBBbyNoReg($noregistrasi);
        if($data['status']){
            foreach ($data['data'] as $datareg ) {
                $GLOBALS['header'] = $datareg;
    
                $this->fpdf->SetAutoPageBreak(TRUE, 35);
                $this->fpdf->AliasNbPages();
                $this->fpdf->AddPage();
    
                $this->fpdf->Cell(0,3,'',0,1);//br
                $this->fpdf->setFont('Arial','BU',10);
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(0,4,'SURAT KETERANGAN BEBAS NARKOBA',0,1,'C');
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->Cell(0,4,'Nomor.005/YM-OHC/SKKJ/RSY/II/2023',0,1,'C');
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->Cell(0,4,'Saya dokter di Rumah Sakit ini, Telah Melakukan Pemeriksaan Terhadap :',0,1);
                $this->fpdf->Cell(0,3,'',0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Nama',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['NamaDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Tempat, Tgl Lahir',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['TglLlahirDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Usia',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['UsiaDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Jenis Kelamin',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['JeniskelaminDiperiksa'],0,1);
    
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Pekerjaan',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->Cell(0,4, $datareg['PekerjaanDiperiksa'],0,1);
                
                $this->fpdf->Cell(18,7,'',0,0);
                $this->fpdf->Cell(35,4,'Alamat',0,0);
                $this->fpdf->Cell(6,4,':',0,0);
                $this->fpdf->MultiCell(0,4, $datareg['AlamatDiperiksa'],0,1);
    
                $datenow = date('d/m/Y H:i:s');
                
                $count = 0;
                if ($datareg['Amphetamine'] <> 'Tidak Dilakukan'){
                   $count += 1;
                 }

                 if ($datareg['THC'] <> 'Tidak Dilakukan'){
                    $count += 1;
                 }

                 if ($datareg['Benzodiazepine'] <> 'Tidak Dilakukan'){
                    $count += 1;
                 }

                 if ($datareg['Cocain'] <> 'Tidak Dilakukan'){
                    $count += 1;
                 }
                 
                 if ($datareg['Metamphetamine'] <> 'Tidak Dilakukan'){
                    $count += 1;
                 }

                 if ($datareg['Morphine'] <> 'Tidak Dilakukan'){
                    $count += 1;
                 }

                 $hari = date('l', strtotime($datareg['Day']));
                    if ($hari == 'Sunday'){
                        $day = 'Minggu';
                    }elseif($hari == 'Monday'){
                        $day = 'Senin';
                    }elseif($hari == 'Tuesday'){
                        $day = 'Selasa';
                    }elseif($hari == 'Wednesday'){
                        $day = 'Rabu';
                    }elseif($hari == 'Thursday'){
                        $day = 'Kamis';
                    }elseif($hari == 'Friday'){
                        $day  = 'Jumat';
                    }elseif($hari == 'Saturday'){
                        $day = 'Sabtu';
                    }
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->MultiCell(0,4,'Berdasarkan hasil pemeriksaan pasien dinyatakan, bahwa hasil uji laboratorium menggunakan metode uji cepat dengan '.$count.' parameter yang dilakukan pada, hari : '.$day.' '. date('d/m/Y', strtotime($datareg['Day'])).' di RS YARSI.',0,1);
                $this->fpdf->Cell(0,5,'',0,1);

                if ($datareg['Amphetamine'] <> 'Tidak Dilakukan'){
                    $this->fpdf->Cell(0,5,'',0,1);
                    $this->fpdf->Cell(25,7,'',0,0);
                    $this->fpdf->Cell(35,4,'Ampthetamine',0,0);
                    $this->fpdf->Cell(6,4,':',0,0);
                    $this->fpdf->MultiCell(0,4, $datareg['Amphetamine'],0,1);
                 }

                 if ($datareg['THC'] <> 'Tidak Dilakukan'){
                    $this->fpdf->Cell(0,5,'',0,1);
                    $this->fpdf->Cell(25,7,'',0,0);
                    $this->fpdf->Cell(35,4,'THC',0,0);
                    $this->fpdf->Cell(6,4,':',0,0);
                    $this->fpdf->MultiCell(0,4, $datareg['THC'],0,1);
                 }

                 if ($datareg['Benzodiazepine'] <> 'Tidak Dilakukan'){
                    $this->fpdf->Cell(0,5,'',0,1);
                    $this->fpdf->Cell(25,7,'',0,0);
                    $this->fpdf->Cell(35,4,'Benzodiazepine',0,0);
                    $this->fpdf->Cell(6,4,':',0,0);
                    $this->fpdf->MultiCell(0,4, $datareg['Benzodiazepine'],0,1);
                 }

                 if ($datareg['Cocain'] <> 'Tidak Dilakukan'){
                    $this->fpdf->Cell(0,5,'',0,1);
                    $this->fpdf->Cell(25,7,'',0,0);
                    $this->fpdf->Cell(35,4,'Cocain',0,0);
                    $this->fpdf->Cell(6,4,':',0,0);
                    $this->fpdf->MultiCell(0,4, $datareg['Cocain'],0,1);
                 }
                 
                 if ($datareg['Metamphetamine'] <> 'Tidak Dilakukan'){
                    $this->fpdf->Cell(0,5,'',0,1);
                    $this->fpdf->Cell(25,7,'',0,0);
                    $this->fpdf->Cell(35,4,'Metamphetamine',0,0);
                    $this->fpdf->Cell(6,4,':',0,0);
                    $this->fpdf->MultiCell(0,4, $datareg['Metamphetamine'],0,1);
                 }

                 if ($datareg['Morphine'] <> 'Tidak Dilakukan'){
                    $this->fpdf->Cell(0,5,'',0,1);
                    $this->fpdf->Cell(25,7,'',0,0);
                    $this->fpdf->Cell(35,4,'Morphine',0,0);
                    $this->fpdf->Cell(6,4,':',0,0);
                    $this->fpdf->MultiCell(0,4, $datareg['Morphine'],0,1);
                 }
    
                $this->fpdf->Cell(0,10,'',0,1);
                $this->fpdf->Cell(15,7,'',0,0);
                $this->fpdf->MultiCell(0,4,'Demikian surat ini untuk dapat dipergunakan sebagaimana mestinya.',0,1);
                
                $this->fpdf->Cell(0,7,'',0,1);
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Jakarta,' .' '.$datareg['Dates'],0,1,'C');
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Kepala Instalasi,',0,1,'C');
                $this->fpdf->Cell(100,4,'',0,0);
                $this->fpdf->Cell(0,4,'Occupational Health Center',0,1,'C');

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

    public function saveBebasNarkoba($noregistrasi){
        $data = $this->hasilbebasnarkoba($noregistrasi); 
        if($data <> null){
            $pathfilename = '../storage/app/SKBN_'.$data[0]['NOREGISTRASI'].'.pdf';
            $filename = "SKBN_".$data[0]['NOREGISTRASI'].".pdf";
            $this->fpdf->Output('F',$pathfilename,true);
            $unitService  = new PdfService(); 
            return $unitService->uploaPdfMedicalCheckupbyKodeJenis($filename,$data[0]['NOREGISTRASI'],"8");
            exit;
        }else{
            $response = [
                'status' => false, 
                'message' => "Generate PDF Surat bebas Narkoba Tidak Berhasi, Data Tidak Ada.", 
            ];
            return response()->json($response, 200);
        }
       
    }
  
    public function viewBebasNarkoba($noregistrasi){
        $data = $this->hasilbebasnarkoba($noregistrasi);
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
