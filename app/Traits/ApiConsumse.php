<?php

namespace App\Traits;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequisition;
use GuzzleHttp\Client as GuzzleClient;

trait ApiConsumse
{
    public function GuzzleClientRequest($url, $method)
    {

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => env('API_TOKEN_YARSI'),
        ];
        $client = new GuzzleClient([
            'headers' => $headers
        ]);
        $response  =
            $client->request(
                $method,
                $url,
                ["verify" => false]
            );
        if (isset($response) && $response->getStatusCode() == 200) {

            return json_decode($response->getBody()->getContents(), true);
        }
    }
    public function GuzzleClientRequestPost($url, $method, $body = [])
    {

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' =>  env('API_TOKEN_YARSI'),
        ];
        $client = new GuzzleClient([
            'headers' => $headers,
            'body' => $body
        ]);
        $response  =
            $client->request(
                $method,
                $url,
                ["verify" => false]
            );
        if (isset($response) && $response->getStatusCode() == 200) {

            return json_decode($response->getBody()->getContents(), true);
        }
    }
}