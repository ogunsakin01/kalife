<?php

namespace App\Services;

use App\Services\SabreConfig;

class SabreFlight
{
    public function __construct(){
      $this->sabreConfig = new SabreConfig();
    }

    public function doCall($headersXml, $body, $action) {
        //Data, connection, auth
        $soapUrl = "https://sws-crt.cert.havail.sabre.com";
        // xml post structure
        $xml_post_string = '<SOAP-ENV:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">'
            . '<SOAP-ENV:Header>'
            . $headersXml
            . '</SOAP-ENV:Header>'
            . '<SOAP-ENV:Body>'
            . $body
            . '</SOAP-ENV:Body>'
            . '</SOAP-ENV:Envelope>';

        $headers = array(
            "Content-type: text/xml;charset='utf-8'",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: " . $action,
            "Content-length: " . strlen($xml_post_string)
        );

        error_log($action);
        error_log($xml_post_string);
        error_log("------------------------------------------------");

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
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

    public function callsHeader($action){
        return '<m:MessageHeader xmlns:m="http://www.ebxml.org/namespaces/messageHeader">
			<m:From>
				<m:PartyId type="urn:x12.org:IO5:01">'.$_SERVER['HTTP_HOST'].'</m:PartyId>
			</m:From>
			<m:To>
				<m:PartyId type="urn:x12.org:IO5:01">'.$this->sabreConfig->soapEnvironment.'</m:PartyId>
			</m:To>
			<m:CPAId>'.$this->sabreConfig->soap_ipcc.'</m:CPAId>
			<m:ConversationId>convId</m:ConversationId>
			<m:Service m:type="OTA">'.$action.'</m:Service>
			<m:Action>'.$action.'</m:Action>
			<m:MessageData>
				<m:MessageId>'.session()->get('session_info')['message_id'].'</m:MessageId>
				<m:Timestamp>2001-02-15T11:15:12Z</m:Timestamp>
				<m:TimeToLive>2001-02-15T11:15:12Z</m:TimeToLive>
			</m:MessageData>
			<m:DuplicateElimination/>
			<m:Description>Bargain Finder Max Service</m:Description>
		</m:MessageHeader>
		<wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">'.session()->get('session_info')['session_token'].'</wsse:BinarySecurityToken>
		</wsse:Security>';
    }

    public function airportCode($string){
        return substr($string, -3,3);
    }

    public function originDestination($param){
        $departure_airport = $this->airportCode($param->departure_airport);
        $arrival_airport = $this->airportCode($param->arrival_airport);
        $departure_date = date('Y-m-d',strtotime($param->departure_date));
        if(isset($param->return_date) AND !empty($param->return_date)){
            $return_date = date('Y-m-d',strtotime($param->return_date));
            return '<OriginDestinationInformation RPH="1">
        <DepartureDateTime>'.$departure_date.'T11:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$departure_airport.'" />
        <DestinationLocation LocationCode="'.$arrival_airport.'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>
    <OriginDestinationInformation RPH="2">
        <DepartureDateTime>'.$return_date.'T11:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$arrival_airport.'" />
        <DestinationLocation LocationCode="'.$departure_airport.'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>';
        }
        else{
            return '<OriginDestinationInformation RPH="1">
        <DepartureDateTime>'.$departure_date.'T11:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$departure_airport.'" />
        <DestinationLocation LocationCode="'.$arrival_airport.'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>
    ';
        }

    }

    public function travelerInfoSummary($param){
        $passenger = '';
        if($param->adult_passengers > 0){
           $passenger = $passenger.'<PassengerTypeQuantity Code="ADT" Quantity="'.$param->adult_passengers.'" />';
        }
        if($param->child_passengers > 0){
            $passenger = $passenger.'<PassengerTypeQuantity Code="CHD" Quantity="'.$param->child_passengers.'" />';

        }
        if($param->infant_passengers > 0){
            $passenger = $passenger.'<PassengerTypeQuantity Code="INF" Quantity="'.$param->infant_passengers.'" />';

        }
        $seat_requested = $param->adult_passengers + $param->child_passengers;
        return '<TravelerInfoSummary>
        <SeatsRequested>'.$seat_requested.'</SeatsRequested>
        <AirTravelerAvail>
               '.$passenger.'
        </AirTravelerAvail>
    </TravelerInfoSummary>';
    }

    public function BargainMaxFinderXml($param){
        return '<OTA_AirLowFareSearchRQ xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Target="Production" Version="3.3.0" ResponseType="OTA" ResponseVersion="3.3.0">
    <POS>
        <Source PseudoCityCode="'.$this->sabreConfig->soap_ipcc.'">
        <RequestorID ID="1" Type="1">
            <CompanyName Code="TN" />
        </RequestorID>
        </Source>
    </POS>
   '.$this->originDestination($param).'
    <TravelPreferences ValidInterlineTicket="true">
        <CabinPref PreferLevel="Preferred" Cabin="'.$param->cabin_type.'" />
        <TPA_Extensions>
            <TripType Value="Return" />
            <LongConnectTime Min="780" Max="1200" Enable="true" />
            <ExcludeCallDirectCarriers Enabled="true" />
        </TPA_Extensions>
    </TravelPreferences>
    '.$this->travelerInfoSummary($param).'
    <TPA_Extensions>
        <IntelliSellTransaction>
            <RequestType Name="50ITINS" />
        </IntelliSellTransaction>
    </TPA_Extensions>
</OTA_AirLowFareSearchRQ>';
    }

}