<?php

namespace App\Services;

use App\Airline;
use App\Airport;
use App\IataCity;
use Faker\Provider\DateTime;
use Illuminate\Support\Carbon;


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

    public function flightSearchValidator($responseArray){
        if(isset($responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['Errors']['Error'])){
            return 4;
        }
        elseif(isset($responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['Success'])){
            return 1;
        }
        else{
            return 3;
        }
    }

    public function sortFlightArray($responseArray){
        $itineraries = $responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'];
        $returnArray = [];
        if(isset($itineraries[0])){
            foreach($itineraries as $i => $itinerary){

                $itineraryInfoArray = [];

                $originDestination = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'];
                if(isset($originDestination[0])){
                    $originDestinationArray = [];
                    foreach($originDestination as $j => $originDest){
//                     $originDestination = array_get($originDestination, 'OriginDestinationOption.'.$j);
                     $segment = $originDest['FlightSegment'];
                     if(isset($segment[0])){
                         $segmentArray = [];
//                         $airline = $originDestination[0]['FlightSegment'][0]['OperatingAirline']['@attributes']['Code'];
                         if(isset($originDestination[0]['FlightSegment']['OperatingAirline']['@attributes']['Code'])){
                             $airline = $originDestination[0]['FlightSegment']['OperatingAirline']['@attributes']['Code'];
                         }else{
                             $airline = $originDestination[0]['FlightSegment'][0]['OperatingAirline']['@attributes']['Code'];
                         }
                         $stops = count($segment) - 1;
                         foreach($segment as $k => $seg){
                            $segment = array_get($segment, "FlightSegment.".$k);
                            $departureAirport = $seg['DepartureAirport']['@attributes']['LocationCode'];
                            $departureAirportName = Airport::getCity($departureAirport);
                            $arrivalAirport = $seg['ArrivalAirport']['@attributes']['LocationCode'];
                            $arrivalAirportName = Airport::getCity($arrivalAirport);
                            $flightNumber = $seg['@attributes']['FlightNumber'];
                            $departureDateTime = $seg['@attributes']['DepartureDateTime'];
                            $arrivalDateTime = $seg['@attributes']['ArrivalDateTime'];
                            $operatingAirline = $seg['OperatingAirline']['@attributes']['Code'];
                            $operatingAirlineName = Airline::getAirline($operatingAirline);
                            $equipment = $seg['Equipment']['@attributes']['AirEquipType'];
                            $marketingAirline = $seg['MarketingAirline']['@attributes']['Code'];
                            $marketingAirlineName = Airline::getAirline($marketingAirline);
                            $departureTimeZone = $seg['DepartureTimeZone']['@attributes']['GMTOffset'];
                            $arrivalTimeZone = $seg['ArrivalTimeZone']['@attributes']['GMTOffset'];
                            $resBookDesigCode = $seg['@attributes']['ResBookDesigCode'];
                             $t1 = Carbon::parse($departureDateTime);
                             $t2 = Carbon::parse($arrivalDateTime);
                             $diff = $t1->diff($t2);
                             $timeDuration = $diff->format('%h')."h ".$diff->format('%i')."m";
                            $segmentPrimaryDataArray = [
                               "departureAirport" => $departureAirport,
                               "arrivalAirport" => $arrivalAirport,
                               "flightNumber" => $flightNumber,
                               "departureDateTime" => $departureDateTime,
                               "arrivalDateTime" => $arrivalDateTime,
                               "operatingAirline" => $operatingAirline,
                               "equipment" => $equipment,
                               "marketingAirline" => $marketingAirline,
                               "departureTimeZone" => $departureTimeZone,
                               "arrivalTimeZone" => $arrivalTimeZone,
                               "resBookDesigCode" => $resBookDesigCode,
                                "departureAirportName" => $departureAirportName,
                                "arrivalAirportName" => $arrivalAirportName,
                                "operatingAirlineName" => $operatingAirlineName,
                                "marketingAirlineName" => $marketingAirlineName,
                                "timeDuration" => $timeDuration
                            ];
                            array_push($segmentArray,$segmentPrimaryDataArray);
                         }
                         array_values($segmentArray);
                     }
                     else{
                         $segmentArray = [];
                         if(isset($originDestination[0]['FlightSegment']['OperatingAirline']['@attributes']['Code'])){
                             $airline = $originDestination[0]['FlightSegment']['OperatingAirline']['@attributes']['Code'];
                         }else{
                             $airline = $originDestination[0]['FlightSegment'][0]['OperatingAirline']['@attributes']['Code'];
                         }
                         $stops = 0;
                         $departureAirport = $segment['DepartureAirport']['@attributes']['LocationCode'];
                         $arrivalAirport = $segment['ArrivalAirport']['@attributes']['LocationCode'];
                         $flightNumber = $segment['@attributes']['FlightNumber'];
                         $departureDateTime = $segment['@attributes']['DepartureDateTime'];
                         $arrivalDateTime = $segment['@attributes']['ArrivalDateTime'];
                         $operatingAirline = $segment['OperatingAirline']['@attributes']['Code'];
                         $equipment = $segment['Equipment']['@attributes']['AirEquipType'];
                         $marketingAirline = $segment['MarketingAirline']['@attributes']['Code'];
                         $departureTimeZone = $segment['DepartureTimeZone']['@attributes']['GMTOffset'];
                         $arrivalTimeZone = $segment['ArrivalTimeZone']['@attributes']['GMTOffset'];
                         $resBookDesigCode = $segment['@attributes']['ResBookDesigCode'];
                         $arrivalAirportName = Airport::getCity($arrivalAirport);
                         $operatingAirlineName = Airline::getAirline($operatingAirline);
                         $departureAirportName = Airport::getCity($departureAirport);
                         $marketingAirlineName = Airline::getAirline($marketingAirline);
                         $t1 = Carbon::parse($departureDateTime);
                         $t2 = Carbon::parse($arrivalDateTime);
                         $diff = $t1->diff($t2);
                         $timeDuration = $diff->format('%h')."h ".$diff->format('%i')."m";
                         $segmentPrimaryDataArray = [
                             "departureAirport" => $departureAirport,
                             "arrivalAirport" => $arrivalAirport,
                             "flightNumber" => $flightNumber,
                             "departureDateTime" => $departureDateTime,
                             "arrivalDateTime" => $arrivalDateTime,
                             "operatingAirline" => $operatingAirline,
                             "equipment" => $equipment,
                             "marketingAirline" => $marketingAirline,
                             "departureTimeZone" => $departureTimeZone,
                             "arrivalTimeZone" => $arrivalTimeZone,
                             "resBookDesigCode" => $resBookDesigCode,
                             "departureAirportName" => $departureAirportName,
                             "arrivalAirportName" => $arrivalAirportName,
                             "operatingAirlineName" => $operatingAirlineName,
                             "marketingAirlineName" => $marketingAirlineName,
                             "timeDuration" => $timeDuration
                         ];
                         array_push($segmentArray,$segmentPrimaryDataArray);
                         array_values($segmentArray);
                     }
                     array_push($originDestinationArray,$segmentArray);
                  }
                  array_values($originDestinationArray);
                }




                else{
                    $originDestinationArray = [];
                    $segment = $originDestination['FlightSegment'];
                    if(isset($segment[0])){
                        $segmentArray = [];
                        $airline = $originDestination['FlightSegment'][0]['OperatingAirline']['@attributes']['Code'];
                        $stops = count($segment) - 1;
                        foreach($segment as $k => $seg){
                            $segment = array_get($segment, "FlightSegment.".$k);
                            $departureAirport = $seg['DepartureAirport']['@attributes']['LocationCode'];
                            $arrivalAirport = $seg['ArrivalAirport']['@attributes']['LocationCode'];
                            $flightNumber = $seg['@attributes']['FlightNumber'];
                            $departureDateTime = $seg['@attributes']['DepartureDateTime'];
                            $arrivalDateTime = $seg['@attributes']['ArrivalDateTime'];
                            $operatingAirline = $seg['OperatingAirline']['@attributes']['Code'];
                            $equipment = $seg['Equipment']['@attributes']['AirEquipType'];
                            $marketingAirline = $seg['MarketingAirline']['@attributes']['Code'];
                            $departureTimeZone = $seg['DepartureTimeZone']['@attributes']['GMTOffset'];
                            $arrivalTimeZone = $seg['ArrivalTimeZone']['@attributes']['GMTOffset'];
                            $resBookDesigCode = $seg['@attributes']['ResBookDesigCode'];
                            $arrivalAirportName = Airport::getCity($arrivalAirport);
                            $operatingAirlineName = Airline::getAirline($operatingAirline);
                            $departureAirportName = Airport::getCity($departureAirport);
                            $marketingAirlineName = Airline::getAirline($marketingAirline);
                            $t1 = Carbon::parse($departureDateTime);
                            $t2 = Carbon::parse($arrivalDateTime);
                            $diff = $t1->diff($t2);
                            $timeDuration = $diff->format('%h')."h ".$diff->format('%i')."m";
                            $segmentPrimaryDataArray = [
                                "departureAirport" => $departureAirport,
                                "arrivalAirport" => $arrivalAirport,
                                "flightNumber" => $flightNumber,
                                "departureDateTime" => $departureDateTime,
                                "arrivalDateTime" => $arrivalDateTime,
                                "operatingAirline" => $operatingAirline,
                                "equipment" => $equipment,
                                "marketingAirline" => $marketingAirline,
                                "departureTimeZone" => $departureTimeZone,
                                "arrivalTimeZone" => $arrivalTimeZone,
                                "resBookDesigCode" => $resBookDesigCode,
                                "departureAirportName" => $departureAirportName,
                                "arrivalAirportName" => $arrivalAirportName,
                                "operatingAirlineName" => $operatingAirlineName,
                                "marketingAirlineName" => $marketingAirlineName,
                                "timeDuration" => $timeDuration
                            ];
                            array_push($segmentArray,$segmentPrimaryDataArray);
                        }
                        array_values($segmentArray);
                    }
                    else{
                        $segmentArray = [];
                        $airline = $originDestination['FlightSegment']['OperatingAirline']['@attributes']['Code'];
                        $stops = 0;
                        $departureAirport = $segment['DepartureAirport']['@attributes']['LocationCode'];
                        $arrivalAirport = $segment['ArrivalAirport']['@attributes']['LocationCode'];
                        $flightNumber = $segment['@attributes']['FlightNumber'];
                        $departureDateTime = $segment['@attributes']['DepartureDateTime'];
                        $arrivalDateTime = $segment['@attributes']['ArrivalDateTime'];
                        $operatingAirline = $segment['OperatingAirline']['@attributes']['Code'];
                        $equipment = $segment['Equipment']['@attributes']['AirEquipType'];
                        $marketingAirline = $segment['MarketingAirline']['@attributes']['Code'];
                        $departureTimeZone = $segment['DepartureTimeZone']['@attributes']['GMTOffset'];
                        $arrivalTimeZone = $segment['ArrivalTimeZone']['@attributes']['GMTOffset'];
                        $resBookDesigCode = $segment['@attributes']['ResBookDesigCode'];
                        $arrivalAirportName = Airport::getCity($arrivalAirport);
                        $operatingAirlineName = Airline::getAirline($operatingAirline);
                        $departureAirportName = Airport::getCity($departureAirport);
                        $marketingAirlineName = Airline::getAirline($marketingAirline);
                        $t1 = Carbon::parse($departureDateTime);
                        $t2 = Carbon::parse($arrivalDateTime);
                        $diff = $t1->diff($t2);
                        $timeDuration = $diff->format('%h')."h ".$diff->format('%i')."m";
                        $segmentPrimaryDataArray = [
                            "departureAirport" => $departureAirport,
                            "arrivalAirport" => $arrivalAirport,
                            "flightNumber" => $flightNumber,
                            "departureDateTime" => $departureDateTime,
                            "arrivalDateTime" => $arrivalDateTime,
                            "operatingAirline" => $operatingAirline,
                            "equipment" => $equipment,
                            "marketingAirline" => $marketingAirline,
                            "departureTimeZone" => $departureTimeZone,
                            "arrivalTimeZone" => $arrivalTimeZone,
                            "resBookDesigCode" => $resBookDesigCode,
                            "departureAirportName" => $departureAirportName,
                            "arrivalAirportName" => $arrivalAirportName,
                            "operatingAirlineName" => $operatingAirlineName,
                            "marketingAirlineName" => $marketingAirlineName,
                            "timeDuration" => $timeDuration
                        ];
                        array_push($segmentArray,$segmentPrimaryDataArray);
                        array_values($segmentArray);
                    }
                    array_push($originDestinationArray,$segmentArray);
                    array_values($originDestinationArray);
                }
                $itineraryPrice = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount'];
                $itineraryPricingSource = $itinerary['AirItineraryPricingInfo']['@attributes']['PricingSource'];
                $itineraryPricingSubSource = $itinerary['AirItineraryPricingInfo']['@attributes']['PricingSubSource'];
                $itineraryPrimaryInfo = [
                    "totalPrice" => $itineraryPrice,
                    "itineraryPricingSource" =>  $itineraryPricingSource,
                    "itineraryPricingSubSource" => $itineraryPricingSubSource,
                    "airline" => $airline,
                    "stops" => $stops,
                ];
                array_push($itineraryInfoArray,$itineraryPrimaryInfo);
                array_push($itineraryInfoArray,$originDestinationArray);
                array_push($returnArray,$itineraryInfoArray);
            }
            array_values($returnArray);
        }
        else{
            /**
            if just one flight is returned
             * Need to update this soon
             */
        }
        array_values($returnArray);
        return $returnArray;
    }

     //    public function sortFlightResult($responseArray){
//        $itineraries = $responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'];
//        $returnArray = [];
//
//        foreach($itineraries as $i => $itinerary){
//            $itineraryArray = [];
//            $itineraryPrice = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount'];
//            $itineraryPricingSource = $itinerary['AirItineraryPricingInfo']['@attributes']['PricingSource'];
//            $itineraryPricingSubSource = $itinerary['AirItineraryPricingInfo']['@attributes']['PricingSubSource'];
//            $itineraryPrimaryData = [
//                'itineraryPrice' => $itineraryPrice,
//                'itineraryPricingSource' => $itineraryPricingSource,
//                'itineraryPricingSubSource' => $itineraryPricingSubSource,
//                'stops' => '',
//                'airline' => ''
//            ];
//            array_push($itineraryArray,$itineraryPrimaryData);
//            $originDestinations = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'];
//            foreach($originDestinations as $j => $originDestination){
//                $originDestinationsArray = [];
//                $segments = $originDestination['FlightSegment'];
//                foreach($segments as $k => $segment){
////                    dd($segment['@attributes']['FlightNumber']);
//                    $flightNumber = $segment['@attributes']['FlightNumber'];
//                    $departureDateTime = $segment['@attributes']['DepartureDateTime'];
//                    $arrivalDateTime = $segment['@attributes']['ArrivalDateTime'];
//                    $operatingAirline = $segment['OperatingAirline']['@attributes']['Code'];
//                    $departureAirport = $segment['DepartureAirport']['@attributes']['LocationCode'];
//                    $departureAirportName = Airport::getCity($departureAirport);
//                    $arrivalAirport = $segment['ArrivalAirport']['@attributes']['LocationCode'];
//                    $arrivalAirportName = Airport::getCity($arrivalAirport);
//                    $operatingAirlineName = Airline::getAirline($operatingAirline);
//                    $equipment = $segment['Equipment']['@attributes']['AirEquipType'];
//                    $marketingAirline = $segment['MarketingAirline']['@attributes']['Code'];
//                    $marketingAirlineName = Airline::getAirline($marketingAirline);
//                    $departureTimeZone = $segment['DepartureTimeZone']['@attributes']['GMTOffset'];
//                    $arrivalTimeZone = $segment['ArrivalTimeZone']['@attributes']['GMTOffset'];
//                    $resBookDesigCode = $segment['@attributes']['ResBookDesigCode'];
//                    $t1 = Carbon::parse($departureDateTime);
//                    $t2 = Carbon::parse($arrivalDateTime);
//                    $diff = $t1->diff($t2);
//                    $timeDuration = $diff->format('%h')."h ".$diff->format('%i')."m";
//                    $segmentData = [
//                        "departureAirport" => $departureAirport,
//                        "arrivalAirport" => $arrivalAirport,
//                        "flightNumber" => $flightNumber,
//                        "departureDateTime" => $departureDateTime,
//                        "arrivalDateTime" => $arrivalDateTime,
//                        "operatingAirline" => $operatingAirline,
//                        "equipment" => $equipment,
//                        "marketingAirline" => $marketingAirline,
//                        "departureTimeZone" => $departureTimeZone,
//                        "arrivalTimeZone" => $arrivalTimeZone,
//                        "resBookDesigCode" => $resBookDesigCode,
//                        "departureAirportName" => $departureAirportName,
//                        "arrivalAirportName" => $arrivalAirportName,
//                        "operatingAirlineName" => $operatingAirlineName,
//                        "marketingAirlineName" => $marketingAirlineName,
//                        "timeDuration" => $timeDuration
//                    ];
//                    array_push($originDestinationsArray, $segmentData);
//                }
//                array_values($originDestinationsArray);
//                array_push($itineraryArray,$originDestinationsArray);
//            }
//
//            array_values($itineraryArray);
//            array_push($returnArray,$itineraryArray);
//        }
//          array_values($returnArray);
//        return $returnArray;
//    }

    public function iataCodeDecodeType($type,$iataCode){
        if($type == 'Airline'){
            $returnXml = '<Airline Code="'.$iataCode.'"/>';
        }elseif($type == 'Equipment'){
            $returnXml = '<Equipment AirEquipType="'.$iataCode.'"/>';
        }elseif($type == 'CruiseLine'){
            $returnXml = '<CruiseLine Code="'.$iataCode.'"/>';
        }elseif($type == 'TravelAgency'){
            $returnXml = '<TravelAgency PseudoCityCode="'.$iataCode.'"/>';
        }elseif($type == 'UniversalAssociate'){
            $returnXml = '<UniversalAssociate Code="'.$iataCode.'"/>';
        }elseif($type == 'City'){
            $returnXml = '<Address>
      <CityName LocationCode="'.$iataCode.'"/>
    </Address>';
        }
        return $returnXml;
    }

    public function EncodeDecodeLLSRQXml($type,$iataCode){
        $returnXml = '<EncodeDecodeRQ Version="2.0.0">
      <Decode>
      '.$this->iataCodeDecodeType($type,$iataCode).'
      </Decode>
      </EncodeDecodeRQ>';
        return $returnXml;
    }

    public function decodeIata($type,$iataCode){
        $response = $this->doCall($this->callsHeader('EncodeDecodeLLSRQ'),$this->EncodeDecodeLLSRQXml($type,$iataCode),'EncodeDecodeLLSRQ');
        if($response){
            $response_array = $this->sabreConfig->mungXmlToObject($response);
            return $response_array;
        }else{
            return $iataCode;
        }

    }

    public static function airlineImage($airlineCode){
        return 'http://pics.avs.io/200/200/'.$airlineCode.'.png';
    }

    public static function cabinType($code){
        if($code == 'Y'){return "Economy";}
        elseif($code == 'S'){return "Premium Economy";}
        elseif($code == 'C'){return "Business";}
        elseif($code == 'J'){return "Premium Business";}
        elseif($code == 'F'){return "First";}
        elseif($code == 'P'){return "Premium First";}
    }

    public static function minimumPrice($key,$value,$sortedArray){
        $arrayData = [];
        foreach($sortedArray as $i => $data){
            $thisvalue = $data[0][$key];
            if($thisvalue == $value){
                array_push($arrayData,$data[0]['totalPrice']);
            }
        }
          array_values($arrayData);
        $num = count($arrayData);
        if($num == 0){
            $min = 0;
        }else{
            $min =  min($arrayData);
        }
        return [
            "number" => $num,
            "minimumPrice" => $min
        ];
    }


}