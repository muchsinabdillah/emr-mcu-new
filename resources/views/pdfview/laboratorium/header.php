<?php 
class PDF extends FPDF {
  
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
          $this->SetY(-40);
      // $this->SetFont('Arial','U',8);
      // $this->Cell(15,4,'',0,0);
      // $this->Cell(10,4,'                                                                                                                                              Clinical Pathologist :'.$GLOBALS['header']['Validate_by'],0,1);
      $this->SetFont('Arial','',8);
      // $this->Cell(15,4,'',0,0);
      // $this->Cell(65,4,'Validated by :'.$GLOBALS['header']['Validate_by'],0,0);
      // $this->Cell(55,4,'*(do not need sign)',0,0);
      // $this->Cell(35,4,$datenowx,0,1);
      // $this->Cell(15,4,'',0,0);

      $validateby = $GLOBALS['footer']['Validate_by'];
      
      $dt_order_tgl = date('d/m/y', strtotime($GLOBALS['footer']['DT_Order']));
      $dt_order_jam = date('H:i', strtotime($GLOBALS['footer']['DT_Order']));
      $dt_terima_tgl = date('d/m/y', strtotime($GLOBALS['footer']['DT_Terima']));
      $dt_terima_jam = date('H:i', strtotime($GLOBALS['footer']['DT_Terima']));
      $dt_validasi_tgl = date('d/m/y', strtotime($GLOBALS['footer']['DT_Validasi']));
      $dt_validasi_jam = date('H:i', strtotime($GLOBALS['footer']['DT_Validasi']));
      $dt_cetak_tgl = date('d/m/y', strtotime($GLOBALS['footer']['DT_Cetak']));
      $dt_cetak_jam = date('H:i', strtotime($GLOBALS['footer']['DT_Cetak']));
      if ($dt_cetak_tgl == '01/01/70'){
        $dt_cetak_tgl = date('d/m/y');
        $dt_cetak_jam = date('H:i');
    }

      $this->Cell(0,4,'Clinical Pathologists : Dr. Syukrini Bahri SpPK, Dr. Endah Purnamasari SpPK, Dr. Dewi Lesthiowati SpPK(K), DR. Dr. Anggraini Iriani SpPK(K)','B',1);
      //$this->SetFont('','',8);
      $this->Cell(10,4,'',0,0);
      $this->Cell(0,4,'*This document has been electronically validated',0,1);
      $this->Cell(10,4,'',0,0);
      $this->Cell(35,4,'Received Time',0,0);
      $this->Cell(2,4,':',0,0);
      $this->Cell(0,4,$dt_terima_tgl.'    '.$dt_terima_jam,0,1);

      $this->Cell(10,4,'',0,0);
      $this->Cell(35,4,'Validation Time',0,0);
      $this->Cell(2,4,':',0,0);
      $this->Cell(25,4,$dt_validasi_tgl.'    '.$dt_validasi_jam,0,0);
      $this->Cell(62,4,'by '.$validateby,0,1);

      $this->Cell(10,4,'',0,0);
      $this->Cell(35,4,'Result Print Time',0,0);
      $this->Cell(2,4,':',0,0);
      $this->Cell(25,4,$dt_cetak_tgl.'    '.$dt_cetak_jam,0,0);
      $this->Cell(62,4,'by '.$validateby,0,1);

      $this->Cell(55,4,'002/FRM/LAB/RSY/Rev0/II/2020',0,0);
      $this->Image('assets/img/LogoGabungCert.png',155,260,50);
      $this->Image('assets/img/footer_1.png',1,283,208, 13);
  }

  //Cell with horizontal scaling if text is too wide
  function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
  {
            //Get string width
            if ($txt == ''){
              $str_width=1;
          }else{
              $str_width=$this->GetStringWidth($txt);
          }
      //Get string width
      //$str_width=$this->GetStringWidth($txt);

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


$fpdf = new PDF('p','mm','A4');
$fpdf->SetAutoPageBreak(TRUE, 45);
$fpdf->AliasNbPages();
$fpdf->AddPage();

$first = true;
                     $lastitem = '';
                     $ispcr = false;
                     $no = 1;
                     foreach ($dataResult['data'] as $row) {
                      if ($no == 1){
                        $GLOBALS['footer'] = $row;
                        $no++;
                      }
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
                        $fpdf->SetFont('Arial','B',10);
                        $fpdf->Cell(15,5,'',0,0);
                        $fpdf->CellFitScale(78,5,$chapter,0,1);
                        $name = $row['Nama Tes'];
                        $contentxx = 3;
                        }

                        $lastitem = $chapter;
                        
                        //Content-----
                        if($row['FLAG']==''){
                            $color = $fpdf->SetTextColor(0,0,0);
                          }elseif($row['FLAG']=='N'){
                            $color = $fpdf->SetTextColor(0,0,0);
                          }else{
                            $color = $fpdf->SetTextColor(214,0,0);
                          }
                        $color;

                        $fpdf->SetFont('Arial','',10);
                        $fpdf->Cell(15,5,'',0,0);
                        $fpdf->CellFitScale(78,5,$name,0,0);
                         $fpdf->SetTextColor(0,0,0);
                        
                        if($row['HASIL'] == null){
                          $hasil = ' ';
                        }else{
                          $hasil = $row['HASIL'];
                          $hasil = str_replace("\.br\\", "\r\n", $hasil);
                        }

                        $count_str = strlen($row['HASIL']);

                        if($count_str > 15){
                          $fpdf->MultiCell(100,5,$hasil,0,1);
                        //netral kan lagi warnanya

                        }else{
                          $fpdf->CellFitScale(18,5,$hasil,0,0,'C');
                        $fpdf->Cell(7,5,'',0,0,'C');
                        //netral kan lagi warnanya
                       
                        $fpdf->Cell(10,5,$row['SATUAN'],0,0,'C');
                        $fpdf->Cell(7,5,'',0,0,'C');
                        $fpdf->Cell(40,5,$row['NILAI_RUJUKAN'],0,1,'C');

                        }
                        
                        //versi 2-----
                        if (trim($row['KOMENTAR_HASIL']) != '' && $row['pcr'] == '1'){
                        $fpdf->Cell(95,5,'',0,0,'C');
                        $fpdf->Cell(0,5,'('.$row['KOMENTAR_HASIL'].')',0,1,'L');
                        }

                        //versi 2-----
                        if ( $row['pcr'] == '1'){
                            $fpdf->Cell(15,5,'',0,0,'C');
                            $fpdf->SetFont('Arial','',9);
                            if (strpos($name, 'Antigen') !== false){
                                $keterangan = 'Specimen collection is done by Swab Oropharyngeal';
                            }else{
                                $keterangan = 'Specimen collection is done by Swab Nasopharyngeal and Oropharyngeal';
                            }
                            $fpdf->MultiCell(70,5,$keterangan,0,1);
                            }

                        if ($row['pcr'] == '1'){
                          $ispcr = true;
                        }
                    }


                    if ($ispcr){
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'Notes:',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'This result is based on the conditions',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'when taking the specimen.',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'If you experience clinical symptoms or',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'having contact with an infected patient,',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'please contact the nearest doctor or',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'health care.',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'Re-examination/ check-up can be done',0,1);
                        $fpdf->Cell(115,4,'',0,0);
                        $fpdf->Cell(40,4,'based on doctor`s recommendation.',0,1);
                        }

return $fpdf;