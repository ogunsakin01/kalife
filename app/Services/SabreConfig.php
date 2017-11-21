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
    public function mungXmlToObject($xml){
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
        return simplexml_load_string($xml);
    }
    
}