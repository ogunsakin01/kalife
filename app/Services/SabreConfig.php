<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 11/20/2017
 * Time: 2:47 PM
 */

namespace App\Services;


class SabreConfig{
    public  $rest_client_domain = 'EXT';
    public  $rest_client_group = 'DEVCENTER';
    public  $rest_user_id = 'i2rin8bj06voqx9u';
    public  $rest_client_secret = '4RAilVp3';
    public  $rest_format_version = 'V1';
    public  $soap_username = '7971';
    public  $soap_password = 'WS031315';
    public  $soap_ipcc = 'WD4H';
    public  $soap_domain = 'DEFAULT';
    public  $restEnvironment = 'https://api-crt.cert.havail.sabre.com';
    public  $soapEnvironment = 'https://sws-crt.cert.havail.sabre.com';


    public function callSabre($headers,$xml_post_string){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->soapEnvironment);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        // converting
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
}