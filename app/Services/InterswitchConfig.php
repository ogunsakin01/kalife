<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 12/12/2017
 * Time: 2:55 PM
 */

namespace App\Services;


class InterswitchConfig
{

    public  $request_text_url = 'https://sandbox.interswitchng.com/webpay/pay';

    public $request_live_url = 'https://webpay.interswitchng.com/paydirect/pay';

    public  $text_query_url = 'https://sandbox.interswitchng.com/webpay/api/v1/gettransaction.json';

    public $live_query_url = 'https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json';

    public $mac_key = 'D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F';

    public $item_id = '101';

    public $product_id = '6205';

    public function __construct(){
        $this->requestActionUrl = $this->request_text_url;
        $this->queryActionUrl   = $this->text_query_url;

    }

    public function queryHash($txnRef){
        $toHash = $this->product_id.$txnRef.$this->mac_key;
        return $hash = openssl_digest($toHash, "SHA512");
    }

    public function makeRedirectUrl($page){
       return $_SERVER['HTTP_HOST'].$page;
    }

    public function transactionHash($txnRef,$amount,$redirectUrl){
        $redirectUrl = $this->makeRedirectUrl($redirectUrl);
        $toHash = $txnRef.$this->product_id.$this->item_id.$amount.$redirectUrl.$this->mac_key;
        return $hash = openssl_digest($toHash, "SHA512");
    }

    public function requery($txnRef,$amount){
        $headers = array(
            "GET /HTTP/1.1",
            "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
            "Accept-Language: en-us,en;q=0.5",
            "Keep-Alive: 300",
            "Connection: keep-alive",
            "Hash: $this->queryHash($txnRef) " );
        $url = $this->queryActionUrl.'?productid='.$this->product_id.'&transactionreference='.$txnRef.'&amount='.$amount;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER ,false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        $response  = curl_exec($ch);
        curl_close($ch);
        return $this->queryValidator($response);

    }

    public function queryValidator($response){
        if(empty($response)){
            return 0;
        }else{
            $response  = json_decode($response);
            $responseCode = $response->ResponseCode;
            if(($responseCode == "00" || $responseCode == "11" || $responseCode == "10")){
                $status = 1;
            }else{
                $status = 0;
            }
            $responseDescription = $response->ResponseDescription;
            return [
                'status' => $status,
                'responseCode' => $responseCode,
                'responseDescription' => $responseDescription
            ];
        }
    }



}