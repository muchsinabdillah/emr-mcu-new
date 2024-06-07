<?php

namespace App\Http\Controllers;

use App\Traits\AwsTrait;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Dompdf\FrameDecorator\Page;
use App\Http\Service\PdfService;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PDF extends Fpdf
{
    function Header()
    {
        
        $this->Image('assets/img/yarsi.png', 7, 7, 42, 0);
        $this->Ln(-7);
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

        if ( $this->PageNo() >2 ) {
            //Margin top
        $this->Cell(10, 12, '', 0, 1);
        // $this->Cell(10, 3, '', 0, 1);
        $this->SetFont('Arial', '', 10);
        //row 1 (left)-------------------
        $this->Cell(8, 7, '', 0, 0);
        $this->Cell(14, 0, 'NAMA', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->Cell(4, 2, ': ', 0, 0);
        $this->Cell(20, 2, 'LAILA YUSRO, STP. NY', 0, 0);
        $this->Cell(60, 5, '', 0, 0);

        // $this->Cell(8, 7, '', 0, 0);
        $this->Cell(14, 0, 'Tanggal Lahir', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->Cell(4, 2, ': ', 0, 0);
        $this->Cell(20, 2, '13/07/1972', 0, 0);
        $this->Cell(0, 5, '', 0, 1);

        //row 1 (left)-------------------
        $this->Cell(8, 7, '', 0, 0);
        $this->Cell(14, 0, 'Jenis Kelamin', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->Cell(4, 2, ': ', 0, 0);
        $this->Cell(20, 2, 'PEREMPUAN', 0, 0);
        $this->Cell(60, 5, '', 0, 0);

        // $this->Cell(8, 7, '', 0, 0);
        $this->Cell(14, 0, 'No.RM', 0, 0);
        $this->Cell(15, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->Cell(4, 2, ': ', 0, 0);
        $this->Cell(20, 2, '00-53-09', 0, 0);
        $this->Cell(0, 5, '', 0, 1);
        // Garis---
        $this->SetFont('Arial', 'U', 12);
        $this->Cell(6, 4, '', 0, 0);
        $this->Cell(10, 1, '                                                                                                                                                 ', 0, 0);
        $this->Cell(10, 2, '', 0, 1);
        $this->Cell(10, 5, '', 0, 1);

        }
    }
    function Footer()
    {
        if ( $this->PageNo() > 2 ) {
            $datenowx = date('d/m/y      H:i');
        // Position at 1.5 cm from bottom
                        $this->SetTextColor(0,0,0);
            $this->SetY(-22);
        $this->SetFont('Arial','B',8);
        $this->cell(5,5,'Page '.$this->PageNo().' of {nb}',0,1);
        $this->Image('assets/img/footer2.png',175,265,30);
        $this->Image('assets/img/footer_1.png',1,283,208, 13);
            
        }
    }

    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true)
    {
        //Get string width
        $str_width = $this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $ratio = ($w - $this->cMargin * 2) / $str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit) {
            if ($scale) {
                //Calculate horizontal scaling
                $horiz_scale = $ratio * 100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            } else {
                //Calculate character spacing in points
                $char_space = ($w - $this->cMargin * 2 - $str_width) / max(strlen($txt) - 1, 1) * $this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align = '';
        }

        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        //Same as calling CellFit directly
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, true);
    }
}

class PdfHasilMCUController extends Controller
{
    use AwsTrait;
    protected $fpdf;

    public function __construct()
    {

        $this->fpdf = new PDF('p', 'mm', 'A4');
    }

    public function hasilmcu($noregistrasi)
    {
        $unitService  = new PdfService();
        $data = $unitService->hasilMCU($noregistrasi);
        //var_dump($data['data']['reportMCU1']);exit;
        $NamaJaminan = $data['data']['registrasi'][0]['NamaJaminan'];

        $this->fpdf->SetAutoPageBreak(TRUE, 33);
        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();

        if ($data['data']['reportMCU1'] != null) {
            foreach ($data['data']['reportMCU1'] as $key) {
                $ID = $key['ID'];
                $NamaPasien = strtoupper($key['NamaPasien']);
                $Bin = $key['Bin'];
                $Jeniskelamin = strtoupper($key['Jeniskelamin']);
                $TglLahir = date('d/m/Y', strtotime($key['TglLahir']));
                $Umur = Carbon::parse($key['TglLahir'])->diff(Carbon::now())->format('%yT %mB %dH');
                $Kelurahan = $key['Kelurahan'];
                $Kecamatan = $key['Kecamatan'];
                $Kota = $key['Kota'];
                $Provinsi = $key['Provinsi'];
                $KodePos = $key['kodepos'];
                $Alamat = strtoupper($key['Alamat'].', '.$Kelurahan.', '.$Kecamatan.', '.$Kota.', '.$Provinsi.', '.$KodePos);
                $NoMR = $key['NoMR'];
                $NoEpisode = $key['NoEpisode'];
                $NoRegistrasi = $key['NoRegistrasi'];
                $AsuransiPenjamin = $key['AsuransiPenjamin'];
                $PerusahaanPenjamin = $key['PerusahaanPenjamin'];
                $PaketMCU = strtoupper($key['PaketMCU']);
                $Header = $key['Header'];
                $Tanggal_Pemeriksaan = date('d/m/Y', strtotime($key['Tanggal']));
                $PPD_ = $key['PPD_'];
                $PPD_RS = $key['PPD_RS'];
                $P_Operasi = $key['P_Operasi'];
                $PKecelakaan = $key['PKecelakaan'];
                $HaidTerakhir = $key['HaidTerakhir'];
                $Gravida = $key['Gravida'];
                $Para = $key['Para'];
                $Abortus = $key['Abortus'];
                $Merokok = $key['Merokok'];
                $Alkohol = $key['Alkohol'];
                $Kopi = $key['Kopi'];
                $Olahraga = $key['Olahraga'];
                $RPKBapak = $key['RPKBapak'];
                $RPKIbu = $key['RPKIbu'];
                $RPKKakek = $key['RPKKakek'];
                $RPKNenek = $key['RPKNenek'];
                $Sedang_Sakit = $key['Sedang_Sakit'];
                $Sd_Pengobatan = $key['Sd_Pengobatan'];
                $HariPengobatan = $key['HariPengobatan'];
                $KetPengobatan = $key['KetPengobatan'];
                $Nadi = $key['Nadi'];
                $IsiNadi = $key['IsiNadi'];
                $IramaNadi = $key['IramaNadi'];
                $Pernafasan = $key['Pernafasan'];
                $TDSistole = $key['TDSistole'];
                $TDDiastole = $key['TDDiastole'];
                $SuhuBadan = $key['SuhuBadan'];
                $TB = $key['TB'];
                $BB = $key['BB'];
                $LP = $key['LP'];
                $BMI = $key['BMI'];
                $KetBMI = $key['KetBMI'];
                $KondisiNutrisi = $key['KondisiNutrisi'];
                $BentukBadan = $key['BentukBadan'];
                $Kesadaran_ = $key['Kesadaran'].' '.$key['KetKesadaran'];
                $Kualitas_Kontak = $key['KualitasKontak'].' '.$key['KetKualitasKontak'];
                $Tampak_Kesakitan = $key['TampakKesakitan'].' '.$key['KetTampakKesakitan'];
                $BerjalanAda_Gangguan = $key['BerjalanAdaGangguan'].' '.$key['KetGangguanJalan'];
                $Leher = $key['Leher'];
                $Ket_Leher = $key['Ket_Leher'];
                $Submandibula = $key['Submandibula'];
                $KetSubmandibula = $key['KetSubmandibula'];
                $Ketiak = $key['Ketiak'];
                $KetKetiak = $key['KetKetiak'];
                $Inguinal = $key['Inguinal'];
                $KetInguinal = $key['KetInguinal'];
                $GayaBerjalan = $key['GayaBerjalan'];
                $MenggunakanAB = $key['MenggunakanAB'];
                $KriteriaResikoJatuh = $key['KriteriaResikoJatuh'];
                $TulangKepala = $key['TulangKepala'];
                $KetTulangKepala = $key['KetTulangKepala'];
                $KulitKepala = $key['KulitKepala'];
                $KetKulitKepala = $key['KetKulitKepala'];
                $Rambut = $key['Rambut'];
                $KetRambut = $key['KetRambut'];
                $BentukWajah = $key['BentukWajah'];
                $KetBentukWajah = $key['KetBentukWajah'];
                $Tako_AVOD = $key['Tako_AVOD'];
                $Tako_AVOS = $key['Tako_AVOS'];
                $Seko_AVODS = $key['Seko_AVODS'];
                $Seko_AVODC = $key['Seko_AVODC'];
                $Seko_AVODAxis = $key['Seko_AVODAxis'];
                $Seko_AVODMenjadi = $key['Seko_AVODMenjadi'];
                $Seko_AVODKet = $key['Seko_AVODKet'];
                $Seko_AVOSS = $key['Seko_AVOSS'];
                $Seko_AVOSC = $key['Seko_AVOSC'];
                $Seko_AVOSAxis = $key['Seko_AVOSAxis'];
                $Seko_AVOSMenjadi = $key['Seko_AVOSMenjadi'];
                $Seko_AVOSKet = $key['Seko_AVOSKet'];
                $Seko_Add = $key['Seko_Add'];
                $Seko_PD = $key['Seko_PD'];
                $Kcmt_AVODS = $key['Kcmt_AVODS'];
                $Kcmt_AVODC = $key['Kcmt_AVODC'];
                $Kcmt_AVODAxis = $key['Kcmt_AVODAxis'];
                $Kcmt_AVODMenjadi = $key['Kcmt_AVODMenjadi'];
                $Kcmt_AVOSS = $key['Kcmt_AVOSS'];
                $Kcmt_AVOSC = $key['Kcmt_AVOSC'];
                $Kcmt_AVOSAxis = $key['Kcmt_AVOSAxis'];
                $Kcmt_AVOSMenjadi = $key['Kcmt_AVOSMenjadi'];
                $Kcmt_Add = $key['Kcmt_Add'];
                $KonjungtivaKanan = $key['KonjungtivaKanan'];
                $KonjungtivaKiri = $key['KonjungtivaKiri'];
                $KetKonjungtiva = $key['KetKonjungtiva'];
                $Kesegarisankanan = $key['Kesegarisankanan'];
                $KesegarisanKiri = $key['KesegarisanKiri'];
                $KetKesegarisan = $key['KetKesegarisan'];
                $SkleraKanan = $key['SkleraKanan'];
                $SkleraKiri = $key['SkleraKiri'];
                $KetSklera = $key['KetSklera'];
                $LensaMataKanan = $key['LensaMataKanan'];
                $LensaMataKiri = $key['LensaMataKiri'];
                $KorneaKanan = $key['KorneaKanan'];
                $KetLensaMata = $key['KetLensaMata'];
                $KorneaKiri = $key['KorneaKiri'];
                $KetKornea = $key['KetKornea'];
                $BuluMataKanan = $key['BuluMataKanan'];
                $BuluMatakiri = $key['BuluMatakiri'];
                $KetBuluMata = $key['KetBuluMata'];
                $TekananBMKanan = $key['TekananBMKanan'];
                $TekananBMKiri = $key['TekananBMKiri'];
                $KetTekananBM = $key['KetTekananBM'];
                $Penglihatan3Dkanan = $key['Penglihatan3Dkanan'];
                $Penglihatan3DKiri = $key['Penglihatan3DKiri'];
                $KetPenglihatan3D = $key['KetPenglihatan3D'];
                $DaunTelingaKanan = $key['DaunTelingaKanan'];
                $DaunTelingaKiri = $key['DaunTelingaKiri'];
                $KetDaunTelinga = $key['KetDaunTelinga'];
                $LiangTelingaKanan = $key['LiangTelingaKanan'];
                $LiangTelingaKiri = $key['LiangTelingaKiri'];
                $KetLiangTelinga = $key['KetLiangTelinga'];
                $SerumenKanan = $key['SerumenKanan'];
                $SerumenKiri = $key['SerumenKiri'];
                $KetSerumen = $key['KetSerumen'];
                $MembranTimpaniKa = $key['MembranTimpaniKa'];
                $MembranTimpaniKi = $key['MembranTimpaniKi'];
                $KetMembranTimpani = $key['KetMembranTimpani'];
                $TesBerbisikKa = $key['TesBerbisikKa'];
                $TesBerbisikKi = $key['TesBerbisikKi'];
                $KetTesberbisik = $key['KetTesberbisik'];
                $TGT = $key['TGT'];
                $TGT_Rinne = $key['TGT_Rinne'];
                $TGT_Weber = $key['TGT_Weber'];
                $TGT_Swabach = $key['TGT_Swabach'];
                $TGT_Big = $key['TGT_Big'];
                $TelingaLainLain = $key['TelingaLainLain'];
                $MeatusNasi = $key['MeatusNasi'];
                $KetMeatusNasi = $key['KetMeatusNasi'];
                $SeptumNasi = $key['SeptumNasi'];
                $KetSeptumNasi = $key['KetSeptumNasi'];
                $KonkaNasal = $key['KonkaNasal'];
                $KetKonkaNasal = $key['KetKonkaNasal'];
                $KetokSinus = $key['KetokSinus'];
                $KetKetokSinus = $key['KetKetokSinus'];
                $Penciuman = $key['Penciuman'];
                $KetPenciuman = $key['KetPenciuman'];
                $Bibir = $key['Bibir'];
                $KetBibir = $key['KetBibir'];
                $Lidah = $key['Lidah'];
                $KetLidah = $key['KetLidah'];
                $Gusi = $key['Gusi'];
                $KetGusi = $key['KetGusi'];
                $MulutLainLain = $key['MulutLainLain'];
                $Pharynx = $key['Pharynx'];
                $TonsilKanan = $key['TonsilKanan'];
                $TonsilKiri = $key['TonsilKiri'];
                $KetTonsil = $key['KetTonsil'];
                $Palatum = $key['Palatum'];
                $TenggorokanLainLain = $key['TenggorokanLainLain'];
                $GerakanLeher = $key['GerakanLeher'];
                $KetGerakanLeher = $key['KetGerakanLeher'];
                $OtotLeher = $key['OtotLeher'];
                $KetOtotLeher = $key['KetOtotLeher'];
                $KelenjarTyroid = $key['KelenjarTyroid'];
                $KetKelenjarTyroid = $key['KetKelenjarTyroid'];
                $PulsasiCarotis = $key['PulsasiCarotis'];
                $KetPulsasiCarotis = $key['KetPulsasiCarotis'];
                $VenaJugularis = $key['VenaJugularis'];
                $KetVenaJugularin = $key['KetVenaJugularin'];
                $Trachea = $key['Trachea'];
                $KetTrachea = $key['KetTrachea'];
                $LeherLain2 = $key['LeherLain2'];
                $BentukDada = $key['BentukDada'];
                $KetBnetukDada = $key['KetBnetukDada'];
                $Mammae = $key['Mammae'];
                $UkuranTumor = $key['UkuranTumor'];
                $LetakTumor = $key['LetakTumor'];
                $KonsistensiTumor = $key['KonsistensiTumor'];
                $DadaLain2 = $key['DadaLain2'];
                $Paru_Palpasi = $key['Paru_Palpasi'];
                $Paru_KetPalpasi = $key['Paru_KetPalpasi'];
                $Paru_PerkusiKanan = $key['Paru_PerkusiKanan'];
                $Paru_PerkusiKiri = $key['Paru_PerkusiKiri'];
                $Paru_IktusKordis = $key['Paru_IktusKordis'];
                $Paru_KetIktusKordis = $key['Paru_KetIktusKordis'];
                $Paru_BatasJantung = $key['Paru_BatasJantung'];
                $Paru_KetBatasJantung = $key['Paru_KetBatasJantung'];
                $Paru_BunyiNapasKanan = $key['Paru_BunyiNapasKanan'];
                $Paru_BunyiNapasKiri = $key['Paru_BunyiNapasKiri'];
                $Paru_BNPTambahanKa = $key['Paru_BNPTambahanKa'];
                $Paru_BNPTambahanKi = $key['Paru_BNPTambahanKi'];
                $Paru_BunyiJantung = $key['Paru_BunyiJantung'];
                $Paru_KetBunyiJantung = $key['Paru_KetBunyiJantung'];
                $Abdo_Inspeksi = $key['Abdo_Inspeksi'];
                $Abdo_KetInspeksi = $key['Abdo_KetInspeksi'];
                $Abdo_Perkusi = $key['Abdo_Perkusi'];
                $Abdo_KetPerkusi = $key['Abdo_KetPerkusi'];
                $Abdo_BisingUsus = $key['Abdo_BisingUsus'];
                $Abdo_KetBisingUsus = $key['Abdo_KetBisingUsus'];
                $Abdo_Hati = $key['Abdo_Hati'];
                $Abdo_KetHati1 = $key['Abdo_KetHati1'];
                $Abdo_KetHati2 = $key['Abdo_KetHati2'];
                $Abdo_Limpa = $key['Abdo_Limpa'];
                $Abdo_KetLimpa = $key['Abdo_KetLimpa'];
                $Abdo_GinjalKa = $key['Abdo_GinjalKa'];
                $Abdo_GinjalKi = $key['Abdo_GinjalKi'];
                $Abdo_BallotementKa = $key['Abdo_BallotementKa'];
                $Abdo_BallotementKi = $key['Abdo_BallotementKi'];
                $Abdo_NCVKanan = $key['Abdo_NCVKanan'];
                $Abdo_NCVKiri = $key['Abdo_NCVKiri'];
                $Abdo_LainLain = $key['Abdo_LainLain'];
                $GA11 = $key['GA11'];
                $GA12 = $key['GA12'];
                $GA13 = $key['GA13'];
                $GA14 = $key['GA14'];
                $GA15 = $key['GA15'];
                $GA16 = $key['GA16'];
                $GA17 = $key['GA17'];
                $GA18 = $key['GA18'];
                $GA21 = $key['GA21'];
                $GA22 = $key['GA22'];
                $GA23 = $key['GA23'];
                $GA24 = $key['GA24'];
                $GA25 = $key['GA25'];
                $GA26 = $key['GA26'];
                $GA27 = $key['GA27'];
                $GA28 = $key['GA28'];
                $GB41 = $key['GB41'];
                $GB42 = $key['GB42'];
                $GB43 = $key['GB43'];
                $GB44 = $key['GB44'];
                $GB45 = $key['GB45'];
                $GB46 = $key['GB46'];
                $GB47 = $key['GB47'];
                $GB48 = $key['GB48'];
                $GB31 = $key['GB31'];
                $GB32 = $key['GB32'];
                $GB33 = $key['GB33'];
                $GB34 = $key['GB34'];
                $GB35 = $key['GB35'];
                $GB36 = $key['GB36'];
                $GB37 = $key['GB37'];
                $GB38 = $key['GB38'];
                $TBWarnaKa = $key['TBWarnaKa'];
                $TBWarnaKi = $key['TBWarnaKi'];
                $KetTBWarana = $key['KetTBWarana'];
                $SatLamaPengobatan = $key['SatLamaPengobatan'];
            }
        } else {
            $ID = null;
            $NamaPasien = null;
            $Bin = null;
            $Jeniskelamin = null;
            $TglLahir = null;
            $Umur = null;
            $Alamat = null;
            $Kelurahan = null;
            $Kecamatan = null;
            $Kota = null;
            $Provinsi = null;
            $KodePos = null;
            $NoMR = null;
            $NoEpisode = null;
            $NoRegistrasi = null;
            $AsuransiPenjamin = null;
            $PerusahaanPenjamin = null;
            $PaketMCU = null;
            $Header = null;
            $Tanggal = null;
            $PPD_ = null;
            $PPD_RS = null;
            $P_Operasi = null;
            $PKecelakaan = null;
            $HaidTerakhir = null;
            $Gravida = null;
            $Para = null;
            $Abortus = null;
            $Merokok = null;
            $Alkohol = null;
            $Kopi = null;
            $Olahraga = null;
            $RPKBapak = null;
            $RPKIbu = null;
            $RPKKakek = null;
            $RPKNenek = null;
            $Sedang_Sakit = null;
            $Sd_Pengobatan = null;
            $HariPengobatan = null;
            $KetPengobatan = null;
            $Nadi = null;
            $IsiNadi = null;
            $IramaNadi = null;
            $Pernafasan = null;
            $TDSistole = null;
            $TDDiastole = null;
            $SuhuBadan = null;
            $TB = null;
            $BB = null;
            $LP = null;
            $BMI = null;
            $KetBMI = null;
            $KondisiNutrisi = null;
            $BentukBadan = null;
            $Kesadaran_ = null;
            $Kualitas_Kontak = null;
            $Tampak_Kesakitan = null;
            $BerjalanAda_Gangguan = null;
            $Leher = null;
            $Ket_Leher = null;
            $Submandibula = null;
            $KetSubmandibula = null;
            $Ketiak = null;
            $KetKetiak = null;
            $Inguinal = null;
            $KetInguinal = null;
            $GayaBerjalan = null;
            $MenggunakanAB = null;
            $KriteriaResikoJatuh = null;
            $TulangKepala = null;
            $KetTulangKepala = null;
            $KulitKepala = null;
            $KetKulitKepala = null;
            $Rambut = null;
            $KetRambut = null;
            $BentukWajah = null;
            $KetBentukWajah = null;
            $Tako_AVOD = null;
            $Tako_AVOS = null;
            $Seko_AVODS = null;
            $Seko_AVODC = null;
            $Seko_AVODAxis = null;
            $Seko_AVODMenjadi = null;
            $Seko_AVODKet = null;
            $Seko_AVOSS = null;
            $Seko_AVOSC = null;
            $Seko_AVOSAxis = null;
            $Seko_AVOSMenjadi = null;
            $Seko_AVOSKet = null;
            $Seko_Add = null;
            $Seko_PD = null;
            $Kcmt_AVODS = null;
            $Kcmt_AVODC = null;
            $Kcmt_AVODAxis = null;
            $Kcmt_AVODMenjadi = null;
            $Kcmt_AVOSS = null;
            $Kcmt_AVOSC = null;
            $Kcmt_AVOSAxis = null;
            $Kcmt_AVOSMenjadi = null;
            $Kcmt_Add = null;
            $KonjungtivaKanan = null;
            $KonjungtivaKiri = null;
            $KetKonjungtiva = null;
            $Kesegarisankanan = null;
            $KesegarisanKiri = null;
            $KetKesegarisan = null;
            $SkleraKanan = null;
            $SkleraKiri = null;
            $KetSklera = null;
            $LensaMataKanan = null;
            $LensaMataKiri = null;
            $KorneaKanan = null;
            $KetLensaMata = null;
            $KorneaKiri = null;
            $KetKornea = null;
            $BuluMataKanan = null;
            $BuluMatakiri = null;
            $KetBuluMata = null;
            $TekananBMKanan = null;
            $TekananBMKiri = null;
            $KetTekananBM = null;
            $Penglihatan3Dkanan = null;
            $Penglihatan3DKiri = null;
            $KetPenglihatan3D = null;
            $DaunTelingaKanan = null;
            $DaunTelingaKiri = null;
            $KetDaunTelinga = null;
            $LiangTelingaKanan = null;
            $LiangTelingaKiri = null;
            $KetLiangTelinga = null;
            $SerumenKanan = null;
            $SerumenKiri = null;
            $KetSerumen = null;
            $MembranTimpaniKa = null;
            $MembranTimpaniKi = null;
            $KetMembranTimpani = null;
            $TesBerbisikKa = null;
            $TesBerbisikKi = null;
            $KetTesberbisik = null;
            $TGT = null;
            $TGT_Rinne = null;
            $TGT_Weber = null;
            $TGT_Swabach = null;
            $TGT_Big = null;
            $TelingaLainLain = null;
            $MeatusNasi = null;
            $KetMeatusNasi = null;
            $SeptumNasi = null;
            $KetSeptumNasi = null;
            $KonkaNasal = null;
            $KetKonkaNasal = null;
            $KetokSinus = null;
            $KetKetokSinus = null;
            $Penciuman = null;
            $KetPenciuman = null;
            $Bibir = null;
            $KetBibir = null;
            $Lidah = null;
            $KetLidah = null;
            $Gusi = null;
            $KetGusi = null;
            $MulutLainLain = null;
            $Pharynx = null;
            $TonsilKanan = null;
            $TonsilKiri = null;
            $KetTonsil = null;
            $Palatum = null;
            $TenggorokanLainLain = null;
            $GerakanLeher = null;
            $KetGerakanLeher = null;
            $OtotLeher = null;
            $KetOtotLeher = null;
            $KelenjarTyroid = null;
            $KetKelenjarTyroid = null;
            $PulsasiCarotis = null;
            $KetPulsasiCarotis = null;
            $VenaJugularis = null;
            $KetVenaJugularin = null;
            $Trachea = null;
            $KetTrachea = null;
            $LeherLain2 = null;
            $BentukDada = null;
            $KetBnetukDada = null;
            $Mammae = null;
            $UkuranTumor = null;
            $LetakTumor = null;
            $KonsistensiTumor = null;
            $DadaLain2 = null;
            $Paru_Palpasi = null;
            $Paru_KetPalpasi = null;
            $Paru_PerkusiKanan = null;
            $Paru_PerkusiKiri = null;
            $Paru_IktusKordis = null;
            $Paru_KetIktusKordis = null;
            $Paru_BatasJantung = null;
            $Paru_KetBatasJantung = null;
            $Paru_BunyiNapasKanan = null;
            $Paru_BunyiNapasKiri = null;
            $Paru_BNPTambahanKa = null;
            $Paru_BNPTambahanKi = null;
            $Paru_BunyiJantung = null;
            $Paru_KetBunyiJantung = null;
            $Abdo_Inspeksi = null;
            $Abdo_KetInspeksi = null;
            $Abdo_Perkusi = null;
            $Abdo_KetPerkusi = null;
            $Abdo_BisingUsus = null;
            $Abdo_KetBisingUsus = null;
            $Abdo_Hati = null;
            $Abdo_KetHati1 = null;
            $Abdo_KetHati2 = null;
            $Abdo_Limpa = null;
            $Abdo_KetLimpa = null;
            $Abdo_GinjalKa = null;
            $Abdo_GinjalKi = null;
            $Abdo_BallotementKa = null;
            $Abdo_BallotementKi = null;
            $Abdo_NCVKanan = null;
            $Abdo_NCVKiri = null;
            $Abdo_LainLain = null;
            $GA11 = null;
            $GA12 = null;
            $GA13 = null;
            $GA14 = null;
            $GA15 = null;
            $GA16 = null;
            $GA17 = null;
            $GA18 = null;
            $GA21 = null;
            $GA22 = null;
            $GA23 = null;
            $GA24 = null;
            $GA25 = null;
            $GA26 = null;
            $GA27 = null;
            $GA28 = null;
            $GB41 = null;
            $GB42 = null;
            $GB43 = null;
            $GB44 = null;
            $GB45 = null;
            $GB46 = null;
            $GB47 = null;
            $GB48 = null;
            $GB31 = null;
            $GB32 = null;
            $GB33 = null;
            $GB34 = null;
            $GB35 = null;
            $GB36 = null;
            $GB37 = null;
            $GB38 = null;
            $TBWarnaKa = null;
            $TBWarnaKi = null;
            $KetTBWarana = null;
            $SatLamaPengobatan = null;
        }
        if ($data['data']['reportMCU2'] != null) {
            foreach ($data['data']['reportMCU2'] as $key) {
                //dd($key);exit;
                $NoEpisode = $key['NoEpisode'];
                $NoRegistrasi = $key['NoRegistrasi'];
                $Tanggal = $key['Tanggal'];
                $KandungKemih = $key['KandungKemih'];
                $ketKandungKemih = $key['ketKandungKemih'];
                $Anus = $key['Anus'];
                $ketAnus = $key['ketAnus'];
                $GenitaliaEksternal = $key['GenitaliaEksternal'];
                $ketGenitaliaEksternal = $key['ketGenitaliaEksternal'];
                $Prostat = $key['Prostat'];
                $ketProstat = $key['ketProstat'];
                $Vertebra = $key['Vertebra'];
                $Ketvertebra = $key['Ketvertebra'];
                $Ekstra_SimetriKa = $key['Ekstra_SimetriKa'];
                $Ekstra_SimetriKi = $key['Ekstra_SimetriKi'];
                $Ekstra_GerakanKa = $key['Ekstra_GerakanKa'];
                $Ekstra_GerakanKi = $key['Ekstra_GerakanKi'];
                $Ekstra_RoMKa = $key['Ekstra_RoMKa'];
                $Ekstra_RoMKi = $key['Ekstra_RoMKi'];
                $Ekstra_AbduksiNTKa = $key['Ekstra_AbduksiNTKa'];
                $Ekstra_AbduksiNTKi = $key['Ekstra_AbduksiNTKi'];
                $Ekstra_AbduksiHTKa = $key['Ekstra_AbduksiHTKa'];
                $Ekstra_AbduksiHTKi = $key['Ekstra_AbduksiHTKi'];
                $Ekstra_DropArmTKa = $key['Ekstra_DropArmTKa'];
                $Ekstra_DropArmTKi = $key['Ekstra_DropArmTKi'];
                $Ekstra_YergasonKa = $key['Ekstra_YergasonKa'];
                $Ekstra_YergasonKi = $key['Ekstra_YergasonKi'];
                $Ekstra_SpeedTesKa = $key['Ekstra_SpeedTesKa'];
                $Ekstra_SpeedTesKi = $key['Ekstra_SpeedTesKi'];
                $Ekstra_TulangKa = $key['Ekstra_TulangKa'];
                $Ekstra_TulangKi = $key['Ekstra_TulangKi'];
                $Ekstra_SensibilitasKa = $key['Ekstra_SensibilitasKa'];
                $Ekstra_SensibilitasKi = $key['Ekstra_SensibilitasKi'];
                $Ekstra_OedemaKa = $key['Ekstra_OedemaKa'];
                $Ekstra_OedemaKi = $key['Ekstra_OedemaKi'];
                $Ekstra_VarisesKa = $key['Ekstra_VarisesKa'];
                $Ekstra_VarisesKi = $key['Ekstra_VarisesKi'];
                $Ekstra_KOtotKa = $key['Ekstra_KOtotKa'];
                $Ekstra_KOtotKi = $key['Ekstra_KOtotKi'];
                $Ekstra_KOPPTKa = $key['Ekstra_KOPPTKa'];
                $Ekstra_KOPPTKi = $key['Ekstra_KOPPTKi'];
                $Ekstra_KOPhalTKa = $key['Ekstra_KOPhalTKa'];
                $Ekstra_KOPhalTKi = $key['Ekstra_KOPhalTKi'];
                $Ekstra_KOTinnTKa = $key['Ekstra_KOTinnTKa'];
                $Ekstra_KOTinnTKi = $key['Ekstra_KOTinnTKi'];
                $Ekstra_KOFinsTKa = $key['Ekstra_KOFinsTKa'];
                $Ekstra_KOFinsTKi = $key['Ekstra_KOFinsTKi'];
                $Ekstra_VaskularisasiKa = $key['Ekstra_VaskularisasiKa'];
                $Ekstra_VaskularisasiKi = $key['Ekstra_VaskularisasiKi'];
                $Ekstra_KelKukuKa = $key['Ekstra_KelKukuKa'];
                $Ekstra_KelKukuKi = $key['Ekstra_KelKukuKi'];
                $Ekstra_Keterangan = $key['Ekstra_Keterangan'];
                $EkstrB_SimetriKa = $key['EkstrB_SimetriKa'];
                $EkstrB_SimetriKi = $key['EkstrB_SimetriKi'];
                $EkstrB_GerakanKa = $key['EkstrB_GerakanKa'];
                $EkstrB_GerakanKi = $key['EkstrB_GerakanKi'];
                $EkstrB_TLasequeKa = $key['EkstrB_TLasequeKa'];
                $EkstrB_TLasequeKi = $key['EkstrB_TLasequeKi'];
                $EkstrB_TKerniqueKa = $key['EkstrB_TKerniqueKa'];
                $EkstrB_TKerniqueKi = $key['EkstrB_TKerniqueKi'];
                $EkstrB_TPatrickKa = $key['EkstrB_TPatrickKa'];
                $EkstrB_TPatrickKi = $key['EkstrB_TPatrickKi'];
                $EkstrB_TKontraKa = $key['EkstrB_TKontraKa'];
                $EkstrB_TKontraKi = $key['EkstrB_TKontraKi'];
                $EkstrB_NyeriTKa = $key['EkstrB_NyeriTKa'];
                $EkstrB_NyeriTKi = $key['EkstrB_NyeriTKi'];
                $EkstrB_KOKa = $key['EkstrB_KOKa'];
                $EkstrB_KOKi = $key['EkstrB_KOKi'];
                $EkstrB_TulangKa = $key['EkstrB_TulangKa'];
                $EkstrB_TulangKi = $key['EkstrB_TulangKi'];
                $EkstrB_SensibilitasKa = $key['EkstrB_SensibilitasKa'];
                $EkstrB_SensibilitasKi = $key['EkstrB_SensibilitasKi'];
                $EkstrB_OedemaKa = $key['EkstrB_OedemaKa'];
                $EkstrB_OedemaKi = $key['EkstrB_OedemaKi'];
                $EkstrB_VarisesKa = $key['EkstrB_VarisesKa'];
                $EkstrB_VarisesKi = $key['EkstrB_VarisesKi'];
                $EkstrB_VaskularKa = $key['EkstrB_VaskularKa'];
                $EkstrB_VaskularKi = $key['EkstrB_VaskularKi'];
                $EkstrB_KelKukuKa = $key['EkstrB_KelKukuKa'];
                $EkstrB_KelKukuKi = $key['EkstrB_KelKukuKi'];
                $EkstrB_Keterangan = $key['EkstrB_Keterangan'];
                $Omot_TrofiKa = $key['Omot_TrofiKa'];
                $Omot_TrofiKi = $key['Omot_TrofiKi'];
                $Omot_TonusKa = $key['Omot_TonusKa'];
                $Omot_TonusKi = $key['Omot_TonusKi'];
                $Omot_GerAbnoKa = $key['Omot_GerAbnoKa'];
                $Omot_GerAbnoKi = $key['Omot_GerAbnoKi'];
                $Omot_Keterangan = $key['Omot_Keterangan'];
                $FuSen_FSensorikKa = $key['FuSen_FSensorikKa'];
                $FuSen_FSensorikKi = $key['FuSen_FSensorikKi'];
                $FuSen_FotonomKa = $key['FuSen_FotonomKa'];
                $FuSen_FotonomKi = $key['FuSen_FotonomKi'];
                $FuSen_Keterangan = $key['FuSen_Keterangan'];
                $SFL_DISegera = $key['SFL_DISegera'];
                $SFL_DIJPendek = $key['SFL_DIJPendek'];
                $SFL_DIJMenengah = $key['SFL_DIJMenengah'];
                $SFL_DIJPanjang = $key['SFL_DIJPanjang'];
                $SFL_OrientasiWaktu = $key['SFL_OrientasiWaktu'];
                $SFL_OrientasiTempat = $key['SFL_OrientasiTempat'];
                $SFL_OrientasiOrang = $key['SFL_OrientasiOrang'];
                $SFL_KSON1 = $key['SFL_KSON1'];
                $SFL_KSON2 = $key['SFL_KSON2'];
                $SFL_KSON3 = $key['SFL_KSON3'];
                $SFL_KSON4 = $key['SFL_KSON4'];
                $SFL_KSON5 = $key['SFL_KSON5'];
                $SFL_KSON6 = $key['SFL_KSON6'];
                $SFL_KSON7 = $key['SFL_KSON7'];
                $SFL_KSON8 = $key['SFL_KSON8'];
                $SFL_KSON9 = $key['SFL_KSON9'];
                $SFL_KSON10 = $key['SFL_KSON10'];
                $SFL_KSON11 = $key['SFL_KSON11'];
                $SFL_KSON12 = $key['SFL_KSON12'];
                $SFL_KSOKeterangan = $key['SFL_KSOKeterangan'];
                $RFL_FisiologisKa = $key['RFL_FisiologisKa'];
                $RFL_FisiologisKi = $key['RFL_FisiologisKi'];
                $RFL_PatellaKa = $key['RFL_PatellaKa'];
                $RFL_PatellaKi = $key['RFL_PatellaKi'];
                $RFL_Lainnya = $key['RFL_Lainnya'];
                $RFL_PBKa = $key['RFL_PBKa'];
                $RFL_PBKi = $key['RFL_PBKi'];
                $RFL_PBLainnya = $key['RFL_PBLainnya'];
                $Kulit = $key['Kulit'];
                $SelaputLendir = $key['SelaputLendir'];
                $KulitLainnya = $key['KulitLainnya'];
                $ResumeKelainan = $key['ResumeKelainan'];
                $HasilBodyMap = $key['HasilBodyMap'];
                $DiagnosaKerja = $key['DiagnosaKerja'];
                $DiagnosisDiferensial = $key['DiagnosisDiferensial'];
                $KetKesehatan = $key['KetKesehatan'];
                $Saran = $key['Saran'];
             //   $Images = $key['Images'];
                $drPemeriksa = $key['drPemeriksa'];
                $PFK_Radiologi = $key['PFK_Radiologi'];
                $PFK_USG = $key['PFK_USG'];
                $PFK_EKG = $key['PFK_EKG'];
                $PFK_EMG = $key['PFK_EMG'];
                $PFK_Spirometri = $key['PFK_Spirometri'];
                $PFK_Audiometri = $key['PFK_Audiometri'];
                $PFK_Treadmill = $key['PFK_Treadmill'];
                $PFK_Echo = $key['PFK_Echo'];
                $PFK_Lab = $key['PFK_Lab'];
            }
        } else {
            $NoEpisode = null;
            $NoRegistrasi = null;
            $Tanggal = null;
            $KandungKemih = null;
            $ketKandungKemih = null;
            $Anus = null;
            $ketAnus = null;
            $GenitaliaEksternal = null;
            $ketGenitaliaEksternal = null;
            $Prostat = null;
            $ketProstat = null;
            $Vertebra = null;
            $Ketvertebra = null;
            $Ekstra_SimetriKa = null;
            $Ekstra_SimetriKi = null;
            $Ekstra_GerakanKa = null;
            $Ekstra_GerakanKi = null;
            $Ekstra_RoMKa = null;
            $Ekstra_RoMKi = null;
            $Ekstra_AbduksiNTKa = null;
            $Ekstra_AbduksiNTKi = null;
            $Ekstra_AbduksiHTKa = null;
            $Ekstra_AbduksiHTKi = null;
            $Ekstra_DropArmTKa = null;
            $Ekstra_DropArmTKi = null;
            $Ekstra_YergasonKa = null;
            $Ekstra_YergasonKi = null;
            $Ekstra_SpeedTesKa = null;
            $Ekstra_SpeedTesKi = null;
            $Ekstra_TulangKa = null;
            $Ekstra_TulangKi = null;
            $Ekstra_SensibilitasKa = null;
            $Ekstra_SensibilitasKi = null;
            $Ekstra_OedemaKa = null;
            $Ekstra_OedemaKi = null;
            $Ekstra_VarisesKa = null;
            $Ekstra_VarisesKi = null;
            $Ekstra_KOtotKa = null;
            $Ekstra_KOtotKi = null;
            $Ekstra_KOPPTKa = null;
            $Ekstra_KOPPTKi = null;
            $Ekstra_KOPhalTKa = null;
            $Ekstra_KOPhalTKi = null;
            $Ekstra_KOTinnTKa = null;
            $Ekstra_KOTinnTKi = null;
            $Ekstra_KOFinsTKa = null;
            $Ekstra_KOFinsTKi = null;
            $Ekstra_VaskularisasiKa = null;
            $Ekstra_VaskularisasiKi = null;
            $Ekstra_KelKukuKa = null;
            $Ekstra_KelKukuKi = null;
            $Ekstra_Keterangan = null;
            $EkstrB_SimetriKa = null;
            $EkstrB_SimetriKi = null;
            $EkstrB_GerakanKa = null;
            $EkstrB_GerakanKi = null;
            $EkstrB_TLasequeKa = null;
            $EkstrB_TLasequeKi = null;
            $EkstrB_TKerniqueKa = null;
            $EkstrB_TKerniqueKi = null;
            $EkstrB_TPatrickKa = null;
            $EkstrB_TPatrickKi = null;
            $EkstrB_TKontraKa = null;
            $EkstrB_TKontraKi = null;
            $EkstrB_NyeriTKa = null;
            $EkstrB_NyeriTKi = null;
            $EkstrB_KOKa = null;
            $EkstrB_KOKi = null;
            $EkstrB_TulangKa = null;
            $EkstrB_TulangKi = null;
            $EkstrB_SensibilitasKa = null;
            $EkstrB_SensibilitasKi = null;
            $EkstrB_OedemaKa = null;
            $EkstrB_OedemaKi = null;
            $EkstrB_VarisesKa = null;
            $EkstrB_VarisesKi = null;
            $EkstrB_VaskularKa = null;
            $EkstrB_VaskularKi = null;
            $EkstrB_KelKukuKa = null;
            $EkstrB_KelKukuKi = null;
            $EkstrB_Keterangan = null;
            $Omot_TrofiKa = null;
            $Omot_TrofiKi = null;
            $Omot_TonusKa = null;
            $Omot_TonusKi = null;
            $Omot_GerAbnoKa = null;
            $Omot_GerAbnoKi = null;
            $Omot_Keterangan = null;
            $FuSen_FSensorikKa = null;
            $FuSen_FSensorikKi = null;
            $FuSen_FotonomKa = null;
            $FuSen_FotonomKi = null;
            $FuSen_Keterangan = null;
            $SFL_DISegera = null;
            $SFL_DIJPendek = null;
            $SFL_DIJMenengah = null;
            $SFL_DIJPanjang = null;
            $SFL_OrientasiWaktu = null;
            $SFL_OrientasiTempat = null;
            $SFL_OrientasiOrang = null;
            $SFL_KSON1 = null;
            $SFL_KSON2 = null;
            $SFL_KSON3 = null;
            $SFL_KSON4 = null;
            $SFL_KSON5 = null;
            $SFL_KSON6 = null;
            $SFL_KSON7 = null;
            $SFL_KSON8 = null;
            $SFL_KSON9 = null;
            $SFL_KSON10 = null;
            $SFL_KSON11 = null;
            $SFL_KSON12 = null;
            $SFL_KSOKeterangan = null;
            $RFL_FisiologisKa = null;
            $RFL_FisiologisKi = null;
            $RFL_PatellaKa = null;
            $RFL_PatellaKi = null;
            $RFL_Lainnya = null;
            $RFL_PBKa = null;
            $RFL_PBKi = null;
            $RFL_PBLainnya = null;
            $Kulit = null;
            $SelaputLendir = null;
            $KulitLainnya = null;
            $ResumeKelainan = null;
            $HasilBodyMap = null;
            $DiagnosaKerja = null;
            $DiagnosisDiferensial = null;
            $KetKesehatan = null;
            $Saran = null;
            $Images = null;
            $drPemeriksa = null;
            $PFK_Radiologi = null;
            $PFK_USG = null;
            $PFK_EKG = null;
            $PFK_EMG = null;
            $PFK_Spirometri = null;
            $PFK_Audiometri = null;
            $PFK_Treadmill = null;
            $PFK_Echo = null;
            $PFK_Lab = null;
        }

        $this->fpdf->Cell(10, 1, '', 0, 1);
        //Line 1
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(0, 12, 'MEDICAL CHECK UP', 'TLR', 0, 'C');

        //BR
        $this->fpdf->Cell(0, 6, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->CellfitScale(0, 12, '(' . $NamaJaminan . ')', 'LR', 0, 'C');
        $this->fpdf->Cell(0, 6, '', 0, 1);
        $this->fpdf->CellfitScale(0, 12, '(' . $PaketMCU . ') PACKAGE', 'BLR', 0, 'C');

        //BR
        $this->fpdf->Cell(0, 15, '', 0, 1);


        $this->fpdf->Cell(10, 3, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        //row 1 (left)-------------------
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'NAMA', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(20, 2, $NamaPasien, 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Name', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);

        //row 2 (left)---------------------
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'TANGGAL LAHIR', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        $this->fpdf->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(20, 2, $TglLahir, 0, 0);
        $this->fpdf->Cell(60, 2, $Umur, 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Date of birth', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //BRfpdf->
        $this->fpdf->Cell(0, 5, '', 0, 1);

        //row 3 (left)-----------------------------
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'JENIS KELAMIN', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //$this->Cell(35,0,': '.$GLOBALS['identitas_pasien']['birth_dt'],0,0);
        //$this->Cell(35,0,': '.$GLOBALS['identitas_pasien']['birth_dt'],0,0);
        $this->fpdf->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(20, 2, $Jeniskelamin, 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        //$this->Cell(25,0,'('.$GLOBALS['identitas_pasien']['age'].'Y)',0,0);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Gender', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);

        //row 4 (left)---------------------
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'REKAM MEDIS', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['gender'],0,0);
        $this->fpdf->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(20, 2, $NoMR, 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Medical record', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);

       //row 4 (left)---------------------
       $this->fpdf->SetFont('Arial', 'B', 10);
       $this->fpdf->Cell(10, 5, '', 0, 1);
       $this->fpdf->Cell(25, 7, '', 0, 0);
       $this->fpdf->Cell(10, 0, 'ALAMAT', 0, 0);
       $this->fpdf->Cell(60, 0, '', 0, 0);
       //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['gender'],0,0);
       $this->fpdf->Cell(8, 2, ': ', 0, 0);
       $this->fpdf->SetFont('Arial', '', 10);
       $this->fpdf->MultiCell(0, 4, $Alamat, 0, 0);
       $this->fpdf->SetFont('Arial', 'i', 10);
       $this->fpdf->Cell(0, 5, '', 0, 1);
       $this->fpdf->Cell(25, 7, '', 0, 0);
       $this->fpdf->Cell(0, 0, 'Address', 0, 0);
       $this->fpdf->Cell(60, 0, '', 0, 0);
       //BR
       $this->fpdf->Cell(0, 5, '', 0, 1);

        //row 6 (left)---------------------
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'TANGGAL PEMERIKSAAN', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['address'],0,0);
        $this->fpdf->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(20, 2, $Tanggal_Pemeriksaan, 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Date of Examination', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);

        // //blank

        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);

        //new1-------------------------
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(15, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'DOKTER YANG MELAKUKAN PEMERIKSAAN', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(15, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Physical examination doctor', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);

        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);
        
        foreach ($data['data']['dokter'] as $datadokter) {
        //new1-------------------------
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, $datadokter['AliasDokter'], 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['address'],0,0);
        $this->fpdf->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(20, 2, $datadokter['NamaDokter'], 0, 0);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Occupational health doctor', 0, 0);
        $this->fpdf->Cell(60, 4, '', 0, 1);
        }


        // $this->fpdf->SetTextColor(0, 0, 0);
        // $this->fpdf->SetY(-37);
        //BR
        $this->fpdf->Cell(0, 9, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'U', 10);
        $this->fpdf->Cell(15, 4, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, 5, '', 0, 1);
        $this->fpdf->Cell(25, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Terimakasih atas kepercayaan anda untuk melakukan pemeriksaan kesehatan pada', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['address'],0,0);
        // $this->Cell(8, 2, ': ', 0, 0);
        $this->fpdf->Cell(20, 2, ' ', 0, 0);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(21, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Rumah Sakit YARSI, kami sarankan untuk melakukan pemeriksaan satu tahun kemudian.', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        $this->fpdf->Cell(20, 2, ' ', 0, 0);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(22, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'Thank you for taking Medical Check Up at YARSI Hospital, and we recommend you to do next', 0, 0);
        $this->fpdf->Cell(60, 0, '', 0, 0);
        // End PAGE 1
        $this->fpdf->Cell(0, 1, '', 0, 1);

        $this->fpdf->SetFont('Arial', 'I', 10);
        $this->fpdf->Cell(0, 7, 'Medical Check Up one year later', 0, 0, 'C');
        $this->fpdf->Cell(0, 2, '', 0, 1);

        // $gety = $pdf->getY();

        // if(($gety>250.00125 && $gety<252.000000) || $gety < 230.000000){
        // $pdf->SetAutoPageBreak(true,2);  
        // }else{
        // $pdf->SetAutoPageBreak(true,50);  
        // }
        $this->fpdf->AddPage();  


        // Page 2





        //Line 1


        //BR
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'UB', 14);
        $this->fpdf->Cell(0, 7, 'HASIL PEMERIKSAAN KESEHATAN', 0, 0, 'C');
        $this->fpdf->Cell(0, 6, '', 0, 1);
        $this->fpdf->Cell(0, 5, '', 0, 1);

        $this->fpdf->Cell(0, 1, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(0, 7, 'RIWAYAT KESEHATAN', 0, 0, 'L');
        $this->fpdf->Cell(0, 8, '', 0, 1);

        $h = 4;

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(6, $h, '', 0, 0);
        $this->fpdf->Cell(59, $h, '1. Penyakit yang pernah diderita', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PPD_, 0, 1);
        // $this->fpdf->Cell(60, 5, '', 1, 1);

        $this->fpdf->Cell(6, $h, '', 0, 0);
        $this->fpdf->Cell(59, $h, '2. Pernah dirawat di rumah sakit', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PPD_RS, 0, 1);

        // $this->fpdf->Cell(6, 7, '', 0, 0);
        // $this->fpdf->Cell(14, 0, '2. Pernah dirawat di rumah sakit', 0, 0);
        // $this->fpdf->Cell(45, 0, '', 0, 0);
        // //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        // $this->fpdf->Cell(4, 2, ': ', 0, 0);
        // $this->fpdf->MultiCell(0, 4, $PPD_RS, 0, 0);
        // $this->fpdf->Cell(60, 5, '', 0, 1);

        $this->fpdf->Cell(6, $h, '', 0, 0);
        $this->fpdf->Cell(59, $h, '3. Pernah Operasi', 0, 0);
        $this->fpdf->Cell($h, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $P_Operasi, 0, 1);

        $this->fpdf->Cell(6, $h, '', 0, 0);
        $this->fpdf->Cell(59, $h, '4. Pernah Kecelakaan', 0, 0);
        $this->fpdf->Cell($h, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PKecelakaan, 0, 1);

        $this->fpdf->Cell(6, $h, '', 0, 0);
        $this->fpdf->Cell(59, $h, '5. Riwayat Reproduksi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        if ($Jeniskelamin == 'Perempuan'){
            $this->fpdf->Cell(20, $h, 'Haid Terakhir : ' . $HaidTerakhir . ';G : ' . $Gravida . ',  P : ' . $Para . ',  A :  ' . $Abortus, 0, 1);
        }else{
            $this->fpdf->Cell(20, $h, 'Tidak Diperiksa', 0, 1);
        }
        
        //$this->fpdf->Cell(60, 5, '', 0, 1);

        $this->fpdf->Cell(6, $h, '', 0, 0);
        $this->fpdf->Cell(59, $h, '6. Kebiasaan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 1);
        //$this->fpdf->Cell(60, 5, '', 0, 1);

        $this->fpdf->Cell(12, $h, '', 0, 0);
        $this->fpdf->Cell(53, $h, 'a. Merokok', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $Merokok, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);

        $this->fpdf->Cell(43, $h, 'c. Minum kopi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $Kopi, 0, 1);

        $this->fpdf->Cell(12, $h, '', 0, 0);
        $this->fpdf->Cell(53, $h, 'b. Alkohol', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $Alkohol, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);

        $this->fpdf->Cell(43, $h, 'd. Olahraga', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $Olahraga, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(0, $h, 'RIWAYAT PENYAKIT KELUARGA', 0, 1, 'L');

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '1. Bapak', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $RPKBapak, 0, 1);

        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '2. Ibu', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $RPKIbu, 0, 1);

        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '3. Kakek', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(0, $h, $RPKKakek, 0, 1);

        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '4. Nenek', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(0, $h, $RPKNenek, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(0, $h, 'RIWAYAT PENYAKIT SEKARANG', 0, 1, 'L');

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '1. Sedang Menderita Penyakit', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Sedang_Sakit, 0, 1);

        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '2. Sedang Menjalani Pengobatan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Sd_Pengobatan, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(0, 7, 'PEMERIKSAAN FISIK', 0, 0, 'L');
        $this->fpdf->Cell(0, 6, '', 0, 1);

        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(0, $h, '1. Tanda Vital', 0, 1);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, $h, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Nadi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $Nadi.' Per Menit', 0, 0);
        // $this->Cell(20, 7, '', 0, 0);

        $this->fpdf->Cell(10, $h, '', 0, 0);
        $this->fpdf->Cell(8, $h, 'Isi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $IsiNadi, 0, 0);
        // $this->Cell(60, 5, '', 0, 0);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(9, $h, 'Irama', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $IramaNadi, 0, 1);

        // $this->Cell(50, 2, '', 0, 1);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Pernafasan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Pernafasan.' Per Menit', 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. Tekanan Darah (duduk)', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(4, $h, $TDSistole . '/' . $TDDiastole . ' mmHg', 0, 1);
        // $this->Cell(60, 5, '', 0, 0);

        $this->fpdf->Cell(10, $h, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Suhu Badan', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $SuhuBadan . ' C', 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, $h, '2. Status Gizi', 0, 0);
        $this->fpdf->Cell(45, $h, '', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Tinggi Badan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $TB.' cm', 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Berat Badan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $BB.' kg', 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. BMI', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(4, $h, $BMI, 0, 0);

        $this->fpdf->Cell(5, $h, '', 0, 0);
        $this->fpdf->Cell(12, $h, ', Kriteria', 0, 0);
        $this->fpdf->Cell(5, $h, '', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $KetBMI, 0, 0);
        $this->fpdf->Cell(60, $h, '', 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Kondisi Nutrisi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(0, $h, $KondisiNutrisi, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(49, $h, '3.Tingkat Kesadaran Dan Kondisi Umum', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a.Kesadaran', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Kesadaran_, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b.Kualitas Kontak', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Kualitas_Kontak, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c.Tampak Kesakitan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Tampak_Kesakitan, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd.Berjalan ada gangguan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $BerjalanAda_Gangguan, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '4. Kelenjar Getah Bening', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Leher', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Leher, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Submandibula', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Submandibula, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. Ketiak', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Ketiak, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Inguinal', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Inguinal, 0, 1);

        // END Page 2

        // PAGE 3

        //Line 1
        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '5. Kepala', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Tulang', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $TulangKepala, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Kulit Kepala', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $KulitKepala, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. Rambut', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Rambut, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Bentuk Wajah', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $BentukWajah, 0, 1);

        //Line 2
            $hm = 4;

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $hm, '5. Mata', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $hm, 'a. Ketajaman Penglihatan', 0, 1);
        
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '      Tanpa Koreksi', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOD ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(25, $hm, $Tako_AVOD, 0, 0);

        $this->fpdf->Cell(10, $hm, 'AVOS ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(20, $hm, $Tako_AVOS, 0, 1);
        
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '      Setelah Koreksi', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOD ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, 'S : ', 0, 0);
        $this->fpdf->Cell(15, $hm, $Seko_AVODS, 0, 0);
        $this->fpdf->Cell(5, $hm, 'C : ', 0, 0);
        $this->fpdf->Cell(9, $hm, $Seko_AVODC, 0, 0);


        $this->fpdf->Cell(10, $hm, 'Axis  ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, $Seko_AVODAxis, 0, 0);
        $this->fpdf->Cell(4, $hm, '=>', 0, 0);
        $this->fpdf->Cell(20, $hm, $Seko_AVODMenjadi, 0, 1);


        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOS ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, 'S : ', 0, 0);
        $this->fpdf->Cell(15, $hm, $Seko_AVOSS, 0, 0);
        $this->fpdf->Cell(5, $hm, 'C : ', 0, 0);
        $this->fpdf->Cell(9, $hm, $Seko_AVOSC, 0, 0);

        $this->fpdf->Cell(10, $hm, 'Axis  ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, $Seko_AVOSAxis, 0, 0);
        $this->fpdf->Cell(4, $hm, '=>', 0, 0);
        $this->fpdf->Cell(20, $hm, $Seko_AVOSMenjadi, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '', 0, 0);
        $this->fpdf->Cell(10, $hm, 'Add ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(4, $hm, 'S : ', 0, 0);
        $this->fpdf->Cell(1, $hm, '', 0, 0);
        $this->fpdf->Cell(15, $hm, $Seko_Add, 0, 0);
        $this->fpdf->Cell(4, $hm, '', 0, 0);
        $this->fpdf->Cell(1, $hm, '', 0, 0);
        $this->fpdf->Cell(1, $hm, '', 0, 0);


        $this->fpdf->Cell(8, $hm, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(10, $hm, 'PD  ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(20, $hm, $Seko_PD, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '      Keterangan', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOD ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, $Seko_AVODKet, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOS ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, $Seko_AVOSKet, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '      Kacamata', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOD ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, 'S : ', 0, 0);
        $this->fpdf->Cell(15, $hm, $Kcmt_AVODS, 0, 0);
        $this->fpdf->Cell(5, $hm, 'C : ', 0, 0);
        $this->fpdf->Cell(9, $hm, $Kcmt_AVODC, 0, 0);

        $this->fpdf->Cell(10, $hm, 'Axis  ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, $Kcmt_AVODAxis, 0, 0);
        $this->fpdf->Cell(4, $hm, '=>', 0, 0);
        $this->fpdf->Cell(20, $hm, $Kcmt_AVODMenjadi, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '', 0, 0);
        $this->fpdf->Cell(10, $hm, 'AVOS ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, 'S : ', 0, 0);
        $this->fpdf->Cell(15, $hm, $Kcmt_AVOSS, 0, 0);
        $this->fpdf->Cell(5, $hm, 'C : ', 0, 0);
        $this->fpdf->Cell(9, $hm, $Kcmt_AVOSC, 0, 0);

        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(10, $hm, 'Axis  ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, $Kcmt_AVOSAxis, 0, 0);
        $this->fpdf->Cell(4, $hm, '=>', 0, 0);
        $this->fpdf->Cell(20, $hm, $Kcmt_AVOSMenjadi, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(45, $hm, '', 0, 0);
        $this->fpdf->Cell(10, $hm, 'Add ', 0, 0);
        $this->fpdf->Cell(4, $hm, ': ', 0, 0);
        $this->fpdf->Cell(5, $hm, 'S : ', 0, 0);
        $this->fpdf->Cell(15, $hm, $Kcmt_Add, 0, 0);
        $this->fpdf->Cell(6, $hm, '', 0, 1);


        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(50, 7, '', 0, 1);
        $this->fpdf->Cell(72, 7, '', 0, 0);
        $this->fpdf->Cell(10, $h, 'Kanan', 0, 0);
        $this->fpdf->Cell(24, $h, '', 0, 0);
        $this->fpdf->Cell(10, $h, 'Kiri', 0, 0);
        $this->fpdf->Cell(30, $h, '', 0, 0);
        $this->fpdf->Cell(10, $h, 'Keterangan', 0, 1);

        if ($KetKonjungtiva == null || $KetKonjungtiva == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Konjungtia', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $KonjungtivaKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $KonjungtivaKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetKonjungtiva, 0, 1);

        if ($KetKesegarisan == null || $KetKesegarisan == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. Kesegarisan', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $Kesegarisankanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $KesegarisanKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetKesegarisan, 0, 1);

        if ($KetSklera == null || $KetSklera == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Sklera', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $SkleraKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $SkleraKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetSklera, 0, 1);

        if ($KetLensaMata == null || $KetLensaMata == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'e. Lensa Mata', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $LensaMataKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $LensaMataKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetLensaMata, 0, 1);

        if ($KetKornea == null || $KetKornea == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'f. Kornea', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $KorneaKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $KorneaKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetKornea, 0, 1);

        if ($KetBuluMata == null || $KetBuluMata == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'g. Bulu Mata', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $BuluMataKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $BuluMatakiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetBuluMata, 0, 1);

        if ($KetTekananBM == null || $KetTekananBM == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'h. Tekanan Bola Mata', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $TekananBMKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $TekananBMKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetTekananBM, 0, 1);

        if ($KetTBWarana == null || $KetTBWarana == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'i. Tes Buta Warna', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $TBWarnaKa, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $TBWarnaKi, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetTBWarana, 0, 1);
        

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(66, $hm, '7. Telinga', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(10, $h, 'Kanan', 0, 0);
        $this->fpdf->Cell(24, $h, '', 0, 0);
        $this->fpdf->Cell(10, $h, 'Kiri', 0, 0);
        $this->fpdf->Cell(30, $h, '', 0, 0);
        $this->fpdf->Cell(10, $h, 'Keterangan', 0, 1);

        if ($KetDaunTelinga == null || $KetDaunTelinga == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Daun Telinga', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $DaunTelingaKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $DaunTelingaKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetDaunTelinga, 0, 1);

        if ($KetLiangTelinga == null || $KetLiangTelinga == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Liang Telinga', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $LiangTelingaKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $LiangTelingaKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetLiangTelinga, 0, 1);

        if ($KetSerumen == null || $KetSerumen == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(48, $h, '-Serumen', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $SerumenKanan, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $SerumenKiri, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(20, $h, $KetSerumen, 0, 1);

        if ($KetMembranTimpani == null || $KetMembranTimpani == ''){
            $cell = 'Cell';
        }else{
            $cell = 'CellFitScale';
        }

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Membran Timpani', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->Cell(20, $h, $MembranTimpaniKa, 0, 0);
        $this->fpdf->Cell(14, $h, '', 0, 0);
        $this->fpdf->Cell(20, $h, $MembranTimpaniKi, 0, 0);
        $this->fpdf->Cell(20, $h, '', 0, 0);
        $this->fpdf->$cell(0, $h, $KetMembranTimpani, 0, 1);

        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Lain-Lain', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $TelingaLainLain, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '8. Hidung', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Meatus nasi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $MeatusNasi, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Septum nasi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $SeptumNasi, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. Konka Nasal', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $KonkaNasal, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Nyeri Ketok Sinus', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $KetokSinus, 0, 1);

        //MB
        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '9. Mulut Dan Bibir', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Bibir', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Bibir, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. Lidah', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Lidah, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. Gusi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Gusi, 0, 1);

        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. Lain-Lain', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $MulutLainLain, 0, 1);

        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        // end page 3


        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '10.  Gigi dan Gusi', 0, 0);
        $this->fpdf->Cell(7, 7, '', 0, 0);

        $this->fpdf->Cell(40, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, '(D: Decay / M: Missing / F: Filling)', 0, 0);

        //BR
        $this->fpdf->Cell(0, 4, '', 0, 1);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(56, 4, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(8, 4, $GA18, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA17, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA16, 1, 0, 'C');
        $this->fpdf->Cell(9, 4, $GA15, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA14, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA13, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA12, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA11, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA21, 1, 0, 'C');
        $this->fpdf->Cell(9, 4, $GA22, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA23, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA24, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA25, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA26, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA27, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GA28, 1, 0, 'C');


        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        // $this->fpdf->Cell(14, 0, ' ', 0, 0);
        $gety = $this->fpdf->getY();
        $this->fpdf->Image('assets/img/Gigi1.png', 15, $gety, 50, 0);
        $this->fpdf->Cell(7, 7, '', 0, 0);

        $this->fpdf->Cell(40, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', '', 9);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $gety = $this->fpdf->getY();
        $this->fpdf->Image('assets/img/Gigi2.png', 66, $gety, 130, 0);
        $this->fpdf->Cell(20, 0, '', 0, 0);

        //BR
        $this->fpdf->Cell(0, 40, '', 0, 1);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(56, 4, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'i', 10);
        $this->fpdf->Cell(8, 4, $GB48, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB47, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB46, 1, 0, 'C');
        $this->fpdf->Cell(9, 4, $GB45, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB44, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB43, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB42, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB41, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB31, 1, 0, 'C');
        $this->fpdf->Cell(9, 4, $GB32, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB33, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB34, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB35, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB36, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB37, 1, 0, 'C');
        $this->fpdf->Cell(8, 4, $GB38, 1, 0, 'C');

        $this->fpdf->Cell(0, 15, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '11.  Tenggorokan', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Pharynx', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Pharynx, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Ukuran Tonsil', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $TonsilKanan, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $TonsilKiri, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Palatum', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Palatum, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Lain-Lain', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $TenggorokanLainLain, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '12.  Leher', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Gerakan Leher', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $GerakanLeher, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Otot-otot Leher', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $OtotLeher, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Kelenjar Tyroid', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $KelenjarTyroid, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Pulsasi Carotis', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $PulsasiCarotis, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'e.Tekanan vena jugularis', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $PulsasiCarotis, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'f.Trachea', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Trachea, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'g.Lain-lain', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $LeherLain2, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '13.  Dada', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Bentuk', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $BentukDada, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Mammae', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Mammae, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Lain-lain', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $DadaLain2, 0, 0);
        // PAGE 4

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '14.  Paru-paru dan Jantung', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Palpasi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_Palpasi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Perkusi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Paru_PerkusiKanan, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Paru_PerkusiKanan, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Iktus Kordis', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_IktusKordis, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Batas Jantung', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_BatasJantung, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Auskultasi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Bunyi Napas', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_BunyiNapasKanan, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_BunyiNapasKiri, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Bunyi Napas Tambahan', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_BNPTambahanKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_BNPTambahanKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Bunyi Jantung', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Paru_BNPTambahanKi, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '15.  Abdomen', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Inspeksi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Abdo_Inspeksi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Perkusi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Abdo_Perkusi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Auskultasi bising usus', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Abdo_Perkusi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Hati', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Abdo_Hati, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'e.Limpa', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Abdo_Limpa, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'f.Ginjal', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Abdo_GinjalKa, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Abdo_GinjalKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'g.Ballotement', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Abdo_BallotementKa, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Abdo_BallotementKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'h.Nyeri Costo Vertebrae', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Abdo_NCVKanan, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ': ', 0, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(63, 0, $Abdo_NCVKiri, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'i.Lain-lain', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Abdo_LainLain, 0, 0);


        $this->fpdf->Cell(0, 10, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '16.  Genitourinaria', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Kandung Kemih', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $KandungKemih, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Anus / rectum / perinal', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Anus, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Genitalia External', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $GenitaliaEksternal, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Prostat (khusus Pria)', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Prostat, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '17.  Vertebra', 0, 0);
        $this->fpdf->Cell(48, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', '', 9);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Vertebra, 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '18.  Tulang/Sendi Ekstrimitas atas', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, '', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ' ', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Simetri', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_SimetriKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_SimetriKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Gerakan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_GerakanKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_GerakanKa, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Tulang', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_TulangKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_TulangKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Sensibilitas', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_SensibilitasKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_SensibilitasKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'e.Oedema', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_OedemaKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_OedemaKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'f.Varises', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_VarisesKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_VarisesKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'g.Kekuatan Otot', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_KOtotKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_KOtotKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'h.Vaskulerisasi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_VaskularisasiKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_VaskularisasiKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'i.Kelainan Kuku/Jari', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_KelKukuKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_KelKukuKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'j.Keterangan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Ekstra_Keterangan, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '19.  Tulang/Sendi Ekstrimitas bawah', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, '', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ' ', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Simetri', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_SimetriKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_SimetriKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Gerakan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_GerakanKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_GerakanKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Kekuatan Otot', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_KOKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_KOKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Tulang', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_TulangKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_TulangKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'e.Sensibilitas', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_SensibilitasKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_SensibilitasKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'f.Oedema', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_OedemaKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_OedemaKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'g.Varises', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_VarisesKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_VarisesKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'h.Vaskularisasi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_VaskularKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_VaskularKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'i.Kelainan Kuku/Jari', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_KelKukuKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_KelKukuKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'j.Keterangan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $EkstrB_Keterangan, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '20.  Otot Motorik(Secara Keseluruhan)', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, '', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ' ', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Trofi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_TrofiKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_TrofiKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Tonus', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_TonusKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_TonusKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Gerakan Abnormal', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_GerAbnoKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_GerAbnoKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'd.Keterangan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Omot_Keterangan, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '21.  Fungsi Sensorik dan Otonom', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, '', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ' ', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Fungsi Sensorik', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $FuSen_FSensorikKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $FuSen_FSensorikKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Fungsi Otonom', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $FuSen_FotonomKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $FuSen_FotonomKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Keterangan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $FuSen_Keterangan, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '22.  Syaraf dan Fungsi Luhur', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Daya ingat', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $SFL_DISegera, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Orientasi', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Waktu', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $SFL_OrientasiWaktu, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Tempat', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $SFL_OrientasiTempat, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Orang', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $SFL_OrientasiOrang, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'c.Keterangan', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $SFL_KSOKeterangan, 0, 0);

        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '23.  Refleks', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        // $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, 'a.Refleks Fisiologis', 0, 0);
        $this->fpdf->Cell(45, 7, '', 0, 0);
        $this->fpdf->Cell(11, 0, 'Kanan', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, '', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->Cell(6, 0, 'Kiri', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        $this->fpdf->Cell(2, 0, ' ', 0, 0);
        $this->fpdf->Cell(63, 0, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 3, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Patella', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $RFL_PatellaKa, 0, 0);
        $this->fpdf->Cell(57, 0, '', 0, 0);
        $this->fpdf->Cell(20, 0, $RFL_PatellaKi, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 3, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Lainnya', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $RFL_Lainnya, 0, 0);
        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 3, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Refleks Patologi babinsky', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $RFL_PBKa, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 3, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Lainnya', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $RFL_PBLainnya, 0, 0);
        // PAGE 5




        $this->fpdf->Cell(0, 7, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(14, 0, '24.  Kulit', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);

        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'a.Kulit', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $Kulit, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(13, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, 'b.Selaput Lender', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $SelaputLendir, 0, 0);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(50, 4, '', 0, 1);
        $this->fpdf->Cell(20, 7, '', 0, 0);
        $this->fpdf->Cell(10, 0, '-Lainnya', 0, 0);
        $this->fpdf->Cell(38, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, ': ', 0, 0);
        $this->fpdf->Cell(20, 0, $KulitLainnya, 0, 0);

        
        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '25. Pemeriksaan Fisik Khusus', 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'a. Radiologi', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_Radiologi, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. USG', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_USG, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'b. USG', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_USG, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'c. EKG', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_EKG, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'd. EMG', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_EMG, 0, 1);
        
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'e. Spirometri', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_Spirometri, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'f. Audiometri', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_Audiometri, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'g. Treadmill', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_Treadmill, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'h. Echo', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_Echo, 0, 1);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(10, 7, '', 0, 0);
        $this->fpdf->Cell(55, $h, 'i. Laboratorium', 0, 0);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $PFK_Lab, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '26. Resume', 0, 0);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $ResumeKelainan, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '27. Diagnosa Kerja', 0, 0);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $DiagnosaKerja, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '28. KATEGORI KESEHATAN', 0, 0);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $KetKesehatan, 0, 1);

        $this->fpdf->Cell(0, 4, '', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(6, 7, '', 0, 0);
        $this->fpdf->Cell(59, $h, '29. SARAN', 0, 0);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->Cell(4, $h, ': ', 0, 0);
        $this->fpdf->MultiCell(0, $h, $Saran, 0, 1);

        $this->fpdf->Cell(1, $h, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(131, 5, '', 0, 0);
        $this->fpdf->Cell(14, 0, 'Jakarta, ', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, '31 Juli 2023 ', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(130, 5, '', 0, 0);
        $this->fpdf->Cell(14, 0, 'RUMAH SAKIT YARSI ', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, '', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $this->fpdf->Cell(0, 5, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(133, 5, '', 0, 0);
        $this->fpdf->Cell(14, 0, 'Medical Check Up', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, '', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        $isiqrcode = $NoRegistrasi;
        $qrcode= QrCode::format('png')->generate($isiqrcode);
        Storage::disk('local')->put($isiqrcode.'.png', $qrcode);
        $gety = $this->fpdf->getY();
        $this->fpdf->Image('../storage/app/'.$isiqrcode.'.png', 146, $gety+2, 25, 25, "png");
        $this->fpdf->Cell(0, 30, '', 0, 1);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(121, 5, '', 0, 0);
        $this->fpdf->Cell(14, 0, 'dr. Edi Alpino Rivai S, MKK, Sp.KKLP ', 0, 0);
        $this->fpdf->Cell(1, 0, '', 0, 0);
        //$this->Cell(60,0,': '.$GLOBALS['identitas_pasien']['pname'],0,0);
        $this->fpdf->Cell(4, 0, '', 0, 0);
        $this->fpdf->Cell(52, 7, '', 0, 0);
        $this->fpdf->Cell(45, 0, '', 0, 0);

        unlink(storage_path() . "/app/". $NoRegistrasi.'.png');


        // $this->fpdf->Output();

        $rows = array();
        $pasing['NOREGISTRASI'] = $NoRegistrasi;
        $pasing['pname'] = $NamaPasien;
        $rows[] = $pasing;
        return $rows;

        // exit;
    }
    public function saveHasilMcu($noregistrasi){
        $data = $this->hasilmcu($noregistrasi);
        if($data <> null){
            $pathfilename = '../storage/app/HASILMCU_'.$noregistrasi.'.pdf';
            $filename = "HASILMCU_".$noregistrasi.".pdf";
            $this->fpdf->Output('F',$pathfilename,true); 
            $unitService  = new PdfService(); 
            return $unitService->uploaPdfMedicalCheckupbyKodeJenis($filename,$noregistrasi,"1");
            exit;
        }else{
            $response = [
                'status' => false, 
                'message' => "Generate PDF Surat bebas Narkoba Tidak Berhasi, Data Tidak Ada.", 
            ];
            return response()->json($response, 200);
        }
    }
  
    public function viewHasilMcu($noregistrasi){
        $data = $this->hasilmcu($noregistrasi);
        if($data <> null){
            //$fileName = $data[0]['pname'].' - '.$data[0]['NOREGISTRASI'].'.pdf';
            $fileName = $noregistrasi.'.pdf';
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
