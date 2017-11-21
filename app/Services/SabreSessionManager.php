<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 11/21/2017
 * Time: 10:36 AM
 */

namespace App\Services;

use App\Services\SabreConfig;
use App\Services\SabreSessionsXml;
class SabreSessionManager{

    public $token = null;

    public $messageId = null;
    public function __construct(){
        $this->sabreConfig = new SabreConfig();
        $this->sabreSessionXml = new SabreSessionsXml();
    }

    public function sessionCall($header,$body,$action){
        $xml_post_string = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:eb="http://www.ebxml.org/namespaces/messageHeader" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsd="http://www.w3.org/1999/XMLSchema">'
            . '<SOAP-ENV:Header>'
            . $header
            . '</SOAP-ENV:Header>'
            . '<SOAP-ENV:Body>'
            . $body
            . '</SOAP-ENV:Body>'
            . '</SOAP-ENV:Envelope>';

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: " . $action,
            "Content-length: " . strlen($xml_post_string)
        );
        return $this->sabreConfig->callSabre($headers,$xml_post_string);
    }

    public function sessionInfo($plainResponse){
     $result_object = $this->sabreConfig->mungXmlToObject($plainResponse);
     $session_token = '';
     $session_message_id = '';
     return array(
         'session_token' => $session_token,
         'message_id'    => $session_message_id
     );
    }

    public function createSession(){
      return $this->sessionInfo($this->sessionCall($this->sabreSessionXml->sessionCreateHeader(),$this->sabreSessionXml->sessionCreateBody(),'CreateSessionRQ'));
    }

    public function refreshSession(){

    }

    public function closeSession(){

    }

}