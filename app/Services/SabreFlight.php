<?php

namespace App\Services;

use App\Airline;
use App\Airport;
use App\IataCity;
use App\AdminMarkup;
use App\Markdown;
use App\Vat;
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

    public function callsHeader($action,$session_info){
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
				<m:MessageId>'.$session_info['message_id'].'</m:MessageId>
				<m:Timestamp>2001-02-15T11:15:12Z</m:Timestamp>
				<m:TimeToLive>2001-02-15T11:15:12Z</m:TimeToLive>
			</m:MessageData>
			<m:DuplicateElimination/>
			<m:Description>'.$action.'</m:Description>
		</m:MessageHeader>
		<wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<wsse:BinarySecurityToken valueType="String" EncodingType="wsse:Base64Binary">'.$session_info['token'].'</wsse:BinarySecurityToken>
		</wsse:Security>';
    }

    public function airportCode($string){
        if(strlen($string) == 3){
            return $string;
        }
        return substr($string, 0,3);
    }

    public function originDestination($param){
        $departure_airport = $this->airportCode($param->departure_airport);
        $arrival_airport = $this->airportCode($param->arrival_airport);
        $departure_date = date('Y-m-d',strtotime($param->departure_date));
        if(isset($param->return_date) AND !empty($param->return_date)){
            $return_date = date('Y-m-d',strtotime($param->return_date));
            return '<OriginDestinationInformation RPH="1">
        <DepartureDateTime>'.$departure_date.'T00:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$departure_airport.'" />
        <DestinationLocation LocationCode="'.$arrival_airport.'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>
    <OriginDestinationInformation RPH="2">
        <DepartureDateTime>'.$return_date.'T00:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$arrival_airport.'" />
        <DestinationLocation LocationCode="'.$departure_airport.'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>';
        }
        else{
            return '<OriginDestinationInformation RPH="1">
        <DepartureDateTime>'.$departure_date.'T00:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$departure_airport.'" />
        <DestinationLocation LocationCode="'.$arrival_airport.'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>
    ';
        }

    }

    public function MultiCityOriginDestination($params){
        $returnValue = '';
        foreach($params as $i => $param){
            $originDestination = '<OriginDestinationInformation RPH="'. ($i+1) .'">
        <DepartureDateTime>'.date('Y-m-d',strtotime($param['departure_date'])).'T00:00:00</DepartureDateTime>
        <OriginLocation LocationCode="'.$this->airportCode($param['departure_airport']).'" />
        <DestinationLocation LocationCode="'.$this->airportCode($param['arrival_airport']).'" />
        <TPA_Extensions>
            <SegmentType Code="O" />
        </TPA_Extensions>
    </OriginDestinationInformation>';
            $returnValue = $returnValue.$originDestination;
        }

        return  $returnValue;
    }

    public function travelerInfoSummary($param){
        $passenger = '';
        if($param->adult_passengers > 0){
           $passenger = $passenger.'<PassengerTypeQuantity Code="ADT" Quantity="'.$param->adult_passengers.'" />';
        }
        if($param->child_passengers > 0){
            $passenger = $passenger.'<PassengerTypeQuantity Code="CNN" Quantity="'.$param->child_passengers.'" />';

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
            <RequestType Name="100ITINS" />
        </IntelliSellTransaction>
    </TPA_Extensions>
</OTA_AirLowFareSearchRQ>';
    }

    public function MultiCityBargainMaxFinderXml($param){
        $otherParam = $param['searchParameters'][0];
        $otherParamObject = (object) $otherParam;
        $originDestination = $param['searchParameters'][1];

        return '<OTA_AirLowFareSearchRQ xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Target="Production" Version="3.3.0" ResponseType="OTA" ResponseVersion="3.3.0">
    <POS>
        <Source PseudoCityCode="'.$this->sabreConfig->soap_ipcc.'">
        <RequestorID ID="1" Type="1">
            <CompanyName Code="TN" />
        </RequestorID>
        </Source>
    </POS>
   '.$this->MultiCityOriginDestination($originDestination).'
    <TravelPreferences ValidInterlineTicket="true">
        <CabinPref PreferLevel="Preferred" Cabin="'.$otherParam['cabin_type'].'" />
        <TPA_Extensions>
            <LongConnectTime Min="780" Max="1200" Enable="true" />
            <ExcludeCallDirectCarriers Enabled="true" />
        </TPA_Extensions>
    </TravelPreferences>
    '.$this->travelerInfoSummary($otherParamObject).'
    <TPA_Extensions>
        <IntelliSellTransaction>
            <RequestType Name="100ITINS" />
        </IntelliSellTransaction>
    </TPA_Extensions>
</OTA_AirLowFareSearchRQ>';

    }

    public function flightSearchValidator($responseArray){
        if(!empty($responseArray)){
//            return $responseArray;
            if(isset($responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['Errors']['Error'])){
                return 4;
            }
            elseif(isset($responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['Success'])){
                return 1;
            }
            else{
                return 3;
            }
        }else{
            return 0;
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
                        $segment = $originDest['FlightSegment'];
                        if(isset($segment[0])){
                            $segmentArray = [];
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
                $adminUserMarkupObject = AdminMarkup::getAdminUserMarkup();
                $adminUserMarkupDefault = $this->sabreConfig->priceTypeCalculator($adminUserMarkupObject->flight_markup_type,$adminUserMarkupObject->flight_markup_value,$itineraryPrice);
                $vatObject = Vat::getVat();
                $vat = $this->sabreConfig->priceTypeCalculator($vatObject->flight_vat_type,$vatObject->flight_vat_value,$itineraryPrice);
                $markdownObject = Markdown::getAirlineMarkdown($airline);
                if($markdownObject == 0){
                    $airlineMarkdown = 0;
                    $adminUserMarkup = $this->sabreConfig->priceTypeCalculator($adminUserMarkupObject->flight_markup_type,$adminUserMarkupObject->flight_markup_value,$itineraryPrice);
                }else{
                    $airlineMarkdown = $this->sabreConfig->priceTypeCalculator($markdownObject->type,$markdownObject->value,$itineraryPrice);
                    $adminUserMarkup = 0;
                }
                $adminToUserSumTotal = $adminUserMarkup + $airlineMarkdown + $vat + $itineraryPrice;
                $itineraryPrimaryInfo = [
                    "totalPrice" => $itineraryPrice,
                    "itineraryPricingSource" =>  $itineraryPricingSource,
                    "itineraryPricingSubSource" => $itineraryPricingSubSource,
                    "airline" => $airline,
                    "stops" => $stops,
                    "adminToUserMarkup" => $adminUserMarkupDefault,
                    "airlineMarkdown" => $airlineMarkdown,
                    "vat" => $vat,
                    "adminToUserSumTotal" => $adminToUserSumTotal
                ];

                array_push($itineraryInfoArray,$itineraryPrimaryInfo);
                array_push($itineraryInfoArray,$originDestinationArray);
                array_push($itineraryInfoArray,$this->fareBrakeDown($itinerary));
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

    public function EnhancedAirBookRQXML($Itinerary,$param){
        $passenger = '';
        if($param['adult_passengers'] > 0){
            $passenger = $passenger.'<PassengerType Code="ADT" Quantity="'.$param['adult_passengers'].'" />';
        }
        if($param['child_passengers'] > 0){
            $passenger = $passenger.'<PassengerType Code="CNN" Quantity="'.$param['child_passengers'].'" />';

        }
        if($param['infant_passengers'] > 0){
            $passenger = $passenger.'<PassengerType Code="INF" Quantity="'.$param['infant_passengers'].'" />';

        }
        $number_of_passengers = $param['adult_passengers'] + $param['child_passengers'];
         $originDestinationInformation = '';
        $openingTag = '<OriginDestinationInformation>';
        $closingTag = '</OriginDestinationInformation>';
        foreach($Itinerary[1] as $i => $itinerary_info){
                $segments = '';
                foreach($itinerary_info as $j => $segment){
                  $segment_info = '<FlightSegment ArrivalDateTime="'.$segment['arrivalDateTime'].'" DepartureDateTime="'.$segment['departureDateTime'].'" FlightNumber="'.$segment['flightNumber'].'" NumberInParty="'.$number_of_passengers.'" ResBookDesigCode="'.$segment['resBookDesigCode'].'" InstantPurchase="true" Status="NN">
						<DestinationLocation LocationCode="'.$segment['arrivalAirport'].'"/>
						<Equipment AirEquipType="'.$segment['equipment'].'"/>
						<MarketingAirline Code="'.$segment['marketingAirline'].'" FlightNumber="'.$segment['flightNumber'].'"/>
						<OriginLocation LocationCode="'.$segment['departureAirport'].'"/>
					      </FlightSegment>';
                  $segments = $segments.$segment_info;
                }

            $originDestinationInformation = $originDestinationInformation.$segments;
        }
        $originDestinationInformation = $openingTag.$originDestinationInformation.$closingTag;
//dd($originDestinationInformation);
        $returnXml = '
      <EnhancedAirBookRQ version="3.8.0" xmlns="http://services.sabre.com/sp/eab/v3_8" HaltOnError="true">
			<OTA_AirBookRQ >
			<HaltOnStatus Code="UC"/>
            <HaltOnStatus Code="LL"/>
            <HaltOnStatus Code="UL"/>
            <HaltOnStatus Code="UN"/>
            <HaltOnStatus Code="NO"/>
            <HaltOnStatus Code="HL"/>
			'.$originDestinationInformation.'
			</OTA_AirBookRQ>
			<OTA_AirPriceRQ >
				<PriceRequestInformation Retain="true">
					<OptionalQualifiers>
						<PricingQualifiers>
							'.$passenger.'
						</PricingQualifiers>
					</OptionalQualifiers>
				</PriceRequestInformation>
			</OTA_AirPriceRQ>
			 <PostProcessing IgnoreAfter="false">
               <RedisplayReservation/>
               </PostProcessing>
               <PreProcessing IgnoreBefore="false">
             </PreProcessing>
		</EnhancedAirBookRQ>';

//        dd($returnXml);

        return $returnXml;



    }

    public function PassengerDetailsPassenger($param){
        $adults = session()->get('flightSearchParam')['adult_passengers'];
        $children = session()->get('flightSearchParam')['child_passengers'];
        $infants = session()->get('flightSearchParam')['infant_passengers'];
           $passengerDetails = '';
           $priceQuoteInfo = '';
           $specialRequests ='';
           $y = 0;
           $infants_num = 2;
        if($adults > 0){
            for($i = 0; $i < $adults; $i++){
                $given_name = $param->adult_given_name[$i];
                    $surname = $param->adult_surname[$i];
                    $dob = $param->adult_date_of_birth[$i];
                    $sex = $param->adult_sex[$i];
             $personDetails = '<PersonName Infant="false" NameNumber="'.($y + 1).'.1" PassengerType="ADT">
                <GivenName>'.$given_name.'</GivenName>
                <Surname>'.$surname.'</Surname>
            </PersonName>';

             $specialRequest = '<SecureFlight SegmentNumber="A" >
                <PersonName DateOfBirth="'.date('Y-m-d',strtotime($dob)).'" Gender="'.$sex.'" NameNumber="'.($y + 1).'.1" >
                    <GivenName>'.$given_name.'</GivenName>
                    <Surname>'.$surname.'</Surname>
                </PersonName>
            </SecureFlight>';

             $passengerDetails = $passengerDetails.$personDetails;
             $specialRequests = $specialRequests.$specialRequest;
             $priceQuoteInfo = $priceQuoteInfo.'<Link NameNumber="'.($y + 1).'.1" Record="1"/>';
             $y = $y+1;
            }
        }
        if($children > 0){
            for($i = 0; $i < $children; $i++){
                $given_name = $param->child_given_name[$i];
                $surname = $param->child_surname[$i];
                $dob = $param->child_date_of_birth[$i];
                $sex = $param->child_sex[$i];
                $personDetails = '<PersonName Infant="false" NameNumber="'.($y + 1).'.1" PassengerType="CNN">
                <GivenName>'.$given_name.'</GivenName>
                <Surname>'.$surname.'</Surname>
            </PersonName>';
                $specialRequest = '<SecureFlight SegmentNumber="A" >
                <PersonName DateOfBirth="'.date('Y-m-d',strtotime($dob)).'" Gender="'.$sex.'" NameNumber="'.($y + 1).'.1" >
                    <GivenName>'.$given_name.'</GivenName>
                    <Surname>'.$surname.'</Surname>
                </PersonName>
            </SecureFlight>';
                $passengerDetails = $passengerDetails.$personDetails;
                $specialRequests = $specialRequests.$specialRequest;
                $priceQuoteInfo = $priceQuoteInfo.'<Link NameNumber="'.($y + 1).'.1" Record="2"/>';
                $y = $y+1;
            }
            $infants_num = $infants_num + 1;
        }
        if($infants > 0){
            if($children > 0){$nameNumber = 3;}else{$nameNumber = 2;}
            for($i = 0; $i < $infants; $i++){
                $given_name = $param->infant_given_name[$i];
                $surname = $param->infant_surname[$i];
                $dob = $param->infant_date_of_birth[$i];
                $sex = $param->infant_sex[$i];
                $personDetails = '<PersonName Infant="true" NameNumber="'.($y + 1).'.1" PassengerType="INF">
                <GivenName>'.$given_name.'</GivenName>
                <Surname>'.$surname.'</Surname>
            </PersonName>';
                $specialRequest = '<SecureFlight SegmentNumber="A" >
                <PersonName DateOfBirth="'.date('Y-m-d',strtotime($dob)).'" Gender="'.$sex.'" NameNumber="'.($y + 1).'.1" >
                    <GivenName>'.$given_name.'</GivenName>
                    <Surname>'.$surname.'</Surname>
                </PersonName>
            </SecureFlight>';
                $passengerDetails = $passengerDetails.$personDetails;
                $specialRequests = $specialRequests.$specialRequest;
                $priceQuoteInfo = $priceQuoteInfo.'<Link NameNumber="'. ($y + 1) .'.1" Record="'.$infants_num.'"/>';
                $y = $y+1;
            }
        }
        return ['passengers' => $passengerDetails, 'priceQuoteInfo' => $priceQuoteInfo, 'specialRequests' => $specialRequests];
    }

    public function PassengerDetailsRQXML($param){
        $phone_number = auth()->user()->phone_number;  $email = auth()->user()->email;

 return '<PassengerDetailsRQ version="3.3.0" xmlns="http://services.sabre.com/sp/pd/v3_3" IgnoreOnError="false" HaltOnError="true">
    <PostProcessing RedisplayReservation="true">
		<EndTransactionRQ>
			<EndTransaction Ind="true">
			</EndTransaction>
			<Source ReceivedFrom="SWS TESTING"/>
		</EndTransactionRQ>
	</PostProcessing>
	<PriceQuoteInfo>
		'.$this->PassengerDetailsPassenger($param)['priceQuoteInfo'].'
	</PriceQuoteInfo>
	<SpecialReqDetails>
    <SpecialServiceRQ>
        <SpecialServiceInfo>
            '.$this->PassengerDetailsPassenger($param)['specialRequests'].'
        </SpecialServiceInfo>
    </SpecialServiceRQ>
</SpecialReqDetails>
    <TravelItineraryAddInfoRQ>
        <AgencyInfo>
			<Ticketing TicketType="7T-"/>
		</AgencyInfo>
        <CustomerInfo>
            <ContactNumbers>
                <ContactNumber LocationCode="LOS" NameNumber="1.1" Phone="'.$phone_number.'" PhoneUseType="H"/>
            </ContactNumbers>
            <Email Address="'.$email.'" NameNumber="1.1" Type="CC"/>
            '.$this->PassengerDetailsPassenger($param)['passengers'].'
        </CustomerInfo>
	</TravelItineraryAddInfoRQ>
</PassengerDetailsRQ>';
    }

    public function sortEnhancedAirBookRS($responseArray){

    }

    public function enhancedAirBookValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }
        else{
            if(isset($responseArray['soap-env_Body']['EnhancedAirBookRS']['ApplicationResults']['Success'])){
                  return 1;
            }elseif(!(isset($responseArray['soap-env_Body']['EnhancedAirBookRS']['ApplicationResults']['Success']))){
//                return $responseArray;
                return 2;
            }else{
                return 3;
            }
        }
    }

    public function fareBrakeDown($itinerary){
        $fareBrakeDowns = $itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
        if(array_has($fareBrakeDowns,0)){
            $fareBrakeDownsArray = [];
            foreach($fareBrakeDowns as $i => $fareBrakeDown){
                $passengerType = $fareBrakeDown['PassengerTypeQuantity']['@attributes']['Code'];
                $quantity = $fareBrakeDown['PassengerTypeQuantity']['@attributes']['Quantity'];
                $totalFarePrice = $fareBrakeDown['PassengerFare']['TotalFare']['@attributes']['Amount'];
                $arrayFareBrakeDownPrimaryData = [
                    'passengerType' => $passengerType,
                    'quantity' => $quantity,
                    'totalPrice' => $totalFarePrice
                ];
                array_push($fareBrakeDownsArray,$arrayFareBrakeDownPrimaryData);
            }
            array_values($fareBrakeDownsArray);
        }else{
            $fareBrakeDownsArray = [];
            $passengerType = $fareBrakeDowns['PassengerTypeQuantity']['@attributes']['Code'];
            $quantity = $fareBrakeDowns['PassengerTypeQuantity']['@attributes']['Quantity'];
            $totalFarePrice = $fareBrakeDowns['PassengerFare']['TotalFare']['@attributes']['Amount'];
            $arrayFareBrakeDownPrimaryData = [
                'passengerType' => $passengerType,
                'quantity' => $quantity,
                'totalPrice' => $totalFarePrice
            ];
            array_push($fareBrakeDownsArray,$arrayFareBrakeDownPrimaryData);
            array_values($fareBrakeDownsArray);
        }
        return $fareBrakeDownsArray;
    }

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

    public function availableAirline($responseArray){
        $airlineArray = [];
        if(isset($responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['TPA_Extensions']['AirlineOrderList']['AirlineOrder'])){
            $flightResponse = $responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['TPA_Extensions']['AirlineOrderList']['AirlineOrder'];
            if(array_has($flightResponse,0)){
                foreach($flightResponse as $i => $airlinedata){
                    array_push($airlineArray,$airlinedata['@attributes']['Code']);
                }
            }else{
                array_push($airlineArray,$flightResponse['@attributes']['Code']);
            }
        }else{
            $flights = $responseArray['SOAP-ENV_Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'];
            if(isset($flights[0])){
                foreach($flights as $i => $flight){
                    array_push($airlineArray,$flight['TPA_Extensions']['ValidatingCarrier']['@attributes']['Code']);
                }
            }
        }
        return array_values(array_unique($airlineArray));
    }

    public function passengerDetailsValidator($responseArray){
        $responseObject = json_encode($responseArray,true);
        if(empty($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap-env_Body']['PassengerDetailsRS']['ItineraryRef']['@attributes']['ID'])){
                $pnr = $responseArray['soap-env_Body']['PassengerDetailsRS']['ItineraryRef']['@attributes']['ID'];
                $ticket_time_limit = $responseArray['soap-env_Body']['PassengerDetailsRS']['TravelItineraryReadRS']['TravelItinerary']['ItineraryInfo']['Ticketing']['@attributes']['TicketTimeLimit'];
                return ['responseObject' => $responseObject, 'pnr' => $pnr, 'ticketTimeLimit' => $ticket_time_limit, 'pnrStatus' => 1];
            }else{
                return ['responseObject' => $responseObject, 'pnr' => null, 'ticketTimeLimit' => null, 'pnrStatus' => 0];
            }
        }
    }

}