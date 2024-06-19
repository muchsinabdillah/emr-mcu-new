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
  }
  function Footer() {
      $datenowx = date('d/m/y      H:i');
      // Position at 1.5 cm from bottom
                      $this->SetTextColor(0,0,0);
          $this->SetY(-40);
      $this->SetFont('Arial','',8);

      $this->Image('assets/img/LogoGabungCert.png',155,260,50);
      $this->Image('assets/img/footer_1.png',1,283,208, 13);
  }
}


$fpdf = new PDF('p','mm','A4');
$fpdf->AddPage();

$fpdf->SetFont('Arial','BI',12);
$fpdf->Cell(0,50,'Not Found','0','1','C');


return $fpdf;