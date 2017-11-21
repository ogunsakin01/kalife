<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 11/21/2017
 * Time: 10:56 AM
 */

namespace App\Services;

use App\Services\SabreConfig;
class SabreSessionsXml{
    public $sabreConfig;
    public function __construct(){
        $this->sabreConfig = new SabreConfig();
    }
    public function sessionCreateHeader(){
        $time_stamp = date("y-m-d");
      return '
      <eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
      <eb:From>
      <eb:PartyId type="urn:x12.org:IO5:01">'.$_SERVER['HTTP_HOST'].'</eb:PartyId>
      </eb:From>
      <eb:To>
      <eb:PartyId type="urn:x12.org:IO5:01">' . $this->sabreConfig->soapEnvironment . '</eb:PartyId>
      </eb:To>
      <eb:CPAId>'. $this->sabreConfig->soap_ipcc . '</eb:CPAId>
      <eb:ConversationId>webservices.support@sabre.com</eb:ConversationId>
      <eb:Service eb:type="OTA">SessionCreateRQ</eb:Service>
      <eb:Action>SessionCreateRQ</eb:Action>
      <eb:MessageData>
      <eb:MessageId>1000</eb:MessageId>
      <eb:Timestamp>'.$time_stamp.'T00:00:00Z</eb:Timestamp>
      </eb:MessageData>
      </eb:MessageHeader>
      <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
      <wsse:UsernameToken>
      <wsse:Username>'. $this->sabreConfig->soap_username . '</wsse:Username>
      <wsse:Password>'. $this->sabreConfig->soap_password . '</wsse:Password>
      <Organization>'. $this->sabreConfig->soap_ipcc . '</Organization>
      <Domain>'. $this->sabreConfig->soap_domain . '</Domain>
      </wsse:UsernameToken>
      </wsse:Security>';
    }
    public function sessionRefreshHeader($token,$message_id){
     return '<eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
        <eb:ConversationId/>
        <eb:From>
        <eb:PartyId type="urn:x12.org:IO5:01">'.$_SERVER['HTTP_HOST'].'</eb:PartyId>
        </eb:From>
        <eb:To>
        <eb:PartyId type="urn:x12.org:IO5:01">'.$this->sabreConfig->soapEnvironment.'</eb:PartyId>
        </eb:To>
        <eb:CPAId>'.$this->sabreConfig->soap_ipcc.'</eb:CPAId>
        <eb:ConversationId>webservices.support@sabre.com</eb:ConversationId>
        <eb:Service>OTA_PingRQ</eb:Service>
        <eb:Action>OTA_PingRQ</eb:Action>
        <eb:MessageData>
        <eb:MessageId>'.$message_id.'</eb:MessageId>
        <eb:Timestamp>'.date("y-m-d").'T11:15:12Z</eb:Timestamp>
        <eb:TimeToLive>'.date("y-m-d").'T11:15:12Z</eb:TimeToLive>
        </eb:MessageData>
        </eb:MessageHeader>
        <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
        <wsse:BinarySecurityToken>'.$token.'</wsse:BinarySecurityToken>
        </wsse:Security>';
    }
    public function sessionCloseHeader($token,$message_id){
    return '<eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
            <eb:ConversationId/>
            <eb:From>
            <eb:PartyId type="urn:x12.org:IO5:01">'.$_SERVER['HTTP_HOST'].'</eb:PartyId>
            </eb:From>
            <eb:To>
            <eb:PartyId type="urn:x12.org:IO5:01">'.$this->sabreConfig->soapEnvironment.'</eb:PartyId>
            </eb:To>
            <eb:CPAId>'.$this->sabreConfig->soap_ipcc.'</eb:CPAId>
            <eb:ConversationId>webservices.support@sabre.com</eb:ConversationId>
            <eb:Service>SessionCloseRQ</eb:Service>
            <eb:Action>SessionCloseRQ</eb:Action>
            <eb:MessageData>
            <eb:MessageId>'.$message_id.'</eb:MessageId>
            <eb:Timestamp>'.date('Y-m-d').'T11:15:12Z</eb:Timestamp>
            <eb:TimeToLive>'.date('Y-m-d').'T11:15:12Z</eb:TimeToLive>
            </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
            <wsse:BinarySecurityToken>'.$token.'</wsse:BinarySecurityToken>
            </wsse:Security>';
    }
    public function sessionCreateBody(){
      return '<SessionCreateRQ returnContextID="true">
              <POS>
              <Source PseudoCityCode="'.$this->sabreConfig->soap_ipcc.'"/>
              </POS>
              </SessionCreateRQ>';
    }
    public function sessionRefreshBody(){
       return '<OTA_PingRQ xmlns="http://www.opentravel.org/OTA/2003/05" TimeStamp="'.date('Y-m-d').'T10:15:00-06:00" Version="1.0.0">
               <EchoData>Are you there</EchoData>
               </OTA_PingRQ>';
    }
    public function sessionCloseBody(){
       return '<SessionCloseRQ>
               <POS>
               <Source PseudoCityCode="'.$this->sabreConfig->soap_ipcc.'"/>
               </POS>
               </SessionCloseRQ>';
    }
}