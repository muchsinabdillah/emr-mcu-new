<?php

namespace App\Traits;

use Aws\S3\S3Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequisition;
use Illuminate\Support\Facades\Storage;

trait StuffTrait
{
    public function NamaDocumentConvert($jenisDocument)
    { 
        if($jenisDocument == "1"){
            $namadocument = "HASILMCU_";
        }elseif($jenisDocument == "2"){
            $namadocument = "LABORATORIUM_";
        }elseif($jenisDocument == "3"){
            $namadocument = "RADIOLOGI_";
        }elseif($jenisDocument == "4"){
            $namadocument = "EKG_";
        }elseif($jenisDocument == "5"){
            $namadocument = "TREADMILL_";
        }elseif($jenisDocument == "6"){
            $namadocument = "AUDIOMETRI_";
        }elseif($jenisDocument == "7"){
            $namadocument = "SPIROMETRI_";
        }elseif($jenisDocument == "8"){
            $namadocument = "SKBN_";
        }elseif($jenisDocument == "9"){
            $namadocument = "SKKJ_";
        }
        return $namadocument;
    }
}