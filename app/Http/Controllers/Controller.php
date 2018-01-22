<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function guzzle($url,$body=array())
    {
        //統一處裡函數
        try{
            // $server_url = env("APP_SERVER");
            // $url = $server_url.$url;
            $client = new Client();
            $response = $client->request("GET", $url ,[
            	'verify' => false,
                'headers'     => ['Client-ID' => "1gnn87syujsp2ye8avk3i4l5g466lu"],
                'query' => $body
            ]);
            $data = json_decode($response->getBody(),true);
            return $data;
        }catch (GuzzleException $e) {
        	return $e;
            // Session::flush();
            // header("Location: ".url('/'));
        }
    }
}
