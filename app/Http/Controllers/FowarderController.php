<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FowarderController extends Controller
{   

    public function __construct(){
        $this->url = env("URL_HIT");
        $this->header = getallheaders();
    }

    public function callback_fowarder(Request $req){
        
        if(isset($this->header['X-Callback-Token'])){
            $token = $this->header['X-Callback-Token'];
        }elseif(isset($this->header['X-CALLBACK-TOKEN'])){
            $token = $this->header['X-CALLBACK-TOKEN'];
        }else{ 
            $token = $this->header['x-callback-token'];
        }

        $data = $req->toArray();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => http_build_query($data),
          CURLOPT_HTTPHEADER => array(
             'X-CALLBACK-TOKEN: '.$token,
          ),
        ));
        
        $response = curl_exec($curl);  
        curl_close($curl);
        $res['pesan'] = $response;

        return $response;
    }
}
