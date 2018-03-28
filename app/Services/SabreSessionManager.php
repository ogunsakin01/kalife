<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 11/21/2017
 * Time: 10:36 AM
 */

namespace App\Services;

use App\SearchSessionToken;
use App\Services\SabreConfig;
use App\Services\SabreSessionsXml;
use App\SessionToken;

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
        $file = fopen($action.'.xml','w');
        fwrite($file,$xml_post_string);
        fclose($file);
        return $this->sabreConfig->callSabre($headers,$xml_post_string);
    }

    public function createSession(){
        $create_session = $this->sessionCall($this->sabreSessionXml->sessionCreateHeader(),$this->sabreSessionXml->sessionCreateBody(),'CreateSessionRQ');
        $file = fopen('CreateSessionRS.xml','w');
        fwrite($file,$create_session);
        fclose($file);
      return $this->sessionInfo($create_session);
    }

    public function refreshSession($token,$message_id,$conv_id){
        $refresh_session = $this->sessionCall($this->sabreSessionXml->sessionRefreshHeader($token,$message_id,$conv_id),$this->sabreSessionXml->sessionRefreshBody(),'OTA_PingRQ');
        $file = fopen('OTA_PingRS.xml','w');
        fwrite($file,$refresh_session);
        fclose($file);
        return $this->sessionInfo($refresh_session);

    }

    public function closeSession($token,$message_id,$conv_id){
        $close_session = $this->sessionCall($this->sabreSessionXml->sessionCloseHeader($token,$message_id,$conv_id),$this->sabreSessionXml->sessionCloseBody(),'SessionCloseRQ');
        $file = fopen('SessionCloseRS.xml','w');
        fwrite($file,$close_session);
        fclose($file);
        return $this->sessionInfo($close_session);

    }

    public function sessionInfo($plainResponse){
        return $this->sabreConfig->mungXmlToArray($plainResponse);
    }

    public function sessionCreateValidator($ResponseArray){
        if(!empty($ResponseArray)){
            $session_token = $ResponseArray['soap-env_Header']['wsse_Security']['wsse_BinarySecurityToken'];
            $session_message_id = $ResponseArray['soap-env_Header']['eb_MessageHeader']['eb_MessageData']['eb_MessageId'];
            $session_conv_id  = $ResponseArray['soap-env_Body']['SessionCreateRS']['ConversationId'];
            if($session_token != null){
                return array(
                    'token'         => $session_token,
                    'message_id'    => $session_message_id,
                    'conv_id'       => $session_conv_id
                );
            }else{
                return 2;
            }
        }else{
            return 0;
        }

    }

    public function sessionRefreshValidator($ResponseArray){
        if(!empty($ResponseArray)){
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
            return $this->createSessionStore();
        }else{
            SessionToken::store($session_data);
            return $session_data;
        }
    }

    public function sessionStore()
    {
     $session_info = SessionToken::getToken();
     if(empty($session_info || is_null($session_info))){
        return $this->createSessionStore();
     }
     else{
         $created_at = strtotime($session_info['created_at']);
         $now = strtotime(date('Y-m-d H:i:s'));
         $difference = round(abs($now - $created_at) / 60,2);
         if($difference > 5){
             $refreshStatus = $this->sessionRefreshValidator($this->refreshSession($session_info->token,$session_info->message_id,$session_info->conv_id));
             if($refreshStatus == 1){
                 return $this->getTokenSort($session_info);
             }elseif($refreshStatus == 2){
                 return $this->createSessionStore();
             }elseif($refreshStatus == 3){
                 return 3;
             }elseif($refreshStatus == 0){
                 return 0;
             }else{
                 return 31;
             }
         }
         else{
             return $this->getTokenSort($session_info);
         }
     }
    }

    public function getTokenSort($response){
        return [
                 'message_id' => $response->message_id,
                 'token' => $response->token,
                 'conv_id' => $response->conv_id
               ];
    }

    public function sessionTokenCloseValidator($response){
        if(empty($response)){
            return 0;
        }elseif(isset($response['soap-env_Body']['SessionCloseRS']['@attributes']['status'])){
            $responseMessage = $response['soap-env_Body']['SessionCloseRS']['@attributes']['status'];
            if($responseMessage == 'Approved'){
                return 1;
            }else{
                return 2;
            }
        }else{
            return 21;
        }

    }

    public function closeSearchSession($sessionInfo){
        $close_session = $this->sessionCall($this->sabreSessionXml->sessionCloseHeader($sessionInfo->token,$sessionInfo->message_id,$sessionInfo->conv_id),$this->sabreSessionXml->sessionCloseBody(),'SessionCloseRQ');
        $file = fopen('SessionCloseRS.xml','w');
        fwrite($file,$close_session);
        fclose($file);
        return $this->sessionInfo($close_session);
    }

    public function createSearchSessionStore(){
        $session_data = $this->sessionCreateValidator($this->createSession());
        if($session_data == 0){
            return 0;
        }elseif($session_data == 2){
            return $this->createSearchSessionStore();
        }else{
            SearchSessionToken::store($session_data);
            return $session_data;
        }
    }

    public function searchSessionStore(){
        $token = SearchSessionToken::where('available_status', 1)->first();
        if(!empty($token) || !is_null($token)){
            $created_at = $token->created_at;
            $now = strtotime(date('Y-m-d H:i:s'));
            $difference = round((strtotime($now) - strtotime($created_at)) / 60);
            if($difference > 5){
                $refreshStatus = $this->sessionRefreshValidator($this->refreshSession($token->token,$token->message_id,$token->conv_id));
                if($refreshStatus == 1){
                    return $this->getTokenSort($token);
                }elseif($refreshStatus == 2){
                    return $this->createSearchSessionStore();
                }elseif($refreshStatus == 3){
                    return 3;
                }elseif($refreshStatus == 0){
                    return 0;
                }else{
                    return 31;
                }
            }
            else{
                $this->closeSearchSession($token);
                return $this->createSearchSessionStore();
            }
        }else{
            return $this->createSearchSessionStore();
        }

    }


}