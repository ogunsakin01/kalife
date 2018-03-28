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

     $head = '
      <eb:MessageHeader  xmlns="http://www.ebxml.org/namespaces/messageHeader">
      <eb:From>
      <eb:PartyId type="urn:x12.org:IO5:01">'.url('/').'</eb:PartyId>
      </eb:From>
      <eb:To>
      <eb:PartyId type="urn:x12.org:IO5:01">' . $this->sabreConfig->soapEnvironment . '</eb:PartyId>
      </eb:To>
      <eb:CPAId>'. $this->sabreConfig->soap_ipcc . '</eb:CPAId>
      <eb:ConversationId>V1@'. session()->token().'@'.uniqid().'@'.url('/').'</eb:ConversationId>
      <eb:Service eb:type="sabreXML">SessionCreateRQ</eb:Service>
      <eb:Action>SessionCreateRQ</eb:Action>
      <eb:MessageData>
       <MessageId>'.session()->token().'@'.url('/').'</MessageId>
       <Timestamp>'.date('Y-m-d\TH:i:s',strtotime('+1 hour')).'+01:00</Timestamp>
       <TimeToLive>'.date('Y-m-d\TH:i:s',strtotime('+2 hour')).'+01:00</TimeToLive>
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

     return $head;
    }

    public function sessionRefreshHeader($token,$message_id,$conv_id){
     return '<eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
        <eb:ConversationId/>
        <eb:From>
        <eb:PartyId type="urn:x12.org:IO5:01">'.url('/').'</eb:PartyId>
        </eb:From>
        <eb:To>
        <eb:PartyId type="urn:x12.org:IO5:01">'.$this->sabreConfig->soapEnvironment.'</eb:PartyId>
        </eb:To>
        <eb:CPAId>'.$this->sabreConfig->soap_ipcc.'</eb:CPAId>
        <eb:ConversationId>'.$conv_id.'</eb:ConversationId>
        <eb:Service>OTA_PingRQ</eb:Service>
        <eb:Action>OTA_PingRQ</eb:Action>
        <eb:MessageData>
        <eb:MessageId>'.$message_id.'</eb:MessageId>
        <eb:Timestamp>'.date('Y-m-d\TH:i:s\Z',strtotime('+1 hour')).'</eb:Timestamp>
        <eb:TimeToLive>'.date('Y-m-d\TH:i:s\Z',strtotime('+2 hour')).'</eb:TimeToLive>
        </eb:MessageData>
        </eb:MessageHeader>
        <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
        <wsse:BinarySecurityToken>'.$token.'</wsse:BinarySecurityToken>
        </wsse:Security>';
    }

    public function sessionCloseHeader($token,$message_id,$conv_id){
    return '<eb:MessageHeader SOAP-ENV:mustUnderstand="1" eb:version="1.0">
            <eb:ConversationId/>
            <eb:From>
            <eb:PartyId type="urn:x12.org:IO5:01">'.url('/').'</eb:PartyId>
            </eb:From>
            <eb:To>
            <eb:PartyId type="urn:x12.org:IO5:01">'.$this->sabreConfig->soapEnvironment.'</eb:PartyId>
            </eb:To>
            <eb:CPAId>'.$this->sabreConfig->soap_ipcc.'</eb:CPAId>
            <eb:ConversationId>'.$conv_id.'</eb:ConversationId>
            <eb:Service>SessionCloseRQ</eb:Service>
            <eb:Action>SessionCloseRQ</eb:Action>
            <eb:MessageData>
            <eb:MessageId>'.$message_id.'</eb:MessageId>
            <eb:Timestamp>'.date('Y-m-d\TH:i:s\Z',strtotime('+1 hour')).'</eb:Timestamp>
            <eb:TimeToLive>'.date('Y-m-d\TH:i:s\Z',strtotime('+2 hour')).'</eb:TimeToLive>
            </eb:MessageData>
            </eb:MessageHeader>
            <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext" xmlns:wsu="http://schemas.xmlsoap.org/ws/2002/12/utility">
            <wsse:BinarySecurityToken>'.$token.'</wsse:BinarySecurityToken>
            </wsse:Security>';
    }

    public function sessionCreateBody(){
      return '<SessionCreateRQ xmlns="http://www.opentravel.org/OTA/2002/11">
           <POS>
               <Source PseudoCityCode="WD4H" />
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