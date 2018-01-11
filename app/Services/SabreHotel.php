<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 12/18/2017
 * Time: 3:22 PM
 */

namespace App\Services;

use App\Vat;
use App\AdminMarkup;
use Faker\Provider\DateTime;
use Illuminate\Support\Carbon;


class SabreHotel
{

    public function __construct(){
        $this->SabreConfig = new SabreConfig();
        $this->SabreSession = new SabreSessionManager();
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
				<m:PartyId type="urn:x12.org:IO5:01">'.$this->SabreConfig->soapEnvironment.'</m:PartyId>
			</m:To>
			<m:CPAId>'.$this->SabreConfig->soap_ipcc.'</m:CPAId>
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

    public function cityCode($string){
        if(strlen($string) == 3){
            return $string;
        }
        return substr($string, 0,3);
    }

    public function HotelAvailRQXML($r){
        return '<OTA_HotelAvailRQ Version="2.3.0" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <AvailRequestSegment>
        <GuestCounts Count="'.$r->guests.'" />
        <HotelSearchCriteria>
            <Criterion>
                <HotelRef HotelCityCode="'.$this->cityCode($r->city).'" />
            </Criterion>
        </HotelSearchCriteria>
        <TimeSpan End="'.date('m-d',strtotime($r->checkout_date)).'" Start="'.date('m-d',strtotime($r->checkin_date)).'" />
    </AvailRequestSegment>
</OTA_HotelAvailRQ>';
    }

    public function HotelImageRQXML($r){
        return '<GetHotelImageRQ xmlns="http://services.sabre.com/hotel/image/v1" version="1.0.0">
    <HotelRefs>
        <HotelRef HotelCode="'.session()->get('hotels')[$r->id]['hotelCode'].'" CodeContext="Sabre" />
    </HotelRefs>
    <ImageRef Type="MEDIUM" CategoryCode="3" LanguageCode="EN" />

</GetHotelImageRQ>';
    }

    public function HotelMediaRQXML($r){
        return '<GetHotelMediaRQ version="1.0.0" xmlns="http://services.sabre.com/hotel/media/v1">
    <HotelRefs>
        <HotelRef HotelCode="'.session()->get('hotels')[$r->id]['hotelCode'].'" CodeContext="Sabre">
            <ImageRef MaxImages="30">
                <Images>
                    <Image Type="MEDIUM" />
                </Images>
                <Categories>
                    <Category Code="1" />
                   
                </Categories>
                <AdditionalInfo>
                    <Info Type="CAPTION">true</Info>
                </AdditionalInfo>
                <Languages>
                    <Language Code="EN" />
                </Languages>
            </ImageRef>
        </HotelRef>
    </HotelRefs>
</GetHotelMediaRQ>';
    }

    public function HotelContentRQXML($r){
        return  '
<GetHotelContentRQ xmlns="http://services.sabre.com/hotel/content/v1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0.0" xsi:schemaLocation="http://services.sabre.com/hotel/content/v1 GetHotelContentRQ.xsd">
    <SearchCriteria>
        <HotelRefs>
            <HotelRef HotelCode="'.session()->get('hotels')[$r->id]['hotelCode'].'" />
        </HotelRefs>
        <DescriptiveInfoRef>
            <PropertyInfo>true</PropertyInfo>
            <LocationInfo>true</LocationInfo>
            <Amenities>true</Amenities>
            <Descriptions>
                <Description Type="ShortDescription" />
                <Description Type="Services" />
                <Description Type="Attractions" />
                <Description Type="CancellationPolicy" />
                <Description Type="Directions" />
            </Descriptions>
            <Airports>true</Airports>
            <AcceptedCreditCards>false</AcceptedCreditCards>
        </DescriptiveInfoRef>
        <ImageRef MaxImages="ALL">
        <Images>
          <Image Type="THUMBNAIL"/>
          <Image Type="ORIGINAL"/>
          <Image Type="SMALL"/>
          <Image Type="MEDIUM"/>
          <Image Type="LARGE"/>
        </Images>
        <Categories>
          <Category Code="1"/>
          <Category Code="2"/>
          <Category Code="3"/>
          <Category Code="4"/>
          <Category Code="5"/>
          <Category Code="6"/>
          <Category Code="7"/>
          <Category Code="8"/>
          <Category Code="9"/>
          <Category Code="10"/>
          <Category Code="11"/>
          <Category Code="12"/>
          <Category Code="13"/>
          <Category Code="14"/>
          <Category Code="15"/>
          <Category Code="16"/>
          <Category Code="17"/>
          <Category Code="18"/>
          <Category Code="19"/>
          <Category Code="20"/>
          <Category Code="21"/>
          <Category Code="22"/>
        </Categories>
        <AdditionalInfo>
          <Info Type="CAPTION">true</Info>
        </AdditionalInfo>
        <Languages>
          <Language Code="EN"/>
        </Languages>
        </ImageRef>
    </SearchCriteria>
</GetHotelContentRQ>';
    }

    public function getHotelRoomsCurrencyRate($sortedResponseArray){

        if(!empty($sortedResponseArray['rooms'])){
             return $sortedResponseArray['rooms'][0]['currencyCode'];
        }else{
            return '';
        }
    }

    public function getRate($responseArray){
    $rate = $responseArray['soap-env_Body']['DisplayCurrencyRS']['Country']['Rate'];
    return $rate;
    }

    public function HotelPropertyDescriptionRQXML($r){
        return '
<HotelPropertyDescriptionRQ Version="2.3.0" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <AvailRequestSegment>
        <GuestCounts Count="'.session()->get('hotelSearchParam')['guests'].'" />
        <HotelSearchCriteria>
            <Criterion>
                <HotelRef HotelCode="'.session()->get('hotels')[$r->id]['hotelCode'].'" />
            </Criterion>
        </HotelSearchCriteria>
        <TimeSpan End="'.date('m-d',strtotime(session()->get('hotelSearchParam')['checkout_date'])).'" Start="'.date('m-d',strtotime(session()->get('hotelSearchParam')['checkin_date'])).'" />
    </AvailRequestSegment>
</HotelPropertyDescriptionRQ>';
    }

    public function HotelRateDescriptionRQXML($r){
        return '<HotelRateDescriptionRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Version="2.3.0">
    <AvailRequestSegment>
        <GuestCounts Count="'.session()->get('hotelSearchParam')['guests'].'" />
        <HotelSearchCriteria>
            <Criterion>
                <HotelRef HotelCode="'.session()->get('hotels')[$r->id]['hotelCode'].'" />
            </Criterion>
        </HotelSearchCriteria>
        <RatePlanCandidates>
            <RatePlanCandidate CurrencyCode="NGN" DCA_ProductCode="A1B2C3D" />
        </RatePlanCandidates>
        <TimeSpan End="'.date('m-d',strtotime(session()->get('hotelSearchParam')['checkout_date'])).'" Start="'.date('m-d',strtotime(session()->get('hotelSearchParam')['checkin_date'])).'" />
    </AvailRequestSegment>
</HotelRateDescriptionRQ>';
    }

    public function HotelPassengerDetailsRQXML($r){

    }

    public function DisplayCurrencyRQXML($code){
        return '<DisplayCurrencyRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" TimeStamp="2012-01-12T11:00:00-06:00" Version="2.1.0">
                 <CountryCode>NG</CountryCode>
                 <CurrencyCode>'.$code.'</CurrencyCode>
                 </DisplayCurrencyRQ>';
    }

    public function HotelReserveRQXML($room,$selectedHotel){
        return '<OTA_HotelResRQ xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ReturnHostCommand="false" TimeStamp="2013-11-22T17:15:00-06:00" Version="2.2.0">
                <Hotel>
                  <BasicPropertyInfo RPH="'.$selectedHotel['rooms'][$room]['rph'].'" />
                  <Customer NameNumber="1.1" />           
                  <Guarantee Type="'.$selectedHotel['rooms'][$room]['guaranteeSurchargeRequired'].'">
                    <CC_Info>
                     <PaymentCard Code="VI" ExpireDate="2019-07" Number="4111111111111111"/>
                     <PersonName>
                     <Surname>TESTING</Surname>
                     </PersonName>
                    </CC_Info>
                  </Guarantee>
                  <RoomType NumberOfUnits="1"/>
                  <SpecialPrefs>
                   <WrittenConfirmation Ind="true" />
                  </SpecialPrefs>
                </Hotel>
              </OTA_HotelResRQ>';
    }

    public function HotelAvailValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap-env_Body']['OTA_HotelAvailRS']['stl_ApplicationResults']['stl_Success'])){
               if(isset($responseArray['soap-env_Body']['OTA_HotelAvailRS']['AvailabilityOptions'])){
                   return 1;
               }else{
                   return 21;
               }
            }else{
                return 2;
            }
        }
    }

    public function HotelAvailSort($responseArray){
        $availableHotels = $responseArray['soap-env_Body']['OTA_HotelAvailRS']['AvailabilityOptions']['AvailabilityOption'];
        $available = [];
        if(isset($availableHotels[0])){
           foreach($availableHotels as $i => $availableHotel){
               $amenityArray = " ";
               $amenities = $availableHotel['BasicPropertyInfo']['PropertyOptionInfo'];
               foreach($amenities as $j => $amenity){
                   if($amenity['@attributes']['Ind'] == 'true'){
                       $amenityArray = $amenityArray." ".$j;
                   }
               }
               $minimumPrice = 0; $maximumPrice = 0; $star_rating = 0;
               $latitude = 0; $longitude = 0; $phone = 0; $fax = 0;
               if(isset($availableHotel['BasicPropertyInfo']['RateRange'])){
                   $minimumPrice = $availableHotel['BasicPropertyInfo']['RateRange']['@attributes']['Min'];
                   $maximumPrice = $availableHotel['BasicPropertyInfo']['RateRange']['@attributes']['Max'];
               }
               if(isset($availableHotel['BasicPropertyInfo']['Property'])){
                   $rating = $availableHotel['BasicPropertyInfo']['Property']['Text'];
                   $star_rating = substr($rating,0,1);
               }
               if(isset( $availableHotel['BasicPropertyInfo']['@attributes']['Latitude'])){
                   $latitude =  $availableHotel['BasicPropertyInfo']['@attributes']['Latitude'];
                   $longitude =  $availableHotel['BasicPropertyInfo']['@attributes']['Longitude'];
               }
               if(isset( $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['Phone'])){
                   $phone =  $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['Phone'];
               }
               if(isset($availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['Fax'])){
                   $fax = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['Fax'];
               }
               $fulladdress = "";
               foreach($availableHotel['BasicPropertyInfo']['Address']['AddressLine'] as $j => $address){
                   $fulladdress = $fulladdress.", ".$address;
               }
               $hotel_info = [
                   'rph' => $availableHotel['@attributes']['RPH'],
                   'areaId' => $availableHotel['BasicPropertyInfo']['@attributes']['AreaID'],
                   'chainCode' => $availableHotel['BasicPropertyInfo']['@attributes']['ChainCode'],
                   'distance' => $availableHotel['BasicPropertyInfo']['@attributes']['Distance'],
                   'hotelCode' => $availableHotel['BasicPropertyInfo']['@attributes']['HotelCode'],
                   'confidentialLevel' => $availableHotel['BasicPropertyInfo']['@attributes']['GEO_ConfidenceLevel'],
                   'starRating' => $star_rating,
                   'hotelCityCode' => $availableHotel['BasicPropertyInfo']['@attributes']['HotelCityCode'],
                   'hotelName' => $availableHotel['BasicPropertyInfo']['@attributes']['HotelName'],
                   'latitude' => $latitude,
                   'longitude' => $longitude,
                   'address' => $fulladdress,
                   'phone' => $phone,
                   'fax' => $fax,
                   'rateLevelCode' => $availableHotel['BasicPropertyInfo']['RoomRate']['@attributes']['RateLevelCode'],
                   'hotelRateCode' => $availableHotel['BasicPropertyInfo']['RoomRate']['HotelRateCode'],
                   'minimumPrice' => $minimumPrice,
                   'maximumPrice' => $maximumPrice,
                   'hotelAmenity' => $amenityArray
               ];
               array_push($available,$hotel_info);
           }
        }
        else{
            $availableHotel = $availableHotels;
            $amenityArray = [];
            $amenities = $availableHotel['BasicPropertyInfo']['PropertyOptionInfo'];
            if(isset($amenities[0])){
                foreach($amenities as $j => $amenity){
                    if($amenity['@attributes']['Ind'] == 'true'){
                        array_push($amenityArray,$j);
                    }
                }
            }else{
                array_push($amenityArray,$amenities);
            }
            $minimumPrice = 0; $maximumPrice = 0; $star_rating = 0;
            $latitude = 0; $longitude = 0;
            if(isset($availableHotel['BasicPropertyInfo']['RateRange'])){
                $minimumPrice = '';  $maximumPrice = '';
            }
            if(isset($availableHotel['BasicPropertyInfo']['Property'])){
                $rating = $availableHotel['BasicPropertyInfo']['Property']['Text'];
                $star_rating = substr($rating,0,1);
            }
            if(isset( $availableHotel['BasicPropertyInfo']['@attributes']['Latitude'])){
                $latitude =  $availableHotel['BasicPropertyInfo']['@attributes']['Latitude'];
                $longitude =  $availableHotel['BasicPropertyInfo']['@attributes']['Longitude'];
            }
            $fulladdress = "";
            foreach($availableHotel['BasicPropertyInfo']['Address']['AddressLine'] as $i => $address){
                $fulladdress = $fulladdress.", ".$address;
            }
            $hotel_info = [
                'rph' => $availableHotel['@attributes']['RPH'],
                'areaId' => $availableHotel['BasicPropertyInfo']['@attributes']['AreaID'],
                'chainCode' => $availableHotel['BasicPropertyInfo']['@attributes']['ChainCode'],
                'distance' => $availableHotel['BasicPropertyInfo']['@attributes']['Distance'],
                'hotelCode' => $availableHotel['BasicPropertyInfo']['@attributes']['HotelCode'],
                'confidentialLevel' => $availableHotel['BasicPropertyInfo']['@attributes']['GEO_ConfidenceLevel'],
                'starRating' => $star_rating,
                'hotelCityCode' => $availableHotel['BasicPropertyInfo']['@attributes']['HotelCityCode'],
                'hotelName' => $availableHotel['BasicPropertyInfo']['@attributes']['HotelName'],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => $fulladdress,
                'phone' => $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['Phone'],
                'fax' => $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['Fax'],
                'rateLevelCode' => $availableHotel['BasicPropertyInfo']['RoomRate']['@attributes']['RateLevelCode'],
                'hotelRateCode' => $availableHotel['BasicPropertyInfo']['RoomRate']['HotelRateCode'],
                'minimumPrice' => $minimumPrice,
                'maximumPrice' => $maximumPrice,
                'hotelAmenity' => $amenityArray
            ];
            array_push($available,$hotel_info);
        }
        return $available;
    }

    public function HotelAvailAmenities($responseArray){
        $availableHotels = $responseArray['soap-env_Body']['OTA_HotelAvailRS']['AvailabilityOptions']['AvailabilityOption'];
        $availableAmenities = [];
        if(isset($availableHotels[0])){
            foreach($availableHotels as $i => $availableHotel){
                $amenities = $availableHotel['BasicPropertyInfo']['PropertyOptionInfo'];
                foreach($amenities as $j => $amenity){
                    if($amenity['@attributes']['Ind'] == 'true'){
                        array_push($availableAmenities,$j);
                    }
                }
            }
        }else{
            $amenities = $availableHotels['BasicPropertyInfo']['PropertyOptionInfo'];
            foreach($amenities as $j => $amenity){
                if($amenity['@attributes']['Ind'] == 'true'){
                    array_push($availableAmenities,$amenity);
                }
            }
        }
        return array_count_values($availableAmenities);
    }

    public function HotelRatings($responseArray){
        $availableHotels = $responseArray['soap-env_Body']['OTA_HotelAvailRS']['AvailabilityOptions']['AvailabilityOption'];
        $ratings = [];
        if(isset($availableHotels[0])){
            foreach($availableHotels as $i => $availableHotel){
                if(isset($availableHotel['BasicPropertyInfo']['Property'])){
                    $rating = $availableHotel['BasicPropertyInfo']['Property']['Text'];
                    $star_rating = substr($rating,0,1);
                }else{
                    $star_rating = 0;
                }
                array_push($ratings,$star_rating);
            }
        }else{
            if(isset($availableHotels['BasicPropertyInfo']['Property'])){
                $rating = $availableHotels['BasicPropertyInfo']['Property']['Text'];
                $star_rating = substr($rating,0,1);
            }else{
                $star_rating = 0;
            }
               array_push($ratings,$star_rating);
        }
        return array_count_values($ratings);
    }

    public function validateHotelPropertyDescription($responseArray){
        if(empty($responseArray) || is_null($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['stl_ApplicationResults']['stl_Success'])){
                return 1;
//                if(isset($responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['RoomStay']['RoomRates'])){
//                      return 1;
//                }else{
//                    return $responseArray;
//                       return 22;
//                }
            }
            else{
                return 2;
            }
        }
    }

    public function sortPropertyDescription($responseArray, $rate){
        $checkinDate = $responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['RoomStay']['TimeSpan']['@attributes']['Start'];
        $checkoutDate = $responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['RoomStay']['TimeSpan']['@attributes']['End'];
        $in = strtotime($checkinDate);
        $out = strtotime($checkoutDate);
        $duration = (($out - $in)/86400) + 1;
        $basicPropertyInfo = $responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['RoomStay']['BasicPropertyInfo'];
        $checkinTime = 0;  $checkoutTime = 0;
        if(isset($basicPropertyInfo['CheckInTime'])){
            $checkinTime = $basicPropertyInfo['CheckInTime'];
        }
        if(isset($basicPropertyInfo['CheckOutTime'])){
            $checkoutTime = $basicPropertyInfo['CheckOutTime'];
        }
        $hotelName = $basicPropertyInfo['@attributes']['HotelName'];
        $hotelCityCode = $basicPropertyInfo['@attributes']['HotelCityCode'];
        $hotelCode = $basicPropertyInfo['@attributes']['HotelCode'];
        $chainCode = $basicPropertyInfo['@attributes']['ChainCode'];

        $floors = 0;
        if(isset($basicPropertyInfo['@attributes']['NumFloors'])){
                    $floors = $basicPropertyInfo['@attributes']['NumFloors'];
        }
        $fax = 0; $phone = 0;
        if(isset($basicPropertyInfo['ContactNumbers']['ContactNumber']['@attributes']['Fax'])){
            $fax = $basicPropertyInfo['ContactNumbers']['ContactNumber']['@attributes']['Fax'];
        }
        if(isset($basicPropertyInfo['ContactNumbers']['ContactNumber']['@attributes']['Phone'])){
            $phone = $basicPropertyInfo['ContactNumbers']['ContactNumber']['@attributes']['Phone'];
        }
        $address = '';
        $addresslines = $basicPropertyInfo['Address']['AddressLine'];
        if(isset($addresslines[0])){
        foreach($addresslines as $l => $addressline){
            $address = $address.$addressline;
        }
        }else{
            $address = $addresslines;
        }

        $location = '';
        $attractions = '';
        $description = '';
        $hotelDescriptions = $basicPropertyInfo['VendorMessages']['Description']['Text'];
        foreach($hotelDescriptions as $m => $hotelDescription){
            $description = $description." ".$hotelDescription;
        }
        if(isset($basicPropertyInfo['VendorMessages']['Location']['Text'])){
            $hotelLocations = $basicPropertyInfo['VendorMessages']['Location']['Text'];
            foreach($hotelLocations as $m => $hotelLocation){
                $location = $location." ".$hotelLocation;
            }
        }
        $allRooms = [];
        if(isset($responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['RoomStay']['RoomRates']['RoomRate'])){
            $availableRooms = $responseArray['soap-env_Body']['HotelPropertyDescriptionRS']['RoomStay']['RoomRates']['RoomRate'];
            if(!isset($availableRooms[0])) {
                $baseAmountPerNight = $availableRooms['Rates']['Rate']['@attributes']['Amount'];
                $baseAmountPerNightNaira = $this->SabreConfig->rateAmountCalculator($availableRooms['Rates']['Rate']['@attributes']['Amount'],$rate);
                $baseAmountAllNights = $baseAmountPerNight * $duration;
                if(isset($availableRooms['Rates']['Rate']['HotelTotalPricing']['@attributes']['Amount'])){
                    $baseAmountAllNights = $availableRooms['Rates']['Rate']['HotelTotalPricing']['@attributes']['Amount'];
                }
                $baseAmountAllNightsNaira = $this->SabreConfig->rateAmountCalculator($baseAmountAllNights,$rate);
                if($rate == 0){
                    $baseAmountAllNightsNaira = 0;
                }
                $adminUserMarkupObject = AdminMarkup::getAdminUserMarkup();
                $tax = $this->SabreConfig->priceTypeCalculator($adminUserMarkupObject->hotel_markup_type,$adminUserMarkupObject->hotel_markup_value,$baseAmountAllNightsNaira);
                $vatObject = Vat::getVat();
                $vat = $this->SabreConfig->priceTypeCalculator($vatObject->hotel_vat_type,$vatObject->hotel_vat_value,$baseAmountAllNightsNaira);
                $totalAmount = $baseAmountAllNightsNaira + $vat + $tax;
                $roomInfo = [
                    'roomDescription' => $availableRooms['AdditionalInfo']['Text'][0],
                    'roomAmenitySummary' => $availableRooms['AdditionalInfo']['Text'][1],
                    'hrdRequiredForSell' => $availableRooms['Rates']['Rate']['@attributes']['HRD_RequiredForSell'],
                    'guaranteeSurchargeRequired' => $availableRooms['@attributes']['GuaranteeSurchargeRequired'],
                    'iataCharacteristicsIdentification' => $availableRooms['@attributes']['IATA_CharacteristicIdentification'],
                    'baseAmountPerNight' => $baseAmountPerNight,
                    'currencyCode' => $availableRooms['Rates']['Rate']['@attributes']['CurrencyCode'],
                    'baseAmountPerNightNaira' => $baseAmountPerNightNaira,
                    'tax' => $tax,
                    'vat' => $vat,
                    'Duration' => $duration,
                    'baseAmountAllNights' => $baseAmountAllNights,
                    'baseAmountAllNightsNaira' => $baseAmountAllNightsNaira,
                    'totalAmount' => $totalAmount,
                    'rph' => $availableRooms['@attributes']['RPH'],
                    'rate' => $rate,
                    'commission' => $availableRooms['AdditionalInfo']['Commission'],
                ];
                array_push($allRooms, $roomInfo);
            }
            else {
                foreach ($availableRooms as $k => $availableRoom) {
                    $baseAmountPerNight = $availableRoom['Rates']['Rate']['@attributes']['Amount'];
                    $baseAmountPerNightNaira = $this->SabreConfig->rateAmountCalculator($availableRoom['Rates']['Rate']['@attributes']['Amount'],$rate);
                    $baseAmountAllNights = $baseAmountPerNight * $duration;
                    if(isset($availableRoom['Rates']['Rate']['HotelTotalPricing']['@attributes']['Amount'])){
                        $baseAmountAllNights = $availableRoom['Rates']['Rate']['HotelTotalPricing']['@attributes']['Amount'];
                    }
                    $baseAmountAllNightsNaira = $this->SabreConfig->rateAmountCalculator($baseAmountAllNights,$rate);
                    if($rate == 0){
                        $baseAmountAllNightsNaira = 0;
                    }
                    $adminUserMarkupObject = AdminMarkup::getAdminUserMarkup();
                    $tax = $this->SabreConfig->priceTypeCalculator($adminUserMarkupObject->hotel_markup_type,$adminUserMarkupObject->hotel_markup_value,$baseAmountAllNightsNaira);
                    $vatObject = Vat::getVat();
                    $vat = $this->SabreConfig->priceTypeCalculator($vatObject->hotel_vat_type,$vatObject->hotel_vat_value,$baseAmountAllNightsNaira);
                    $totalAmount = $baseAmountAllNightsNaira + $vat + $tax;
                    $roomInfo = [
                        'roomDescription' => $availableRoom['AdditionalInfo']['Text'][0],
                        'roomAmenitySummary' => $availableRoom['AdditionalInfo']['Text'][1],
                        'hrdRequiredForSell' => $availableRoom['Rates']['Rate']['@attributes']['HRD_RequiredForSell'],
                        'guaranteeSurchargeRequired' => $availableRoom['@attributes']['GuaranteeSurchargeRequired'],
                        'iataCharacteristicsIdentification' => $availableRoom['@attributes']['IATA_CharacteristicIdentification'],
                        'baseAmountPerNight' => $baseAmountPerNight,
                        'currencyCode' => $availableRoom['Rates']['Rate']['@attributes']['CurrencyCode'],
                        'baseAmountPerNightNaira' => $baseAmountPerNightNaira,
                        'tax' => $tax,
                        'vat' => $vat,
                        'Duration' => $duration,
                        'baseAmountAllNights' => $baseAmountAllNights,
                        'baseAmountAllNightsNaira' => $baseAmountAllNightsNaira,
                        'totalAmount' => $totalAmount,
                        'rph' => $availableRoom['@attributes']['RPH'],
                        'rate' => $rate,
                        'commission' => $availableRoom['AdditionalInfo']['Commission']
                    ];
                    array_push($allRooms, $roomInfo);
                }
            }
        }


        return [
            'checkInTime' => $checkinTime,
            'checkOutTime' => $checkoutTime,
            'checkinDate' => $checkinDate,
            'checkoutDate' => $checkoutDate,
            'address' => $address,
            'floors' => $floors,
            'phone' => $phone,
            'fax' => $fax,
            'locationDescription' => $location,
            'hotelDescription' => $description,
            'hotelName' => $hotelName,
            'hotelCityCode' => $hotelCityCode,
            'hotelCode' => $hotelCode,
            'chainCode' => $chainCode,
            'rooms' => $allRooms
        ];
    }

//    public function PassengerDetailsPassenger($param){
//        $adults = session()->get('hotelSearchParam')['adult_passengers'];
//        $children = session()->get('fligSearchParam')['child_passengers'];
//        $infants = session()->get('flightSearchParam')['infant_passengers'];
//        $passengerDetails = '';
//        $priceQuoteInfo = '';
//        $y = 0;
//        $infants_num = 2;
//        if($adults > 0){
//            for($i = 0; $i < $adults; $i++){
//                $given_name = $param->adult_given_name[$i];
//                $surname = $param->adult_surname[$i];
//                $personDetails = '<PersonName Infant="false" NameNumber="'.($y + 1).'.1" PassengerType="ADT">
//                <GivenName>'.$given_name.'</GivenName>
//                <Surname>'.$surname.'</Surname>
//            </PersonName>';
//
//
//                $passengerDetails = $passengerDetails.$personDetails;
//                $priceQuoteInfo = $priceQuoteInfo.'<Link NameNumber="'.($y + 1).'.1" Record="1"/>';
//                $y = $y+1;
//            }
//        }
//        if($children > 0){
//            for($i = 0; $i < $children; $i++){
//                $given_name = $param->child_given_name[$i];
//                $surname = $param->child_surname[$i];
//                $personDetails = '<PersonName Infant="false" NameNumber="'.($y + 1).'.1" PassengerType="CNN">
//                <GivenName>'.$given_name.'</GivenName>
//                <Surname>'.$surname.'</Surname>
//            </PersonName>';
//                $passengerDetails = $passengerDetails.$personDetails;
//                $priceQuoteInfo = $priceQuoteInfo.'<Link NameNumber="'.($y + 1).'.1" Record="2"/>';
//                $y = $y+1;
//            }
//            $infants_num = $infants_num + 1;
//        }
//        if($infants > 0){
//            if($children > 0){$nameNumber = 3;}else{$nameNumber = 2;}
//            for($i = 0; $i < $infants; $i++){
//                $given_name = $param->infant_given_name[$i];
//                $surname = $param->infant_surname[$i];
//                $personDetails = '<PersonName Infant="true" NameNumber="'.($y + 1).'.1" PassengerType="INF">
//                <GivenName>'.$given_name.'</GivenName>
//                <Surname>'.$surname.'</Surname>
//            </PersonName>';
//                $passengerDetails = $passengerDetails.$personDetails;
//                $priceQuoteInfo = $priceQuoteInfo.'<Link NameNumber="'. ($y + 1) .'.1" Record="'.$infants_num.'"/>';
//                $y = $y+1;
//            }
//        }
//        return ['passengers' => $passengerDetails, 'priceQuoteInfo' => $priceQuoteInfo];
//    }
    public function PassengerDetailsRQXML(){
        $phone_number = auth()->user()->phone_number;  $email = auth()->user()->email; $given_name = auth()->user()->last_name; $surname = auth()->user()->first_name;

        return '<PassengerDetailsRQ version="3.3.0" xmlns="http://services.sabre.com/sp/pd/v3_3" IgnoreOnError="false" HaltOnError="true">
    <TravelItineraryAddInfoRQ>
        <AgencyInfo>
			<Address>
                  <AddressLine>KALIFE TRAVELS</AddressLine>
                  <CityName>LAGOS</CityName>
                  <CountryCode>NG</CountryCode>
                  <PostalCode>101001</PostalCode>
                  <StateCountyProv StateCode="LA" />
                  <StreetNmbr>11B Wole Ariyo</StreetNmbr>
               </Address>
		</AgencyInfo>
        <CustomerInfo>
            <ContactNumbers>
                <ContactNumber LocationCode="LOS" NameNumber="1.1" Phone="'.$phone_number.'" PhoneUseType="H"/>
            </ContactNumbers>
            <Email Address="'.$email.'" NameNumber="1.1" Type="CC"/>
            <PersonName Infant="false" NameNumber="1.1" PassengerType="ADT">
                <GivenName>'.$given_name.'</GivenName>
                <Surname>'.$surname.'</Surname>
            </PersonName>
        </CustomerInfo>
	</TravelItineraryAddInfoRQ>
</PassengerDetailsRQ>';
    }

    public function EndTransactionRQXML(){
        return '<EndTransactionRQ Version="2.0.8" xmlns="http://webservices.sabre.com/sabreXML/2011/10" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <EndTransaction Ind="true" />
       <Source ReceivedFrom="SWS TESTING" />
       </EndTransactionRQ>';
    }

}