<?php

namespace App\Http\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\AutoNumberTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Traits\ApiConsumse;
use App\Traits\GenerateBpjs;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PdfService extends Controller
{
    use ApiConsumse;
    // use GenerateBpjs;
    public function getRegistrationMCUbyDate($request)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "registrations/getRegistrationMCUbyDate",
                "POST",
                json_encode([
                    'tglPeriodeBerobatAwal' => $request->tglAwal,
                    'tglPeriodeBerobatAkhir' => $request->tglAkhir,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    //RADIOLOGI---------
    public function showviewOrderRadbyNoReg($noreg)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "RadiologiTransactions/viewOrderRadbyNoReg",
                "POST",
                json_encode([
                    'NoRegistrasi' => $noreg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function showviewHasilRadiology($norAccNumbereg)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "RadiologiTransactions/viewHasilRadiology",
                "POST",
                json_encode([
                    'AccNumber' => $norAccNumbereg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    //#END RADIOLOGI------------

    //LABORATORIUM------------
    public function showviewOrderLabbyNoReg($noreg)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "LaboratoriumTransactions/viewOrderLabbyNoReg",
                "POST",
                json_encode([
                    'NoRegistrasi' => $noreg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function showviewHasilLaboratorium($nolab)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "LaboratoriumTransactions/viewHasilLaboratorium",
                "POST",
                json_encode([
                    'NoTrsOrderLab' => $nolab,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    //#END LABORATORIUM-------------

    public function hasilMCU($noreg)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/hasilMCU",
                "POST",
                json_encode([
                    'NoRegistrasi' => $noreg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }

    public function uploaPdfRadiologi($path,$noregistrasi)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/uploaPdfRadiologi",
                "POST",
                json_encode([
                    "KelompokHasil" => "RADIOLOGI", 
                    "NoRegistrasi" => $noregistrasi, 
                    "Url_Pdf_Local" => $path
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function uploaPdfLaboratorium($path,$noregistrasi)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/uploaPdfLaboratorium",
                "POST",
                json_encode([
                    "KelompokHasil" => "LABORATORIUM", 
                    "NoRegistrasi" => $noregistrasi, 
                    "Url_Pdf_Local" => $path
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function uploaPdfHasilMCU($path,$noregistrasi)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/uploaPdfHasilMCU",
                "POST",
                json_encode([
                    "KelompokHasil" => "HASILMCU", 
                    "NoRegistrasi" => $noregistrasi, 
                    "Url_Pdf_Local" => $path
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function uploaPdfMedicalCheckupbyKodeJenis($path,$noregistrasi,$jenisdocument)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/uploaPdfMedicalCheckupbyKodeJenis",
                "POST",
                json_encode([
                    "KelompokHasil" =>$jenisdocument, 
                    "NoRegistrasi" => $noregistrasi, 
                    "Url_Pdf_Local" => $path
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function uploaPdfHasilMCUFinish($path,$noregistrasi)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/uploaPdfHasilMCUFinish",
                "POST",
                json_encode([
                    "NoRegistrasi" => $noregistrasi, 
                    "Url_Pdf_Local" => $path
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function listDocumentMCU($noreg)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/listDocumentMCU",
                "POST",
                json_encode([
                    'NoRegistrasi' => $noreg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function listDocumentMCUPDFReport($request)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/listReportPDFMCU",
                "POST",
                json_encode([
                    'tglPeriodeBerobatAwal' => $request->tglAwal,
                    'tglPeriodeBerobatAkhir' => $request->tglAkhir,
                    'role' => $request->role,
                    'group_jaminan' => $request->group_jaminan,
                    'id_jaminan' => $request->id_jaminan,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    // pemeriksaan treadmil
    public function showHasilPemeriksaanTreadmillbyNoReg($noreg)
    {
        // var_dump($noreg);
        // exit;

        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/hasilMCUTreadmill",
                "POST",
                json_encode([
                    'NoRegistrasi' => $noreg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }

    // Surat Kesehatan Jiwa
    public function showHasilKesehatanJiwabyNoReg($noreg)
    {
        // var_dump($noreg);
        // exit;

        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "MedicalCheckup/hasilMCUJiwa",
                "POST",
                json_encode([
                    'NoRegistrasi' => $noreg,
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }

        // Surat Kesehatan Jiwa
        public function showHasilSKBBbyNoReg($noreg)
        {
            // var_dump($noreg);
            // exit;
    
            try {
                return $this->GuzzleClientRequestPost(
                    env('API_URL_YARSI') . "MedicalCheckup/hasilMCUBebasNarkoba",
                    "POST",
                    json_encode([
                        'NoRegistrasi' => $noreg,
                    ])
                );
            } catch (\Exception $e) {
                throw new HttpException(200, $e);
            }
        }

        public function getRekapSDSbyPeriode($request)
        {
            try {
                return $this->GuzzleClientRequestPost(
                    env('API_URL_YARSI') . "MedicalCheckup/getRekapSDSbyPeriode",
                    "POST",
                    json_encode([
                        'tglPeriodeBerobatAwal' => $request->tglAwal,
                        'tglPeriodeBerobatAkhir' => $request->tglAkhir,
                    ])
                );
            } catch (\Exception $e) {
                throw new HttpException(200, $e);
            }
        }

        
        public function getNamaPenjamin($idgroupjaminan)
        {
            try {
                return $this->GuzzleClientRequest(
                    env('API_URL_YARSI') . "masterdata/reg/jaminan/view/".$idgroupjaminan ,
                    "GET"
                );
            } catch (\Exception $e) {
                throw new HttpException(200, $e);
            }
        }

        public function getRekap($request)
        {
            try {
                return $this->GuzzleClientRequestPost(
                    env('API_URL_YARSI') . "MedicalCheckup/getRekapMCU",
                    "POST",
                    json_encode([
                        'tglAwal' => $request->tglAwal,
                        'tglAkhir' => $request->tglAkhir,
                        'JenisRekap' => $request->JenisRekap,
                        'TipePenjamin' => $request->TipePenjamin,
                        'NamaPenjamin' => $request->NamaPenjamin,
                    ])
                );
            } catch (\Exception $e) {
                throw new HttpException(200, $e);
            }
        }
}