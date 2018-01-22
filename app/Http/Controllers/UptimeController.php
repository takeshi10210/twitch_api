<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UptimeController extends Controller
{
    public function uptime(Request $request){
    	if($request->has("channel")||$request->input("channel")!=""){
    		$channel = $request->input("channel");
    		$url = "https://api.twitch.tv/kraken/streams/";
    		$body = array();
    		$body['channel'] = $channel;
    		$stre_data = $this->guzzle($url,$body);
    		if($stre_data["_total"] == 1){
    			$data = $stre_data["streams"];
    			$start_time = $data['0']['created_at']; 	
    			$time_diff = strtotime(date("Y-m-d H:i:s"))-strtotime($start_time);
    			$uptime = date("G小時i分s秒",$time_diff);
    			if(substr($uptime,0,1)=="0")
    				$uptime = substr($uptime,7);
    			return response("已實況:".$uptime);
    		}
    		else
    			return response($channel." 目前無開台");
    	}
    	else
    		return response("未提供頻道ID");
    }
}
