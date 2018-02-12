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

    public function bookingReference($type){
        if($type == 'flight'){
            return 'AIR-'. rand(000,999) .'-KLF-'.uniqid();
        }elseif($type == 'hotel'){
            return 'HOT-'. rand(000,999) .'-KLF-'.uniqid();
        }elseif($type == 'package'){
            return 'PKG-'. rand(000,999) .'-KLF-'.uniqid();
        }elseif($type == 'car'){
            return 'CAR-'. rand(000,999) .'-KLF-'.uniqid();
        }elseif($type == 'wallet-deposit'){
            return 'WDR-'. rand(000,999) .'-KLF-'.uniqid();
        }
    }

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

    public function mungXmlToArray($xml){
        $obj = SimpleXML_Load_String($xml);
        if ($obj === FALSE) return $xml;
        // GET NAMESPACES, IF ANY
        $nss = $obj->getNamespaces(TRUE);
        if (empty($nss)) return $xml;

        // CHANGE ns: INTO ns_
        $nsm = array_keys($nss);
        foreach ($nsm as $key)
        {
            // A REGULAR EXPRESSION TO MUNG THE XML
            $rgx
                = '#'               // REGEX DELIMITER
                . '('               // GROUP PATTERN 1
                . '\<'              // LOCATE A LEFT WICKET
                . '/?'              // MAYBE FOLLOWED BY A SLASH
                . preg_quote($key)  // THE NAMESPACE
                . ')'               // END GROUP PATTERN
                . '('               // GROUP PATTERN 2
                . ':{1}'            // A COLON (EXACTLY ONE)
                . ')'               // END GROUP PATTERN
                . '#'               // REGEX DELIMITER
            ;
            // INSERT THE UNDERSCORE INTO THE TAG NAME
            $rep
                = '$1'          // BACKREFERENCE TO GROUP 1
                . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
            ;
            // PERFORM THE REPLACEMENT
            $xml =  preg_replace($rgx, $rep, $xml);
        }
        return json_decode(json_encode(SimpleXML_Load_String($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    public function priceTypeCalculator($type,$value,$amount){
        if($type == 1){
            return (($value/100) * $amount);
        }if($type == 2){
            return $value;
        }
    }

    public function rateAmountCalculator($amount,$rate){
        if($rate == 0){
            return '';
        }
        return $amount/$rate;
    }

    public static function yesOrNo($type){
        if($type == 1){
            return '<i class="fa fa-check"></i>';
        }elseif($type == 0){
            return '<i class="fa fa-times"></i>';
        }
    }

    public static function cityImage($cityCode){
        return 'https://photo.hotellook.com/static/cities/960x720/'.$cityCode.'.jpg';
    }

    public static function iataCode($string){
        if(strlen($string) == 3){
            return $string;
        }
        return substr($string, 0,3);
    }
}