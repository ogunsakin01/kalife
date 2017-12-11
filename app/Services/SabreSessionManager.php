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

    public function createSession(){
      return $this->sessionInfo($this->sessionCall($this->sabreSessionXml->sessionCreateHeader(),$this->sabreSessionXml->sessionCreateBody(),'CreateSessionRQ'));
    }

    public function refreshSession($token,$message_id){
        return $this->sessionInfo($this->sessionCall($this->sabreSessionXml->sessionRefreshHeader($token,$message_id),$this->sabreSessionXml->sessionRefreshBody(),'OTA_PingRQ'));

    }

    public function closeSession($token,$message_id){
      return $this->sessionInfo($this->sessionCall($this->sabreSessionXml->sessionCloseHeader($token,$message_id),$this->sabreSessionXml->sessionCloseBody(),'OTA_PingRQ'));

    }

    public function sessionInfo($plainResponse){
        return $this->sabreConfig->mungXmlToArray($plainResponse);
    }

    public function sessionCreateValidator($ResponseArray){
        if($ResponseArray){
            $session_token = $ResponseArray['soap-env_Header']['wsse_Security']['wsse_BinarySecurityToken'];
            $session_message_id = $ResponseArray['soap-env_Header']['eb_MessageHeader']['eb_MessageData']['eb_MessageId'];
            if($session_token != null){
                return array(
                    'session_token' => $session_token,
                    'message_id'    => $session_message_id
                );
            }else{
                return 2;
            }
        }else{
            return 0;
        }

    }

    public function sessionRefreshValidator($ResponseArray){
        if($ResponseArray){
            if(isset($ResponseArray['soap-env_Body']['soap-env_Fault']['faultcode'])){
                return 2;
            }elseif(isset($ResponseArray['soap-env_Body']['OTA_PingRS']['Success'])){
                return 1;
            }else{
                return 3;
            }
        }else{
            return 0;
        }
    }

    public function sessionCloseValidator($ResponseArray){

    }

    public function ifSessionExists($session_name)
    {
        if (session()->has($session_name))
        {
            return true;
        }

        return false;
    }

    public function ifSessionIsEmpty($session_name)
    {
        if (empty(session()->get($session_name)) || is_null(session()->get($session_name)))
        {
            return true;
        }

        return false;
    }

    public function createSessionStore(){
        $session_data = $this->sessionCreateValidator($this->createSession());
        if($session_data == 0){
            return 0;
        }elseif($session_data == 2){
            return 2;
        }else{
            session()->put('session_info',$session_data);
//            return session()->all();
        }
    }

    public function sessionStore()
    {
        if ($this->ifSessionExists('session_info'))
        {
            if ($this->ifSessionIsEmpty('session_info'))
            {
               return $this->createSessionStore();
            }
            else{
                $token = session()->get('session_info')['session_token'];
                $messageId = session()->get('session_info')['message_id'];

                $refresh_data = $this->sessionRefreshValidator($this->refreshSession($token,$messageId));
                if($refresh_data == 0){
                     return session()->get('session_info');
                }elseif($refresh_data == 1){
                    return session()->get('session_info');
                }elseif($refresh_data == 2){
                    return $this->createSessionStore();
                }elseif($refresh_data == 3){
                    return 3;
                }
                /**
                Might return 3 on worst case scenario of errors
                 * add elseif($refresh_data == 3){
                       return 3;
                 * }
                 */
            }
        }
        else{
            return $this->createSessionStore();
        }

    }

    public function refreshSessionToken()
    {
        if ($this->ifSessionExists('session_info'))
        {
            if ($this->ifSessionIsEmpty('session_info'))
            {
                return 4;
            }
            else{
                $token = session()->get('session_info')['session_token'];
                $messageId = session()->get('session_info')['message_id'];

                $refresh_data = $this->sessionRefreshValidator($this->refreshSession($token,$messageId));
                if($refresh_data == 0){
                    return 0;
                }elseif($refresh_data == 1){
                    return 1;
                }elseif($refresh_data == 2){
                    return 2;
                }elseif($refresh_data == 3){
                    return 3;
                }
                /**
                Might return 3 on worst case scenario of errors
                 * add elseif($refresh_data == 3){
                return 3;
                 * }
                 */
            }
        }else{
            return 4;
        }

    }

}