<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 12/12/2017
 * Time: 2:55 PM
 */

namespace App\Services;


use App\OnlinePayment;

class InterswitchConfig
{

    public $request_text_url = 'https://sandbox.interswitchng.com/webpay/pay';

    public $request_live_url = 'https://webpay.interswitchng.com/paydirect/pay';

    public  $text_query_url = 'https://sandbox.interswitchng.com/webpay/api/v1/gettransaction.json';

    public $live_query_url = 'https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json';

    public static $ActionUrl = 'https://sandbox.interswitchng.com/webpay/pay';

    public $mac_key = 'D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F';

    public $item_id = '101';

    public $product_id = '6205';

    public function __construct(){
        $this->requestActionUrl = $this->request_text_url;
        $this->queryActionUrl   = $this->text_query_url;

    }

    public function queryHash($txnRef){
        $toHash = $this->product_id.$txnRef.$this->mac_key;
        return openssl_digest($toHash, "SHA512");
    }

    public function transactionHash($txnRef,$amount,$redirectUrl){
        $info = [
            'txn_reference' => $txnRef,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'gateway_id' => 1,
            'payment_status' => 0
        ];
        OnlinePayment::store($info);
        $toHash = $txnRef.$this->product_id.$this->item_id.$amount.$redirectUrl.$this->mac_key;
        return openssl_digest($toHash, "SHA512");
    }

    public function requery($txnRef,$amount){
        $headers = array(
            "GET /HTTP/1.1",
            "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
            "Accept-Language: en-us,en;q=0.5",
            "Keep-Alive: 300",
            "Connection: keep-alive",
            "Hash:" . $this->queryHash($txnRef) );

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
        return $this->queryValidator($txnRef,$response);

    }

    public function queryValidator($txnRef,$response){
        if(empty($response)){
            return [
                'reference' => $txnRef,
                'status' => 0,
                'responseCode' => '--',
                'responseDescription' => 'Could not confirm payment status. Bad Internet Connection',
                'responseFull' => '0',
                'amount' => '0'
            ];
        }else{
            $response  = json_decode($response);
            $responseCode = $response->ResponseCode;
            $amount = $response->Amount;
            if(($responseCode == "00" || $responseCode == "11" || $responseCode == "10")){
                $status = 1;
            }else{
                $status = 0;
            }
            $responseDescription = $response->ResponseDescription;
            return [
                'reference' => $txnRef,
                'status' => $status,
                'responseCode' => $responseCode,
                'responseDescription' => $responseDescription,
                'responseFull' => json_encode($response,true),
                'amount' => $amount
            ];
        }
    }



}