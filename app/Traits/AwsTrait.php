<?php

namespace App\Traits;

use Aws\S3\S3Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequisition;
use Illuminate\Support\Facades\Storage;

trait AwsTrait
{
    //Your Function Here
    public function UploadtoAWS($fiesNaames)
    { 
        $file_name = storage_path() . "/app/".$fiesNaames; //LABORATORIUM_RJJP020823-0108.pdf
        $source =   $file_name;
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION'),
            'http'    => ['verify' => false],
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ]
          ]);
          $keyaws = 'hasilmcu/';
          $bucket = env('AWS_BUCKET');
            $key = basename($file_name);
            $result = $s3Client->putObject([
                'Bucket' => $bucket,
                'Key'    => $keyaws . $key,
                'Body'   => fopen($source, 'r'),
                'ACL'    => 'public-read', // make file 'public', 
            ]);
            $awsurl = $result->get('ObjectURL');
            Storage::delete($file_name);
            return $awsurl; 
    } 
}
