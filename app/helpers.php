<?php

    const
    SUPER_ADMIN_ROLE_ID = 1,
    AGENT_ROLE_ID = 2,
    CUSTOMER_ROLE_ID = 3,

    FLIGHT_ONEWAY = 1,
    FLIGHT_RETURN = 2,
    FLIGHT_MULTI_DESTINATION = 3,


    //STATUS
    ACTIVE = 1,
    INACTIVE = 0,

    //TRANSACTION LOG
    CREDITED = 1,
    DEBITED = 0,
    FAILED = 2,


    //MARKUP VALUES

      PERCENTAGE_MARKUP = 0,
      NAIRA_MARKUP = 1,
    //DEPOSIT STATUS
    DEPOSIT_RESERVED = 3,
    DEPOSIT_PENDING = 2,
    DEPOSIT_APPROVED = 1,
    DEPOSIT_DECLINED = 0;

  function markupTypes(){
    $markup_types = array('0'=>'Percentage','1'=>'Amount in naira');
    return $markup_types;
  }
  function html_title(){
    echo '
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Miss">Miss</option>
      <option value="Master">Master</option>
      
    ';
  }
  function vatTypes(){
    $markup_types = array('0'=>'Percentage','1'=>'Amount in naira');
    return $markup_types;
  }
  function titles(){
    $titles = array('Mr'=>'Mr','Mrs'=>'Mrs','Miss'=>'Miss','Master'=>'Master');
    return $titles;
  }
  function status(){
    $status = array('0'=>'Inactive','1'=>'Active');
    return $status;
  }
  function authenticated_user_id(){
    return auth()->user()->id;
  }
  function getAuthenticatedUserRoleId(){
    $role = \App\User::join('role_user as ru', 'users.id', 'ru.user_id')
        ->where('users.id', authenticated_user_id())
        ->select('ru.role_id as id')->first();
    return $role->id;
  }
  function actions(){
    $actions = array('1'=>'Voucher','2'=>'Issue Ticket','3'=>'Cancel Booking');
    return $actions;
  }
  function numbers(){
    $numbers = array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5');
    return $numbers;
  }
  function cabin(){
  $numbers = array('Economy'=>'Economy','Business'=>'Business','Premium'=>'Premium','First'=>'First Class');
  return $numbers;
}
  function convertNameType($name_type){
    if($name_type == 'ADT'){
      return 'Adult';
    }elseif($name_type == 'CHD'){
      return 'Kid';
    }elseif($name_type == 'INF'){
      return 'Infants';
    }
  }
  function modesOfPayment(){
    $modes = array('1'=>'Transfer','2'=>'Cash deposit');
    return $modes;
  }
  function getModesOfPayment($mode_id){
    if($mode_id == 1){
      return 'Transfer';
    }elseif($mode_id == 2){
      return 'Cash Deposit';
    }
  }
  function getDepositStatus($status_id){
    if($status_id == DEPOSIT_PENDING){
      echo '<div class ="label label-warning"><i class="fa fa-warning"></i>&nbsp;PENDING</div>';
    }elseif($status_id == DEPOSIT_APPROVED){
      echo '<div class="label label-success"><i class="fa fa-check"></i>&nbsp;CREDITED</div>';
    }elseif($status_id == DEPOSIT_DECLINED){
      echo '<div class="label label-danger"><i class="fa fa-times"></i>&nbsp;DECLINED</div>';
    }elseif($status_id == DEPOSIT_RESERVED){
      echo '<div class="label label-primary">RESERVED</div>';
    }
  }
  function getTransactionStatus($status_id){
    if($status_id == CREDITED){
      echo '<div class="label label-success"><i class="fa fa-check"></i>&nbsp;CREDITED</div>';
    }elseif($status_id == DEBITED){
      echo '<div class="label label-info"><i class="fa fa-check"></i>&nbsp;DEBITED</div>';
    }elseif($status_id == FAILED){
      echo '<div class="label label-danger"><i class="fa fa-times"></i>&nbsp;FAILED</div>';
    }
  }
  function getDurationType(){
    $duration_type = array('Short duration'=>'Short duration', 'Long duration'=> 'Long duration');
    return $duration_type;
  }
  function categories(){
    $categories = array('Flight'=>'Flight', 'Hotel'=>'Hotel', 'Car'=>'Car');
    return $categories;
  }
  function getTicketDeadlineDate($date){
    $explode_date = explode('T', $date);
    return strtotime($explode_date[0]).strtotime($explode_date[1]);
  }
  function getTodaysDate(){
    $date = \Carbon\Carbon::now();
    $explode_date = explode(' ', $date);
    return strtotime($explode_date[0]).strtotime($explode_date[1]);
  }
  function convertToAmadeusDate($date){
    return \Carbon\Carbon::parse($date)->format('Y-m-d');
//    return Carbon::parse($r->depart_on)->format('Y-m-d');
  }
  function getAmadeusDate($date){
    $explode_date = explode('T', $date);
    return $explode_date[0];
  }
  function getAmadeusTime($date){
    $explode_date = explode('T', $date);
    return $explode_date[1];
  }
  function bookingStatus($pnr, $payment_status, $ticket_status, $ticket_deadline, $cancel_status){
    if((!is_null($pnr) || !empty($pnr)) && ($payment_status == 1) && ($ticket_status == 1)){
      echo '<div class="label label-success"><i class="fa fa-check"></i> &nbsp; BOOKING CONFIRMED</div>';
    }elseif((!is_null($pnr) || !empty($pnr)) && ($payment_status == 0) && ($ticket_status == 0) && ($ticket_deadline > getTodaysDate())){
      echo '<div class="label label-warning"><i class="fa fa-hand-o-down"></i> &nbsp; BOOKING ON HOLD</div>';
    }elseif((!is_null($pnr) || !empty($pnr)) && ($payment_status == 1) && ($ticket_status == 1) && $cancel_status == 1 && ($ticket_deadline > getTodaysDate())){
      echo '<div class="label label-danger"><i class="fa fa-times"></i> &nbsp;  BOOKING CANCELLED</div>';
    }elseif ((!is_null($pnr) || !empty($pnr)) && ($payment_status == 0) && ($ticket_status == 0)){
      echo '<div class="label label-danger"><i class="fa fa-warning"></i> &nbsp;  BOOKING ERROR</div>';
    }elseif ((!is_null($pnr) || !empty($pnr)) && ($payment_status == 1) && ($ticket_status == 0) && ($ticket_deadline > getTodaysDate())){
      echo '<div class="label label-primary"><i class="fa fa-minus"></i> &nbsp;  BOOKING INCOMPLETE</div>';
    }
  }
  function bookingStatusHotel($pnr, $payment_status, $booking_status, $ticket_deadline, $cancel_status){
    if((!is_null($pnr) || !empty($pnr)) && ($payment_status == 1) && ($booking_status == 1)){
      echo '<div class="label label-success"><i class="fa fa-check"></i> &nbsp; BOOKING CONFIRMED</div>';
    }elseif((!is_null($pnr) || !empty($pnr)) && ($payment_status == 1) && ($booking_status == 1) && ($cancel_status == 1) && ($ticket_deadline > getTodaysDate())){
      echo '<div class="label label-danger"><i class="fa fa-times"></i> &nbsp;  BOOKING CANCELLED</div>';
    }elseif((is_null($pnr) || empty($pnr)) && ($payment_status == 0) && ($booking_status == 0)){
      echo '<div class="label label-danger"><i class="fa fa-warning"></i> &nbsp;  BOOKING ERROR</div>';
    }
  }
  function flightXml($departure_date,$return_date = NULL, $departure_city_code, $arrival_city_code, $cabin, $no_adult, $no_kids, $no_infants, $flight_type){
    $response = "";
    $response .= '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Header>
            <TripXML xmlns="http://amadeusws.tripxml.com/wsLowFarePlus">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>
          </soap:Header>
          <soap:Body>
         <wmLowFarePlus xmlns="http://traveltalk.com/wsLowFarePlus">
            <OTA_AirLowFareSearchPlusRQ>
               <POS>
                 <Source PseudoCityCode="MIA1S21AV" ISOCurrency="NGN">
                    <RequestorID Type="21" ID="RubyTravel" />
                 </Source>
                 <TPA_Extensions>
                    <Provider>
                       <Name>Amadeus</Name>
                       <System>Test</System>
                       <Userid>RubyTravel</Userid>
                       <Password>sTeBr+Fr3kEv</Password>
                    </Provider>
                 </TPA_Extensions>
              </POS>';

              if($flight_type == FLIGHT_ONEWAY){
                $response.='<OriginDestinationInformation>
                              <DepartureDateTime>'.$departure_date.'T00:00:00</DepartureDateTime>
                              <OriginLocation LocationCode="'.$departure_city_code.'" />
                              <DestinationLocation LocationCode="'.$arrival_city_code.'" />
                           </OriginDestinationInformation>';
              }
              elseif($flight_type == FLIGHT_RETURN){
                $response.='<OriginDestinationInformation>
                              <DepartureDateTime>'.$departure_date.'T00:00:00</DepartureDateTime>
                              <OriginLocation LocationCode="'.$departure_city_code.'" />
                              <DestinationLocation LocationCode="'.$arrival_city_code.'" />
                           </OriginDestinationInformation>
                           <OriginDestinationInformation>
                              <DepartureDateTime>'.$return_date.'T00:00:00</DepartureDateTime>
                              <OriginLocation LocationCode="'.$arrival_city_code.'" />
                              <DestinationLocation LocationCode="'.$departure_city_code.'" />
                           </OriginDestinationInformation>
                           ';
              }
            $response.='<TravelPreferences>
                  <CabinPref Cabin="'.$cabin.'" />
               </TravelPreferences>
               <TravelerInfoSummary>';
                  if($no_kids == 0){
                    $response.='<SeatsRequested>'.$no_adult.'</SeatsRequested>';
                  }elseif($no_kids > 0){
                    $response.='<SeatsRequested>'.($no_adult + $no_kids).'</SeatsRequested>';
                  }
                  $response.='<AirTravelerAvail>';
                    if(($no_kids == 0) && ($no_infants == 0)){
                      $response.='<PassengerTypeQuantity Code="ADT" Quantity="'.$no_adult.'" />';
                    }elseif(($no_kids > 0) && ($no_infants > 0)){
                      $response.='<PassengerTypeQuantity Code="CHD" Quantity="'.$no_kids.'" />';
                      $response.='<PassengerTypeQuantity Code="INF" Quantity="'.$no_infants.'" />';
                      $response.='<PassengerTypeQuantity Code="ADT" Quantity="'.$no_adult.'" />';
                    }elseif($no_kids > 0){
                      $response.='<PassengerTypeQuantity Code="CHD" Quantity="'.$no_kids.'" />';
                      $response.='<PassengerTypeQuantity Code="ADT" Quantity="'.$no_adult.'" />';
                    }
                 $response.=' </AirTravelerAvail>
               </TravelerInfoSummary>
            </OTA_AirLowFareSearchPlusRQ>
            </wmLowFarePlus>
          </soap:Body>
        </soap:Envelope>
                ';
                    
          return $response;
  }
  function flightXmlMulti($array, $flight_type){
    $response = "";
    $response .= '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Header>
            <TripXML xmlns="http://amadeusws.tripxml.com/wsLowFarePlus">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>
          </soap:Header>
          <soap:Body>
         <wmLowFarePlus xmlns="http://traveltalk.com/wsLowFarePlus">
            <OTA_AirLowFareSearchPlusRQ>
               <POS>
                 <Source PseudoCityCode="MIA1S21AV" ISOCurrency="NGN">
                    <RequestorID Type="21" ID="RubyTravel" />
                 </Source>
                 <TPA_Extensions>
                    <Provider>
                       <Name>Amadeus</Name>
                       <System>Test</System>
                       <Userid>RubyTravel</Userid>
                       <Password>sTeBr+Fr3kEv</Password>
                    </Provider>
                 </TPA_Extensions>
              </POS>';

              if($flight_type == FLIGHT_MULTI_DESTINATION){
                for($i = 0; $i < $array['no_flights']; $i++){
                  $response.='<OriginDestinationInformation>
                            <DepartureDateTime>'.$array[$i]['depart_on_'.($i+1)].'T00:00:00</DepartureDateTime>
                            <OriginLocation LocationCode="'.$array[$i]['departure_city_code_'.($i+1)].'" />
                            <DestinationLocation LocationCode="'.$array[$i]['arrival_city_code_'.($i+1)].'" />
                         </OriginDestinationInformation>';
                }
              }
            $response.='<TravelPreferences>
                  <CabinPref Cabin="'.$array['cabin'].'" />
               </TravelPreferences>
               <TravelerInfoSummary>';
                  if($array['no_kids'] == 0){
                    $response.='<SeatsRequested>'.$array['no_adults'].'</SeatsRequested>';
                  }elseif($array['no_kids'] > 0){
                    $response.='<SeatsRequested>'.($array['no_adults'] + $array['no_kids']).'</SeatsRequested>';
                  }
                  $response.='<AirTravelerAvail>';
                    if(($array['no_kids'] == 0) && ($array['no_infants'] == 0)){
                      $response.='<PassengerTypeQuantity Code="ADT" Quantity="'.$array['no_adults'].'" />';
                    }elseif(($array['no_kids'] > 0) && ($array['no_infants'] > 0)){
                      $response.='<PassengerTypeQuantity Code="CHD" Quantity="'.$array['no_kids'].'" />';
                      $response.='<PassengerTypeQuantity Code="INF" Quantity="'.$array['no_infants'].'" />';
                      $response.='<PassengerTypeQuantity Code="ADT" Quantity="'.$array['no_adults'].'" />';
                    }elseif($array['no_kids'] > 0){
                      $response.='<PassengerTypeQuantity Code="CHD" Quantity="'.$array['no_kids'].'" />';
                      $response.='<PassengerTypeQuantity Code="ADT" Quantity="'.$array['no_adults'].'" />';
                    }
                 $response.=' </AirTravelerAvail>
               </TravelerInfoSummary>
            </OTA_AirLowFareSearchPlusRQ>
            </wmLowFarePlus>
          </soap:Body>
        </soap:Envelope>
                ';

          return $response;
  }
  function hotelXml($destination, $check_in, $check_out, $guests, $pos){
    $response = "";
    $response .='<?xml version="1.0" encoding="utf-8"?>
                  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                    <soap:Header>
                      <TripXML xmlns="http://amadeusws.tripxml.com/wsLowFarePlus">
                        <userName>string</userName>
                        <password>string</password>
                        <compressed>boolean</compressed>
                      </TripXML>
                    </soap:Header>
                    <soap:Body>
                      <wmHotelAvail xmlns="http://traveltalk.com/wsHotelAvail">
                        <OTA_HotelAvailRQ>
                          ';
                          $response.= $pos;
                          $response.='
                          <AvailRequestSegments>
                            <AvailRequestSegment>
                              <StayDateRange Start="'.$check_in.'" End="'.$check_out.'"/>
                              <RoomStayCandidates>
                                <RoomStayCandidate>
                                  <GuestCounts IsPerRoom="true">
                                    <GuestCount Count="'.$guests.'"/>
                                  </GuestCounts>
                                </RoomStayCandidate>
                              </RoomStayCandidates>
                              <HotelSearchCriteria>
                                <Criterion ExactMatch="true">
                                  <HotelRef HotelCityCode="'.$destination.'" />
                                </Criterion>
                              </HotelSearchCriteria>
                            </AvailRequestSegment>
                          </AvailRequestSegments>
                        </OTA_HotelAvailRQ>
                      </wmHotelAvail>
                    </soap:Body>
                  </soap:Envelope>';

    return $response;
  }
  function hotelDetailXml($destination, $check_in, $check_out, $guests, $pos, $chain_code, $hotel_code, $booking_code = NULL){
    $request = "";
    $request .= '<?xml version="1.0" encoding="utf-8"?>
      <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Header>
          <TripXML xmlns="http://amadeusws.tripxml.com/wsLowFarePlus">
            <userName>string</userName>
            <password>string</password>
            <compressed>boolean</compressed>
          </TripXML>
        </soap:Header>
        <soap:Body>
          <wmHotelAvail xmlns="http://traveltalk.com/wsHotelAvail">
            <OTA_HotelAvailRQ>';

            $request.= $pos;
            $request .='<AvailRequestSegments>
            <AvailRequestSegment>
            <StayDateRange Start="'.$check_in.'" End="'.$check_out.'"/>
            <RoomStayCandidates> 
            <RoomStayCandidate> 
            <GuestCounts IsPerRoom="true">
            <GuestCount Count="'.$guests.'"/>
            </GuestCounts>
            </RoomStayCandidate>
            </RoomStayCandidates>
            <HotelSearchCriteria>
            <Criterion ExactMatch="true">
            <HotelRef HotelCityCode="'.$destination.'" ChainCode="'.$chain_code.'" HotelCode="'.$hotel_code.'"/>
            </Criterion>
            </HotelSearchCriteria>';
            if(!is_null($booking_code))
            {
              $request.='
                <RatePlanCandidates>
                  <RatePlanCandidate RatePlanID="'.$booking_code.'"/>
                </RatePlanCandidates>
              ';
            }
            $request.='</AvailRequestSegment>
            </AvailRequestSegments>
            </OTA_HotelAvailRQ>  
          </wmHotelAvail>
        </soap:Body>
      </soap:Envelope>
    ';

      return $request;
  }
  function cancelTicket($pnr){
    $request = "";
    $request .='<?xml version="1.0" encoding="UTF-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Header>
            <TripXML xmlns="http://amadeusws.tripxml.com/TripXML/wsPNRCancel.asmx">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>
          </soap:Header>
          <soap:Body>
          <wmPNRCancel xmlns="http://traveltalk.com/wsPNRCancel">
            <OTA_CancelRQ>
               <POS>
                     <Source PseudoCityCode="MIA1S21AV" ISOCurrency="NGN">
                        <RequestorID Type="21" ID="RubyTravel" />
                     </Source>
                     <TPA_Extensions>
                        <Provider>
                           <Name>Amadeus</Name>
                           <System>Test</System>
                           <Userid>RubyTravel</Userid>
                           <Password>sTeBr+Fr3kEv</Password>
                        </Provider>
                     </TPA_Extensions>
                  </POS>
               <UniqueID ID="'.$pnr.'" />
            </OTA_CancelRQ>
            </wmPNRCancel>
          </soap:Body>
        </soap:Envelope>
    ';
    return $request;
  }
  function cancelTicketCurl($xml_post_string){
    $soapUrl = "http://amadeusws.tripxml.com/TripXML/wsPNRCancel.asmx";
    $headers = array(
        "POST /TripXML/wsPNRCancel.asmx HTTP/1.1",
        "Host: amadeusws.tripxml.com",
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: ". "http://traveltalk.com/wsPNRCancel/wmPNRCancel",
        "Content-Length:" . strlen($xml_post_string)
    );
    $url = $soapUrl;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }
  function issueTicket($pnr){
    $request = "";
    $request .='<?xml version="1.0" encoding="UTF-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Header>
            <TripXML xmlns="http://amadeusws.tripxml.com/TripXML/wsIssueTicket.asmx">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>
          </soap:Header>
          <soap:Body>
          <wmIssueTicket xmlns="http://traveltalk.com/wsIssueTicket">
            <TT_IssueTicketRQ>
             <POS>
                 <Source PseudoCityCode="MIA1S21AV" ISOCurrency="NGN">
                    <RequestorID Type="21" ID="RubyTravel" />
                 </Source>
                 <TPA_Extensions>
                    <Provider>
                       <Name>Amadeus</Name>
                       <System>Test</System>
                       <Userid>RubyTravel</Userid>
                       <Password>sTeBr+Fr3kEv</Password>
                    </Provider>
                 </TPA_Extensions>
              </POS>
             <UniqueID ID="'.$pnr.'" />
             <Ticketing TicketType="eTicket">
              <Notification ByEmail="true"/>
             </Ticketing>
          </TT_IssueTicketRQ>
            </wmIssueTicket>
          </soap:Body>
        </soap:Envelope>
    ';
    return $request;
  }
  function voidTicket($ticket_number){
    $request = "";
    $request.='<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Header>
            <TripXML xmlns="http://amadeusws.tripxml.com/TripXML/wsVoidTicket.asmx">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>
          </soap:Header>
          <soap:Body>
            <wmVoidTicket xmlns="http://traveltalk.com/wsVoidTicket">
              <TT_VoidTicketRQ>';
                  $request.=amadeus_pos();
                $request.='<Tickets>
                  <TicketNumber>'.$ticket_number.'</TicketNumber>
                </Tickets>
                <UniqueID ID="string" />
              </TT_VoidTicketRQ>
            </wmVoidTicket>
          </soap:Body>
        </soap:Envelope>
    ';
    return $request;
  }
  function amadeus_pos(){
    $pos = '
      <POS>
         <Source PseudoCityCode="MIA1S21AV" ISOCurrency="NGN">
            <RequestorID Type="21" ID="RubyTravel" />
         </Source>
         <TPA_Extensions>
            <Provider>
               <Name>Amadeus</Name>
               <System>Test</System>
               <Userid>RubyTravel</Userid>
               <Password>sTeBr+Fr3kEv</Password>
            </Provider>
         </TPA_Extensions>
      </POS>
    ';
    return $pos;
  }
  /*function flightBuild($direction_way, $adult_array, $kid_array, $infant_array, $no_adults, $no_kids, $no_infants, $user_phone_number,$selected_flight_array,$ticket_time_limit){
    $request = '';

    $request.= '<?xml version="1.0" encoding="UTF-8"?>
      <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
       <soap:Header>
          <TripXML xmlns="http://amadeusws.tripxml.com/wsLowFarePlus">
             <userName>string</userName>
             <password>string</password>
             <compressed>boolean</compressed>
          </TripXML>
       </soap:Header>
       <soap:Body>
            <wmTravelBuild xmlns="http://traveltalk.com/wsTravelBuild">
               <OTA_TravelItineraryRQ>'.amadeus_pos() .'
                  <OTA_AirBookRQ>
                     <AirItinerary DirectionInd="'.$direction_way.'">
                        <OriginDestinationOptions>
                          <OriginDestinationOption>';
                          if(isset($selected_flight_array)){
                            for($j = 0; $j < count($selected_flight_array); $j++){
                    $request.='<FlightSegment DepartureDateTime="'.$selected_flight_array[$j]['DepartureDateTime'].'" ArrivalDateTime="'.$selected_flight_array[$j]['ArrivalDateTime'].'" RPH="'.$selected_flight_array[$j]['RPH'].'" FlightNumber="'.$selected_flight_array[$j]['FlightNumber'].'" ResBookDesigCode="'.$selected_flight_array[$j]['ResBookDesigCode'].'" NumberInParty="'.$selected_flight_array[$j]['NumberInParty'].'">
                                 <DepartureAirport LocationCode="'.$selected_flight_array[$j]['DepartureAirportCode'].'" />
                                 <ArrivalAirport LocationCode="'.$selected_flight_array[$j]['ArrivalAirportCode'].'" />
                                 <MarketingAirline Code="'.$selected_flight_array[$j]['FilingAirlineCode'].'" />
                               </FlightSegment>';
                            }
                          }
              $request.='</OriginDestinationOption>
                        </OriginDestinationOptions>
                     </AirItinerary>
                  </OTA_AirBookRQ>
                  <TPA_Extensions>
                     <PNRData>';

                      if($no_adults > 0){
                        for($a = 0; $a < $no_adults; $a++){
                          $request.='<Traveler PassengerTypeCode="ADT" BirthDate="'.$adult_array['date_of_birth'.$a].'">
                           <PersonName>
                              <NamePrefix>'.$adult_array['title'.$a].'</NamePrefix>
                              <GivenName>'.$adult_array['first_name'.$a].'</GivenName>
                              <Surname>'.$adult_array['last_name'.$a].'</Surname>
                              <NameTitle>MD</NameTitle>
                           </PersonName>
                           <TravelerRefNumber RPH="1" />
                        </Traveler>
                        ';
                        }
                      }

                          if($no_kids > 0){
                            for($k = 0; $k < $no_kids; $k++){
                              $request.='<Traveler PassengerTypeCode="CHD" BirthDate="'.$kid_array['date_of_birth'.$k].'">
                               <PersonName>
                                  <NamePrefix>'.$kid_array['title'.$k].'</NamePrefix>
                                  <GivenName>'.$kid_array['first_name'.$k].'</GivenName>
                                  <Surname>'.$kid_array['last_name'.$k].'</Surname>
                                  <NameTitle>MD</NameTitle>
                               </PersonName>
                               <TravelerRefNumber RPH="1" />
                            </Traveler>
                            ';
                            }
                          }
                          if($no_infants > 0){
                            for($i = 0; $i < $no_infants; $i++){
                              $request.='<Traveler PassengerTypeCode="INF" BirthDate="'.$infant_array['date_of_birth'.$i].'">
                               <PersonName>
                                  <NamePrefix>'.$infant_array['title'.$i].'</NamePrefix>
                                  <GivenName>'.$infant_array['first_name'.$i].'</GivenName>
                                  <Surname>'.$infant_array['last_name'.$i].'</Surname>
                                  <NameTitle>MD</NameTitle>
                               </PersonName>
                               <TravelerRefNumber RPH="1" />
                            </Traveler>
                            ';
                            }
                          }
                        $request.='<Telephone PhoneLocationType="Home" CountryAccessCode="234" AreaCityCode="LOS" PhoneNumber="'.$user_phone_number.'" FormattedInd="0" />
                        <Ticketing TicketTimeLimit="'.$ticket_time_limit.'" TicketType="eTicket" />
                     </PNRData>
                     <PriceData PriceType="Published">
                        <PublishedFares>
                           <FareRestrictPref>
                              <AdvResTicketing>
                                 <AdvReservation />
                              </AdvResTicketing>
                              <StayRestrictions>
                                 <MinimumStay />
                                 <MaximumStay />
                              </StayRestrictions>
                              <VoluntaryChanges>
                                 <Penalty />
                              </VoluntaryChanges>
                           </FareRestrictPref>
                        </PublishedFares>
                     </PriceData>
                  </TPA_Extensions>
               </OTA_TravelItineraryRQ>
            </wmTravelBuild>
         </soap:Body>
      </soap:Envelope>

    ';

    return $request;
  }*/
  function flightBuild1($direction_way, $adult_array, $kid_array, $infant_array, $no_adults, $no_kids, $no_infants, $user_phone_number,$selected_flight_array,$ticket_time_limit){
    $request = '';

    $request.= '<?xml version="1.0" encoding="UTF-8"?>
      <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
       <soap:Header>
          <TripXML xmlns="http://amadeusws.tripxml.com/wsLowFarePlus">
             <userName>string</userName>
             <password>string</password>
             <compressed>boolean</compressed>
          </TripXML>
       </soap:Header>
       <soap:Body>
            <wmTravelBuild xmlns="http://traveltalk.com/wsTravelBuild">
               <OTA_TravelItineraryRQ>'.amadeus_pos() .'
                  <OTA_AirBookRQ>
                     <AirItinerary DirectionInd="'.$direction_way.'">
                        <OriginDestinationOptions>';
                          if(isset($selected_flight_array)){
                            if($direction_way == 'OneWay'){
                              $request.='<OriginDestinationOption>';
                              for($c = 0; $c < count($selected_flight_array); $c++){
                                $request.='<FlightSegment DepartureDateTime="'.$selected_flight_array[$c]['DepartureDateTime'].'" ArrivalDateTime="'.$selected_flight_array[$c]['ArrivalDateTime'].'" RPH="'.$selected_flight_array[$c]['RPH'].'" FlightNumber="'.$selected_flight_array[$c]['FlightNumber'].'" ResBookDesigCode="'.$selected_flight_array[$c]['ResBookDesigCode'].'" NumberInParty="'.$selected_flight_array[$c]['NumberInParty'].'">
                                   <DepartureAirport LocationCode="'.$selected_flight_array[$c]['DepartureAirportCode'].'" />
                                   <ArrivalAirport LocationCode="'.$selected_flight_array[$c]['ArrivalAirportCode'].'" />
                                   <MarketingAirline Code="'.$selected_flight_array[$c]['FilingAirlineCode'].'" />
                                 </FlightSegment>';
                              }
                              $request.='</OriginDestinationOption>';
                            }elseif($direction_way == 'Circle'){
                              for($c = 0; $c < count($selected_flight_array); $c++){
                                $request.='<OriginDestinationOption>';
                                  for($d = 0; $d < count($selected_flight_array[$c]); $d++){
                                    $request.='<FlightSegment DepartureDateTime="'.$selected_flight_array[$c][$d]['DepartureDateTime'].'" ArrivalDateTime="'.$selected_flight_array[$c][$d]['ArrivalDateTime'].'" RPH="'.$selected_flight_array[$c][$d]['RPH'].'" FlightNumber="'.$selected_flight_array[$c][$d]['FlightNumber'].'" ResBookDesigCode="'.$selected_flight_array[$c][$d]['ResBookDesigCode'].'" NumberInParty="'.$selected_flight_array[$c][$d]['NumberInParty'].'">
                                       <DepartureAirport LocationCode="'.$selected_flight_array[$c][$d]['DepartureAirportCode'].'" />
                                       <ArrivalAirport LocationCode="'.$selected_flight_array[$c][$d]['ArrivalAirportCode'].'" />
                                       <MarketingAirline Code="'.$selected_flight_array[$c][$d]['FilingAirlineCode'].'" />
                                     </FlightSegment>';
                                  }
                                $request.='</OriginDestinationOption>';
                              }
                            }
                          }
            $request.='</OriginDestinationOptions>
                     </AirItinerary>
                  </OTA_AirBookRQ>
                  <TPA_Extensions>
                     <PNRData>';

                      if($no_adults > 0){
                        for($a = 0; $a < $no_adults; $a++){
                          $request.='<Traveler PassengerTypeCode="ADT" BirthDate="'.$adult_array['date_of_birth'.$a].'">
                           <PersonName>
                              <NamePrefix>'.$adult_array['title'.$a].'</NamePrefix>
                              <GivenName>'.$adult_array['first_name'.$a].'</GivenName>
                              <Surname>'.$adult_array['last_name'.$a].'</Surname>
                              <NameTitle>MD</NameTitle>
                           </PersonName>
                           <TravelerRefNumber RPH="1" />
                        </Traveler> 
                        ';
                        }
                      }

                          if($no_kids > 0){
                            for($k = 0; $k < $no_kids; $k++){
                              $request.='<Traveler PassengerTypeCode="CHD" BirthDate="'.$kid_array['date_of_birth'.$k].'">
                               <PersonName>
                                  <NamePrefix>'.$kid_array['title'.$k].'</NamePrefix>
                                  <GivenName>'.$kid_array['first_name'.$k].'</GivenName>
                                  <Surname>'.$kid_array['last_name'.$k].'</Surname>
                                  <NameTitle>MD</NameTitle>
                               </PersonName>
                               <TravelerRefNumber RPH="1" />
                            </Traveler> 
                            ';
                            }
                          }
                          if($no_infants > 0){
                            for($i = 0; $i < $no_infants; $i++){
                              $request.='<Traveler PassengerTypeCode="INF" BirthDate="'.$infant_array['date_of_birth'.$i].'">
                               <PersonName>
                                  <NamePrefix>'.$infant_array['title'.$i].'</NamePrefix>
                                  <GivenName>'.$infant_array['first_name'.$i].'</GivenName>
                                  <Surname>'.$infant_array['last_name'.$i].'</Surname>
                                  <NameTitle>MD</NameTitle>
                               </PersonName>
                               <TravelerRefNumber RPH="1" />
                            </Traveler> 
                            ';
                            }
                          }
                        $request.='<Telephone PhoneLocationType="Home" CountryAccessCode="234" AreaCityCode="LOS" PhoneNumber="'.$user_phone_number.'" FormattedInd="0" />
                        <Ticketing TicketTimeLimit="'.$ticket_time_limit.'" TicketType="eTicket" />
                     </PNRData>
                     <PriceData PriceType="Published">
                        <PublishedFares>
                           <FareRestrictPref>
                              <AdvResTicketing>
                                 <AdvReservation />
                              </AdvResTicketing>
                              <StayRestrictions>
                                 <MinimumStay />
                                 <MaximumStay />
                              </StayRestrictions>
                              <VoluntaryChanges>
                                 <Penalty />
                              </VoluntaryChanges>
                           </FareRestrictPref>
                        </PublishedFares>
                     </PriceData>
                  </TPA_Extensions>
               </OTA_TravelItineraryRQ>
            </wmTravelBuild>
         </soap:Body>
      </soap:Envelope>
    
    ';

    return $request;
  }
  function issueTicketCurl($xml_post_string){
    $soapUrl = "http://amadeusws.tripxml.com/TripXML/wsIssueTicket.asmx";
    $headers = array(
        "POST /TripXML/wsIssueTicket.asmx HTTP/1.1",
        "Host: amadeusws.tripxml.com",
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: ". "http://traveltalk.com/wsIssueTicket/wmIssueTicket",
        "Content-Length:" . strlen($xml_post_string)
    );
    $url = $soapUrl;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }

  function curl($xml_post_string){
  $soapUrl = "http://amadeusws.tripxml.com/TripXML/wsLowFarePlus.asmx";
  $headers = array(
      "POST /TripXML/wsLowFarePlus.asmx HTTP/1.1",
      "Host: amadeusws.tripxml.com",
      "Content-Type: text/xml; charset=utf-8",
      "SOAPAction: "."http://traveltalk.com/wsLowFarePlus/wmLowFarePlus",
      "Content-Length: ".strlen($xml_post_string)
  );
  $url = $soapUrl;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}
  function queryAmadeus($xml_post_string, $header, $soap_url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $soap_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
  }
  function convertXmlToJson($xml){
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
    return $xml;
  }
  function saveXmlResponse($json_encoded_variable){
    $data = $json_encoded_variable;
    $fileName = time() . '_datafile.json';
    File::put(public_path('/upload/json/'.$fileName),$data);
    return Response::download(public_path('/upload/jsonfile/'.$fileName));
  }
  function flightPriceConvertToNaira($vendor_price){
    return ($vendor_price/100);
  }
  function availableFlights($search_array){
    $final_result = array();
    if(isset($search_array['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS'])){
      $soap_body = $search_array['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS'];
      if(count($soap_body) == 2){
        $flight_error_type = $search_array['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['Errors']['Error'];
        if(is_array($flight_error_type)){
          return flash('<i class="fa fa-times"></i> &nbsp; '.$flight_error_type[0])->error();
        }else{
          return flash('<i class="fa fa-times"></i> &nbsp; '.$flight_error_type)->error();
        }
      }elseif(count($soap_body) == 3){
        if(isset($soap_body['PricedItineraries']['PricedItinerary'])){
          $itinerary = $soap_body['PricedItineraries']['PricedItinerary'];
          if(isset($itinerary[0])){
            for ($i = 0; $i < count($itinerary); $i++) {
                $result = array();
                $direction_data = array();
                $individual_fare_data = array();
                $other_data = array();
                $other_datum = array();
                $direction_datum = array();
                $search_parameters = Session::get('search_parameters');
                $direction_datum['direction_type'] = $itinerary[$i]['AirItinerary']['@attributes']['DirectionInd'];
                array_push($direction_data, $direction_datum);
              if(isset($itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'][0])){
                //This wont be useful later
                $origin_destinations = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'][0];
                if(count($origin_destinations) == 2){
                  for($o = 0; $o < count($origin_destinations); $o++){
                    if(isset($itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'][0]['FlightSegment'][$o])) {
                      $flight_segment_size = count($itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'][$o]['FlightSegment']);
                      $seg = 0;
                      for ($j = 0; $j < $flight_segment_size; $j++) {
                        $flight_datum = array();
                        $fare_info = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'];
                        $flight_information = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'][$o]['FlightSegment'][$j];

                        $flight_datum['departure_date_time'] = $flight_information['@attributes']['DepartureDateTime'];
                        $flight_datum['arrival_date_time'] = $flight_information['@attributes']['ArrivalDateTime'];
                        $flight_datum['departure_airport'] = $flight_information['DepartureAirport'];
                        $flight_datum['arrival_airport'] = $flight_information['ArrivalAirport'];
                        $flight_datum['RPH'] = $flight_information['@attributes']['RPH'];
                        $flight_datum['flight_number'] = $flight_information['@attributes']['FlightNumber'];
                        $flight_datum['ResBookDesigCode'] = $flight_information['@attributes']['ResBookDesigCode'];
                        $flight_datum['NumberInParty'] = $flight_information['@attributes']['NumberInParty'];
                        $flight_datum['operating_airline'] = $flight_information['OperatingAirline'];
                        $flight_datum['cabin'] = $flight_information['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                        $flight_datum['journey_total_duration'] = $flight_information['TPA_Extensions']['JourneyTotalDuration'];
                        $flight_datum['journey_duration'] = $flight_information['TPA_Extensions']['JourneyDuration'];
                        $flight_datum['code'] = $fare_info[$seg]['FilingAirline']['@attributes']['Code'];
                        $flight_datum['departure_airport_code'] = $fare_info[$seg]['DepartureAirport']['@attributes']['LocationCode'];
                        $flight_datum['arrival_airport_code'] = $fare_info[$seg]['ArrivalAirport']['@attributes']['LocationCode'];
                        $seg =  $seg + 1;
                        array_push($flight_data, $flight_datum);
                      }

                      $other_datum['flight_code'] = $itinerary['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'];
                      $other_datum['flight_total_fare'] = flightPriceConvertToNaira($itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount']);
                      $other_datum['amount_decimal_place'] = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['DecimalPlaces'];
                      $other_datum['ticket_time_limit'] = $itinerary['TicketingInfo']['@attributes']['TicketTimeLimit'];

                      $individual_fares = $itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                      if(isset($individual_fares[0])){
                        for($m = 0; $m < count($individual_fares); $m++){
                          $individual_fare = array();
                          $individual_fare['name_type'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Code'];
                          $individual_fare['quantity'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Quantity'];
                          $individual_fare['total_fare'] = $individual_fares[$m]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                          array_push($individual_fare_data, $individual_fare);
                        }
                      }else{
                        $individual_fare['name_type'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Code'];
                        $individual_fare['quantity'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Quantity'];
                        $individual_fare['total_fare'] = $individual_fares['PassengerFare']['TotalFare']['@attributes']['Amount'];
                        array_push($individual_fare_data, $individual_fare);
                      }
                      array_push($other_data, $other_datum);
                    }
                    else{
                      $flight_data = array();
                      $flight_datum = array();
                      $flight_information = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'][$o]['FlightSegment'];
                      $fare_info = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'];
                      $flight_datum['departure_date_time'] = $flight_information['@attributes']['DepartureDateTime'];
                      $flight_datum['arrival_date_time'] = $flight_information['@attributes']['ArrivalDateTime'];
                      $flight_datum['departure_airport'] = $flight_information['DepartureAirport'];
                      $flight_datum['arrival_airport'] = $flight_information['ArrivalAirport'];
                      $flight_datum['RPH'] = $flight_information['@attributes']['RPH'];
                      $flight_datum['flight_number'] = $flight_information['@attributes']['FlightNumber'];
                      $flight_datum['ResBookDesigCode'] = $flight_information['@attributes']['ResBookDesigCode'];
                      $flight_datum['NumberInParty'] = $flight_information['@attributes']['NumberInParty'];
                      $flight_datum['operating_airline'] = $flight_information['OperatingAirline'];
                      $flight_datum['cabin'] = $flight_information['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                      $flight_datum['journey_total_duration'] = $flight_information['TPA_Extensions']['JourneyTotalDuration'];
                      $flight_datum['journey_duration'] = $flight_information['TPA_Extensions']['JourneyDuration'];

                      if($search_parameters[7] > 0 || $search_parameters[8] > 0){
                        $fare_info = $fare_info[0];
                      }
                      $flight_datum['code'] = $fare_info['FilingAirline']['@attributes']['Code'];
                      $flight_datum['departure_airport_code'] = $fare_info['DepartureAirport']['@attributes']['LocationCode'];
                      $flight_datum['arrival_airport_code'] = $fare_info['ArrivalAirport']['@attributes']['LocationCode'];

                      array_push($flight_data, $flight_datum);

                      $other_datum['flight_code'] = $itinerary['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'];
                      $other_datum['flight_total_fare'] = flightPriceConvertToNaira($itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount']);
                      $other_datum['amount_decimal_place'] = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['DecimalPlaces'];
                      $other_datum['ticket_time_limit'] = $itinerary['TicketingInfo']['@attributes']['TicketTimeLimit'];
                      array_push($other_data, $other_datum);

                      $individual_fares = $itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                      if(isset($individual_fares[0])){
                        for($m = 0; $m < count($individual_fares); $m++){
                          $individual_fare = array();
                          $individual_fare['name_type'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Code'];
                          $individual_fare['quantity'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Quantity'];
                          $individual_fare['total_fare'] = $individual_fares[$m]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                          array_push($individual_fare_data, $individual_fare);
                        }
                      }else{
                        $individual_fare['name_type'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Code'];
                        $individual_fare['quantity'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Quantity'];
                        $individual_fare['total_fare'] = $individual_fares['PassengerFare']['TotalFare']['@attributes']['Amount'];
                        array_push($individual_fare_data, $individual_fare);
                      }

                    }
                  }
                }
              }
              else{
                $flight_data = array();
                if(isset($itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption']['FlightSegment'][0])) {
                  $flight_segment_size = count($itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption']['FlightSegment']);
                  $seg = 0;
                  for ($j = 0; $j < $flight_segment_size; $j++) {
                    $flight_datum = array();
                    $fare_info = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'];
                    $flight_information = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption']['FlightSegment'][$j];

                    $flight_datum['departure_date_time'] = $flight_information['@attributes']['DepartureDateTime'];
                    $flight_datum['arrival_date_time'] = $flight_information['@attributes']['ArrivalDateTime'];
                    $flight_datum['departure_airport'] = $flight_information['DepartureAirport'];
                    $flight_datum['arrival_airport'] = $flight_information['ArrivalAirport'];
                    $flight_datum['RPH'] = $flight_information['@attributes']['RPH'];
                    $flight_datum['flight_number'] = $flight_information['@attributes']['FlightNumber'];
                    $flight_datum['ResBookDesigCode'] = $flight_information['@attributes']['ResBookDesigCode'];
                    $flight_datum['NumberInParty'] = $flight_information['@attributes']['NumberInParty'];
                    $flight_datum['operating_airline'] = $flight_information['OperatingAirline'];
                    $flight_datum['cabin'] = $flight_information['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                    $flight_datum['journey_total_duration'] = $flight_information['TPA_Extensions']['JourneyTotalDuration'];
                    $flight_datum['journey_duration'] = $flight_information['TPA_Extensions']['JourneyDuration'];
                    $flight_datum['code'] = $fare_info[$seg]['FilingAirline']['@attributes']['Code'];
                    $flight_datum['departure_airport_code'] = $fare_info[$seg]['DepartureAirport']['@attributes']['LocationCode'];
                    $flight_datum['arrival_airport_code'] = $fare_info[$seg]['ArrivalAirport']['@attributes']['LocationCode'];
                    $seg =  $seg + 1;
                    array_push($flight_data, $flight_datum);
                  }

                  $other_datum['flight_code'] = $itinerary['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'];
                  $other_datum['flight_total_fare'] = flightPriceConvertToNaira($itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount']);
                  $other_datum['amount_decimal_place'] = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['DecimalPlaces'];
                  $other_datum['ticket_time_limit'] = $itinerary['TicketingInfo']['@attributes']['TicketTimeLimit'];

                  $individual_fares = $itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                  if(isset($individual_fares[0])){
                    for($m = 0; $m < count($individual_fares); $m++){
                      $individual_fare = array();
                      $individual_fare['name_type'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Code'];
                      $individual_fare['quantity'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Quantity'];
                      $individual_fare['total_fare'] = $individual_fares[$m]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                      array_push($individual_fare_data, $individual_fare);
                    }
                  }else{
                    $individual_fare['name_type'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Code'];
                    $individual_fare['quantity'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Quantity'];
                    $individual_fare['total_fare'] = $individual_fares['PassengerFare']['TotalFare']['@attributes']['Amount'];
                    array_push($individual_fare_data, $individual_fare);
                  }
                  array_push($other_data, $other_datum);
                }
                elseif(isset($itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption']['FlightSegment']['@attributes'])){
//                  $flight_data = array();
                  $flight_datum = array();
                  $flight_information = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption']['FlightSegment'];
                  $fare_info = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'];
                  $flight_datum['departure_date_time'] = $flight_information['@attributes']['DepartureDateTime'];
                  $flight_datum['arrival_date_time'] = $flight_information['@attributes']['ArrivalDateTime'];
                  $flight_datum['departure_airport'] = $flight_information['DepartureAirport'];
                  $flight_datum['arrival_airport'] = $flight_information['ArrivalAirport'];
                  $flight_datum['RPH'] = $flight_information['@attributes']['RPH'];
                  $flight_datum['flight_number'] = $flight_information['@attributes']['FlightNumber'];
                  $flight_datum['ResBookDesigCode'] = $flight_information['@attributes']['ResBookDesigCode'];
                  $flight_datum['NumberInParty'] = $flight_information['@attributes']['NumberInParty'];
                  $flight_datum['operating_airline'] = $flight_information['OperatingAirline'];
                  $flight_datum['cabin'] = $flight_information['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                  $flight_datum['journey_total_duration'] = $flight_information['TPA_Extensions']['JourneyTotalDuration'];
                  $flight_datum['journey_duration'] = $flight_information['TPA_Extensions']['JourneyDuration'];

                  if($search_parameters[7] > 0 || $search_parameters[8] > 0){
                    $fare_info = $fare_info[0];
                  }
                  $flight_datum['code'] = $fare_info['FilingAirline']['@attributes']['Code'];
                  $flight_datum['departure_airport_code'] = $fare_info['DepartureAirport']['@attributes']['LocationCode'];
                  $flight_datum['arrival_airport_code'] = $fare_info['ArrivalAirport']['@attributes']['LocationCode'];

                  array_push($flight_data, $flight_datum);

                  $other_datum['flight_code'] = $itinerary['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'];
                  $other_datum['flight_total_fare'] = flightPriceConvertToNaira($itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount']);
                  $other_datum['amount_decimal_place'] = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['DecimalPlaces'];
                  $other_datum['ticket_time_limit'] = $itinerary['TicketingInfo']['@attributes']['TicketTimeLimit'];
                  array_push($other_data, $other_datum);

                  $individual_fares = $itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                  if(isset($individual_fares[0])){
                    for($m = 0; $m < count($individual_fares); $m++){
                      $individual_fare = array();
                      $individual_fare['name_type'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Code'];
                      $individual_fare['quantity'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Quantity'];
                      $individual_fare['total_fare'] = $individual_fares[$m]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                      array_push($individual_fare_data, $individual_fare);
                    }
                  }else{
                    $individual_fare['name_type'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Code'];
                    $individual_fare['quantity'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Quantity'];
                    $individual_fare['total_fare'] = $individual_fares['PassengerFare']['TotalFare']['@attributes']['Amount'];
                    array_push($individual_fare_data, $individual_fare);
                  }

                }
              }
                array_push($result, $direction_data);
                array_push($result, $flight_data);
                array_push($result, $other_data);
                array_push($result, $individual_fare_data);
                array_push($final_result, $result);
              }
          }
          else{
            return false;
          }
        }
      }

    }
    return $final_result;
  }
  function availableHotels($search_array){
    $rooms = array();
    if(isset($search_array['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS'])){

      $response = $search_array['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS'];
      $response_size = count($search_array['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS']);
      if($response_size == 2){

      }elseif($response_size == 3){
        if(isset($response['RoomStays'])){
          if(count($response['RoomStays']) > 0){
            if(isset($response['RoomStays']['RoomStay'])){
              $available_rooms = $response['RoomStays']['RoomStay'];
              if(count($available_rooms) > 0){

                for($i = 0; $i < count($available_rooms); $i++){
                  $room_details = array();
                  $room_details['MinimumRate'] = $available_rooms[$i]['RatePlans']['RatePlan']['AdditionalDetails']['AdditionalDetail'][0]['@attributes']['Amount'];
                  $room_details['NumberOfUnits'] = $available_rooms[$i]['RoomRates']['RoomRate']['@attributes']['NumberOfUnits'];
                  $room_details['GuestCounts'] = $available_rooms[$i]['GuestCounts']['GuestCount']['@attributes']['Count'];
                  $room_details['StartDate'] = $available_rooms[$i]['TimeSpan']['@attributes']['Start'];
                  $room_details['EndDate'] = $available_rooms[$i]['TimeSpan']['@attributes']['End'];
                  $room_details['ChainCode'] = $available_rooms[$i]['BasicPropertyInfo']['@attributes']['ChainCode'];
                  $room_details['HotelCode'] = $available_rooms[$i]['BasicPropertyInfo']['@attributes']['HotelCode'];
                  $room_details['HotelCityCode'] = $available_rooms[$i]['BasicPropertyInfo']['@attributes']['HotelCityCode'];
                  $room_details['HotelName'] = $available_rooms[$i]['BasicPropertyInfo']['@attributes']['HotelName'];
                  $room_details['HotelCodeContext'] = $available_rooms[$i]['BasicPropertyInfo']['@attributes']['HotelCodeContext'];
                  /*if(isset($available_rooms[$i]['BasicPropertyInfo']['VendorMessages']['VendorMessage'][0]['SubSection']['Paragraph']['URL'][0])){
                    $room_details['Url'] = $available_rooms[$i]['BasicPropertyInfo']['VendorMessages']['VendorMessage'][0]['SubSection']['Paragraph']['URL'][0];
                  }else{*/
                    $room_details['Url'] = $available_rooms[$i]['BasicPropertyInfo']['VendorMessages']['VendorMessage'][0]['SubSection']['Paragraph']['URL'];
//                  }
                  $room_details['ChainName'] = $available_rooms[$i]['BasicPropertyInfo']['@attributes']['ChainName'];
                  if(isset($available_rooms[$i]['BasicPropertyInfo']['Address'])){
                    $room_details['AddressLine'] = $available_rooms[$i]['BasicPropertyInfo']['Address']['AddressLine'];
                    if(isset($available_rooms[$i]['BasicPropertyInfo']['Address']['CityName'])){
                      $room_details['CityName'] = $available_rooms[$i]['BasicPropertyInfo']['Address']['CityName'];
                    }else{
                      $room_details['CityName'] = '';
                    }
                    $room_details['CountryCode'] = $available_rooms[$i]['BasicPropertyInfo']['Address']['CountryName']['@attributes']['Code'];
                  }else{
                    $room_details['AddressLine'] = 'no address available';
                    $room_details['CityName'] = '';
                    $room_details['CountryCode'] = '';
                  }

                  if(isset($available_rooms[$i]['BasicPropertyInfo']['Award'])){
                    $star_rating_size = count($available_rooms[$i]['BasicPropertyInfo']['Award']);
                    if($star_rating_size == 1){
                      if($available_rooms[$i]['BasicPropertyInfo']['Award']['@attributes']['Provider'] == 'Local Star Rating'){
                        $room_details['StarRating'] = $available_rooms[$i]['BasicPropertyInfo']['Award']['@attributes']['Rating'];
                      }else{
                        $room_details['StarRating'] = 0;
                      }
                    }elseif($star_rating_size > 1){
                      for($r = 0; $r < $star_rating_size; $r++){
                        if($available_rooms[$i]['BasicPropertyInfo']['Award'][$r]['@attributes']['Provider'] == 'Local Star Rating'){
                          $room_details['StarRating'] = $available_rooms[$i]['BasicPropertyInfo']['Award'][$r]['@attributes']['Rating'];
                        }else{
                          $room_details['StarRating'] = 0;
                        }
                      }
                    }
                  }
                  else{
                    $room_details['StarRating'] = 0;
                  }
                  array_push($rooms, $room_details);
                }
              }
            }
          }elseif(count($response['RoomStays']) == 0){
            flash('<i class="fa fa-times"></i> &nbsp; No results found. try again')->error();
            return back();
          }
        }
      }
    }
    return $rooms;
  }
  function hotelDetails($search_array){
    $result = array();
    if(isset($search_array['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS'])){
      $hotel_details = $search_array['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS'];

      if(count($hotel_details) == 2){
        $error_message = $hotel_details['Errors']['Error'];
        $result['error'] = $error_message;
        flash('<i class="fa fa-times"></i> '.$error_message)->error();
        return $result;
      }elseif(count($hotel_details) > 2){
        if(isset($hotel_details['RoomStays'])){
          $room_stay = $hotel_details['RoomStays']['RoomStay'];
          if(isset($room_stay)){
            if(isset($room_stay['RoomTypes'])){
              if(isset($room_stay['RoomTypes']['RoomType']['Amenities']['Amenity'])){
                $amenities = $room_stay['RoomTypes']['RoomType']['Amenities']['Amenity'];
                if(count($amenities) > 1){
                  for($a = 0; $a < count($amenities); $a++){
                    $amenity = array();
                    $amenity['amenity'] = $amenities;
                  }
                }
                else{
                  $amenity = array();
                  $amenity['amenity'] = $amenities;
                }
                array_push($result, $amenity);
              }else{
                $amenity = array();
                $amenity['amenity'] = 'No amenities available';
                array_push($result, $amenity);
              }

            }
            else{
              $amenity = array();
              $amenity['amenity'] = 'No amenities available';
              array_push($result, $amenity);
            }

            if(isset($room_stay['RatePlans'])){
              $rate_plan = $room_stay['RatePlans']['RatePlan'];
              if(isset($rate_plan[0])){
                $rooms = array();
                for($r = 0; $r < count($rate_plan); $r++){
                  $room = array();
                  /*********************************************************************/
                  $room['BookingCode'] = $rate_plan[$r]['@attributes']['BookingCode'];
                  $room['RatePlanCode'] = $rate_plan[$r]['@attributes']['RatePlanCode'];
                  /**********************************************************************/

                  $additional_details = $rate_plan[$r]['AdditionalDetails']['AdditionalDetail'];
                  if(isset($additional_details)){
                    if(isset($additional_details[0]['DetailDescription']['Text'][0], $additional_details[0]['DetailDescription']['Text'][1],$additional_details[0]['DetailDescription']['Text'][2])){
                      $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0]. " " .$additional_details[0]['DetailDescription']['Text'][1]. " " .$additional_details[0]['DetailDescription']['Text'][2];
                    }elseif(isset($additional_details[0]['DetailDescription']['Text'][0], $additional_details[0]['DetailDescription']['Text'][1])){
                      $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0]. " " .$additional_details[0]['DetailDescription']['Text'][1];
                    }elseif(isset($additional_details[0]['DetailDescription']['Text'][0])){
                      $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0];
                    }
//                    $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0]. " " .$additional_details[0]['DetailDescription']['Text'][1]. " " .$additional_details[0]['DetailDescription']['Text'][2];
                    $room['RoomType'] = $additional_details[1]['DetailDescription']['@attributes']['Name'];
                    $room['NumberOfBeds'] = $additional_details[2]['DetailDescription']['@attributes']['Name'];
                    $room['BedType'] = $additional_details[3]['DetailDescription']['@attributes']['Name'];
                  }else{
                    //Say something
                  }
                  array_push($rooms, $room);
                }
                array_push($result, $rooms);
              }
              else{
                $rooms = array();
                $room = array();
                /*********************************************************************/
                $room['BookingCode'] = $rate_plan['@attributes']['BookingCode'];
                $room['RatePlanCode'] = $rate_plan['@attributes']['RatePlanCode'];
                /**********************************************************************/

                $additional_details = $rate_plan['AdditionalDetails']['AdditionalDetail'];
                if(isset($additional_details)){
                  if(isset($additional_details[0]['DetailDescription']['Text'][0], $additional_details[0]['DetailDescription']['Text'][1],$additional_details[0]['DetailDescription']['Text'][2])){
                    $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0]. " " .$additional_details[0]['DetailDescription']['Text'][1]. " " .$additional_details[0]['DetailDescription']['Text'][2];
                  }elseif(isset($additional_details[0]['DetailDescription']['Text'][0], $additional_details[0]['DetailDescription']['Text'][1])){
                    $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0]. " " .$additional_details[0]['DetailDescription']['Text'][1];
                  }elseif(isset($additional_details[0]['DetailDescription']['Text'][0])){
                    $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0];
                  }
//                  $room['RoomDescription'] = $additional_details[0]['DetailDescription']['Text'][0]. " " .$additional_details[0]['DetailDescription']['Text'][1]. " " .$additional_details[0]['DetailDescription']['Text'][2];
                  $room['RoomType'] = $additional_details[1]['DetailDescription']['@attributes']['Name'];
                  $room['NumberOfBeds'] = $additional_details[2]['DetailDescription']['@attributes']['Name'];
                  $room['BedType'] = $additional_details[3]['DetailDescription']['@attributes']['Name'];
                }else{
                  $room['RoomType'] = "";
                  $room['NumberOfBeds'] = "";
                  $room['BedType'] = "";
                }
                array_push($rooms, $room);
                array_push($result, $rooms);
              }
            }
            else{
              $rooms = array();
              $rooms[0] = "no rate available";
              array_push($result, $rooms);
            }

            if(isset($room_stay['RoomRates']['RoomRate'])){
              $room_rates = $room_stay['RoomRates']['RoomRate'];
              if(isset($room_rates[0])){
                $total = array();
                for($c = 0; $c < count($room_rates); $c++){
                  $price = array();
                  $rate = $room_rates[$c]['Rates']['Rate'];
                  $price['BookingCode'] = $room_stay['RatePlans']['RatePlan'][$c]['@attributes']['BookingCode'];
                  if(isset($rate[0])){
                    for($h = 0; $h < count($rate); $h++){
                      $pricing = array();
                      $pricing['EffectiveDate'] =  $rate[$h]['@attributes']['EffectiveDate'];
                      $pricing['ExpireDate'] =  $rate[$h]['@attributes']['ExpireDate'];
                      $pricing['AmountBeforeTax'] =  $rate[$h]['Base']['@attributes']['AmountBeforeTax'];
                      if(isset($rate[$h]['Total']['@attributes']['AmountAfterTax'])){
                        $pricing['AmountAfterTax'] =  $rate[$h]['Total']['@attributes']['AmountAfterTax'];
                      }
                      array_push($price, $pricing);
                    }
                  }else{
                    $pricing = array();
                    $pricing['EffectiveDate'] =  $rate['@attributes']['EffectiveDate'];
                    $pricing['ExpireDate'] =  $rate['@attributes']['ExpireDate'];
                    $pricing['AmountBeforeTax'] =  $rate['Base']['@attributes']['AmountBeforeTax'];
                    if(isset($rate['Total']['@attributes']['AmountAfterTax'])){
                      $pricing['AmountAfterTax'] =  $rate['Total']['@attributes']['AmountAfterTax'];
                    }
                    array_push($price, $pricing);
                  }
                  array_push($total, $price);
                }
                array_push($result, $total);
              }else{
                  $price = array();
                  $total = array();
                  $rate = $room_rates['Rates']['Rate'];
                  if(isset($rate[0])){
                    for($h = 0; $h < count($rate); $h++){
                      $pricing = array();
                      $pricing['EffectiveDate'] =  $rate[$h]['@attributes']['EffectiveDate'];
                      $pricing['ExpireDate'] =  $rate[$h]['@attributes']['ExpireDate'];
                      $pricing['AmountBeforeTax'] =  $rate[$h]['Base']['@attributes']['AmountBeforeTax'];
                      if(isset($rate[$h]['Total']['@attributes']['AmountAfterTax'])){
                        $pricing['AmountAfterTax'] =  $rate[$h]['Total']['@attributes']['AmountAfterTax'];
                      }
                      array_push($price, $pricing);
                    }
                    array_push($total, $price);
                  }else{
                    $pricing = array();
                    $pricing['EffectiveDate'] =  $rate['@attributes']['EffectiveDate'];
                    $pricing['ExpireDate'] =  $rate['@attributes']['ExpireDate'];
                    $pricing['AmountBeforeTax'] =  $rate['Base']['@attributes']['AmountBeforeTax'];
                    if(isset($rate['Total']['@attributes']['AmountAfterTax'])){
                      $pricing['AmountAfterTax'] =  $rate['Total']['@attributes']['AmountAfterTax'];
                    }
                    array_push($price, $pricing);
                  }
                  array_push($total, $price);

                array_push($result, $total);
              }
            }
            else{
              $total = array();
              $total = "no prices available";
              array_push($result, $total);
            }


            if(isset($room_stay['GuestCounts']['GuestCount'])){
              $guest_count = $room_stay['GuestCounts']['GuestCount'];
              $number_of_guest = array();
              $number_of_guest['GuestCount'] = $guest_count['@attributes']['Count'];
            }
            else{
              $number_of_guest = array();
              $number_of_guest['GuestCount'] = "";
            }
            array_push($result, $number_of_guest);

            if(isset($room_stay['TimeSpan'])){
              $time_span = $room_stay['TimeSpan']['@attributes'];
              $check_dates = array();
              $check_dates['Start'] = $time_span['Start'];
              $check_dates['End'] = $time_span['End'];
            }
            else{
              $check_dates = array();
              $check_dates['Start'] = "";
              $check_dates['End'] = "";
            }
            array_push($result, $check_dates);


            if(isset($room_stay['BasicPropertyInfo'])){
              $basic_property_info = $room_stay['BasicPropertyInfo'];
              if(isset($basic_property_info['@attributes'])){
                $search_parameters = array();
                $search_parameters['ChainCode'] = $basic_property_info['@attributes']['ChainCode'];
                $search_parameters['HotelCode'] = $basic_property_info['@attributes']['HotelCode'];
                $search_parameters['HotelCityCode'] = $basic_property_info['@attributes']['HotelCityCode'];
                $search_parameters['HotelName'] = $basic_property_info['@attributes']['HotelName'];
                $search_parameters['HotelCodeContext'] = $basic_property_info['@attributes']['HotelCodeContext'];
                $search_parameters['ChainName'] = $basic_property_info['@attributes']['ChainName'];
              }else{
                $search_parameters = array();
                $search_parameters['ChainCode'] = "";
                $search_parameters['HotelCode'] = "";
                $search_parameters['HotelCityCode'] = "";
                $search_parameters['HotelName'] = "";
                $search_parameters['HotelCodeContext'] = "";
                $search_parameters['ChainName'] = "";
              }
              array_push($result, $search_parameters);

              if(isset($basic_property_info['VendorMessages'])){
                $vendor_messages = $basic_property_info['VendorMessages'];
                if(isset($vendor_messages['VendorMessage'])){
                  $vendor_message = $vendor_messages['VendorMessage'];
                  $hotel_image = array();
                  $images = array();
                  $hotel_infos = array();
                  $hotel_image['HotelMainImageName'] = $vendor_message[0]['SubSection']['Paragraph']['@attributes']['Name'];
                  $hotel_image['HotelMainImage'] = $vendor_message[0]['SubSection']['Paragraph']['URL'];
                  array_push($images, $hotel_image);
                  $hotel_images = $vendor_message[1]['SubSection']['Paragraph'];
                  if(isset($hotel_images[0]))
                  {
                    for($d = 0; $d < count($hotel_images); $d++){
                      $image = array();
                      $image['Name'] = $hotel_images[$d]['@attributes']['Name'];
                      $image['Url'] = $hotel_images[$d]['URL'];
                      array_push($images, $image);
                    }
                  }
                  else
                  {
                      $image = array();
                      $image['Name'] = $hotel_images['@attributes']['Name'];
                      $image['Url'] = $hotel_images['URL'];
                      array_push($images, $image);
                  }


                  if(isset($vendor_message[2]['SubSection'])){
                    $hotel_information = $vendor_message[2]['SubSection'];
                    if(isset($hotel_information[0])){
                      for($z = 0; $z < count($hotel_information); $z++) {
                        $hotel_info = array();
                        if (isset($hotel_information[$z]['@attributes']['SubTitle'])) {
                          $hotel_info['SubTitle'] = $hotel_information[$z]['@attributes']['SubTitle'];
                          $hotel_info['Information'] = $hotel_information[$z]['Paragraph']['Text'];
                          array_push($hotel_infos, $hotel_info);
                        } else {
                          $hotel_info['SubTitle'] = "";
                          $hotel_info['Information'] = "";
                          array_push($hotel_infos, $hotel_info);
                        }
                      }
                    }
                  }
                }else{
                  $image = array();
                  $images = array();
                  $image[0] = "No image available";
                  array_push($images, $image);
                }
              }else{
                $image = array();
                $images = array();
                $image[0] = "No image available";
                array_push($images, $image);
              }
              array_push($result, $images);
              array_push($result, $hotel_infos);

              if(isset($basic_property_info['Address'])){
                $addresses = array();
                $addresse = array();
                $address = $basic_property_info['Address'];
                $address_line = $address['AddressLine'];

                if(count($address_line) > 1){
                  for($e = 0; $e < count($address_line); $e++){
                    $add = array();
                    $add['address'] = $address_line[$e];
                    array_push($addresse, $add);
                  }
                }else{
                  $add = array();
                  $add['address'] = $address['AddressLine'];
                  array_push($addresse, $add);
                }
                array_push($addresses, $addresse);
                if(isset($address['CityName'])){
                  $addresses['CityName'] = $address['CityName'];
                }else{
                  $addresses['CityName'] = "";
                }
                if(isset($address['PostalCode'])){
                  $addresses['PostalCode'] = $address['PostalCode'];
                }else{
                  $addresses['PostalCode'] = "";
                }
                if(isset($address['CountryName']['@attributes']['Code'])){
                  $addresses['CountryName'] = $address['CountryName']['@attributes']['Code'];
                }else{
                  $addresses['CountryName'] = "";
                }
              }else{
                $addresses = array();
                $addresses["address"] = "No address available";
                $addresses['CountryName'] = "";
                $addresses['PostalCode'] = "";
                $addresses['CityName'] = "";
              }
              array_push($result, $addresses);

              if(isset($basic_property_info['ContactNumbers'])){
                $contact_numbers = $basic_property_info['ContactNumbers'];
                $contacts = array();
                if(is_array($contact_numbers['ContactNumber'])){
                  $contact_nos = $contact_numbers['ContactNumber'];
                  for($f = 0; $f < count($contact_nos); $f++){
                    $contact = array();
                    $contact['PhoneNumber'] = $contact_nos[$f]['@attributes']['PhoneNumber'];
                    array_push($contacts, $contact);
                  }
                }else{
                  $contact_nos = $contact_numbers['ContactNumber'];
                  $contact = array();
                  $contact['PhoneNumber'] = $contact_nos['@attributes']['PhoneNumber'];
                  array_push($contacts, $contact);
                }
              }else{
                $contact = array();
                $contacts = array();
                $contact['PhoneNumber'] = "None available";
                array_push($contacts, $contact);
              }
              array_push($result, $contacts);

              if(isset($basic_property_info['HotelAmenity'])){
                $home_amenities = $basic_property_info['HotelAmenity'];
                $amenities_home = array();
                if(count($home_amenities) > 1){
                  for($g = 0; $g < count($home_amenities); $g++){
                    $home_amenity = array();
                    $home_amenity['homeAmenity'] = $home_amenities[$g];
                    array_push($amenities_home, $home_amenity);
                  }
                }else{
                  $home_amenity = array();
                  $home_amenity['homeAmenity'] = $home_amenities[0];
                  array_push($amenities_home, $home_amenity);
                }
              }else{
                $amenities_home = array();
                $home_amenity = array();
                $home_amenity['homeAmenity'] = "No home amenities available";
                array_push($amenities_home, $home_amenity);
              }
              array_push($result, $amenities_home);

            }
            else{

            }
          }
        }
      }
      return $result;
    }
  }
  function getTotalFare($original_fare){
    if(getAuthenticatedUserRoleId() == CUSTOMER_ROLE_ID){
      $total_fare =  \App\AdminMarkup::getFlightMarkupByRoleId($original_fare) + $original_fare + \App\Vat::getFlightVat($original_fare);
      return $total_fare;
    }elseif (getAuthenticatedUserRoleId() == AGENT_ROLE_ID) {
      $total_fare = \App\AdminMarkup::getFlightMarkupByRoleId($original_fare) + \App\AgentMarkup::getFlightMarkupPrice($original_fare) + $original_fare + \App\Vat::getFlightVat($original_fare);
      return $total_fare;
    }
  }
  function getTotalTax($original_fare){
    if(getAuthenticatedUserRoleId() == CUSTOMER_ROLE_ID){
      $total_tax =  \App\AdminMarkup::getFlightMarkupByRoleId($original_fare);
      return number_format($total_tax);
    }elseif (getAuthenticatedUserRoleId() == AGENT_ROLE_ID) {
      $total_tax = \App\AdminMarkup::getFlightMarkupByRoleId($original_fare) + \App\AgentMarkup::getFlightMarkupPrice($original_fare);
      return number_format($total_tax);
    }
  }
  function guarantee(){
    $guarantee = '
      <Guarantee GuaranteeType="CC">
                   <GuaranteesAccepted>
                   <GuaranteeAccepted>
                   <PaymentCard CardType="Credit" CardCode="VI" CardNumber="4444333322221111" ExpireDate="0520">
                   <CardHolderName>JOHN SMITH</CardHolderName>
                   <Address FormattedInd="0" Type="Home">
                   <StreetNmbr>7300 NORTH KENDALL DRIVE</StreetNmbr>
                   <CityName>MIAMI</CityName>
                   <PostalCode>33156</PostalCode>
                   <StateProv>FL</StateProv>
                   <CountryName>USA</CountryName>
                   </Address>
                   </PaymentCard>
                   </GuaranteeAccepted>
                   </GuaranteesAccepted>
                   </Guarantee>
    ';
    return $guarantee;
  }
  function depositPayment(){
    $deposit_payment = '
      <DepositPayments>
       <RequiredPayment>
       <AcceptedPayments>
       <AcceptedPayment>
       <PaymentCard CardType="Credit" CardCode="VI" CardNumber="4444333322221111" ExpireDate="0520">
       <CardHolderName>JOHN SMITH</CardHolderName>
       <Address FormattedInd="0" Type="Home">
       <StreetNmbr>7300 NORTH KENDALL DRIVE</StreetNmbr>
       <CityName>MIAMI</CityName>
       <PostalCode>33156</PostalCode>
       <StateProv>FL</StateProv>
       <CountryName>USA</CountryName>
       </Address>
       </PaymentCard>
       </AcceptedPayment>
       </AcceptedPayments>
       </RequiredPayment>
     </DepositPayments> 
    ';
    return $deposit_payment;
  }
  function getHotelTotalFare($original_fare){
    if(getAuthenticatedUserRoleId() == CUSTOMER_ROLE_ID){
      $total_fare =  \App\AdminMarkup::getHotelMarkupByRoleId($original_fare) + $original_fare + \App\Vat::getHotelVat($original_fare);
      return $total_fare;
    }elseif (getAuthenticatedUserRoleId() == AGENT_ROLE_ID) {
      $total_fare = \App\AdminMarkup::getHotelMarkupByRoleId($original_fare) + \App\AgentMarkup::getHotelMarkupPrice($original_fare) + $original_fare + \App\Vat::getHotelVat($original_fare);
      return $total_fare;
    }
  }
  function getHotelTotalTax($original_fare){
  if(getAuthenticatedUserRoleId() == CUSTOMER_ROLE_ID){
    $total_tax =  \App\AdminMarkup::getHotelMarkupByRoleId($original_fare);
    return number_format($total_tax);
  }elseif (getAuthenticatedUserRoleId() == AGENT_ROLE_ID) {
    $total_tax = \App\AdminMarkup::getHotelMarkupByRoleId($original_fare) + \App\AgentMarkup::getFlightMarkupPrice($original_fare);
    return number_format($total_tax);
  }
}
  function getArrivalAirport($report){
    $last_array = count($report[1]) - 1;
    return $report[1][$last_array]['arrival_airport'];
  }
  function getArrivalDate($report){
    $last_array = count($report[1]) - 1;
    return $report[1][$last_array]['arrival_date_time'];
  }
  function middlewareParams(){
    return array(['loginView','login','logout']);
  }
  function getDifferenceInDates($start, $end){
   $start_date = strtotime($start);
   $end_date = strtotime($end);
   $date = $end_date - $start_date;
   $duration = floor($date/ (60 * 60 * 24));
    return $duration;
  }
  function available_flight($search_array){
    if(isset($search_array['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS'])){
      $soap_body = $search_array['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS'];
      if(count($soap_body) == 2){
        $flight_error_type = $search_array['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['Errors']['Error'];
        if(is_array($flight_error_type)){
          return flash('<i class="fa fa-times"></i> &nbsp; '.$flight_error_type[0])->error();
        }else{
          return flash('<i class="fa fa-times"></i> &nbsp; '.$flight_error_type)->error();
        }
      }elseif(count($soap_body) > 2){
        $final_result = array();
        $itinerary = $soap_body['PricedItineraries']['PricedItinerary'];
        if(isset($itinerary)){
          if(count($itinerary) > 0){
//            $search_parameters = Session::get('search_parameters');
//            $origin_destination_options = $itinerary[$i]['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'];
            for($i = 0; $i < count($itinerary); $i++){
              $result = array();
              /*************************************************************************************/
              $direction = array();
              $other_data = array();
              $other_datum = array();
              $individual_fare_data = array();
//              $direction['direction'] = $itinerary[$i]['AirItinerary']['@attributes']['DirectionInd'];
//              array_push($result, $direction);
              /**************************************************************************************/

              $origin_destination_options = $itinerary[$i]['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'];
              if(isset($origin_destination_options[0])){
                $direction['direction'] = 'Circle';
                $segment_num = 0;
                $origin_destination_size = count($itinerary[$i]['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption']);
                $trips_info = array();
                for($j = 0; $j < $origin_destination_size; $j++) {
                  $flight_segment = $origin_destination_options[$j]['FlightSegment'];
                  $fare_info = $itinerary[$i]['AirItineraryPricingInfo']['FareInfos']['FareInfo'];
                  if(isset($origin_destination_options[$j]['FlightSegment'][0])){
                    $flight_data = array();
                    /*If there is more than one segments meaning if there is stop over..*/
                    $segs = count($flight_segment);
                    for ($s = 0; $s < count($flight_segment); $s++) {
                      $flight_datum = array();
                      $flight_datum['DepartureDateTime'] = $flight_segment[$s]['@attributes']['DepartureDateTime'];
                      $flight_datum['ArrivalDateTime'] = $flight_segment[$s]['@attributes']['ArrivalDateTime'];
                      $flight_datum['RPH'] = $flight_segment[$s]['@attributes']['RPH'];
                      $flight_datum['FlightNumber'] = $flight_segment[$s]['@attributes']['FlightNumber'];
                      $flight_datum['ResBookDesigCode'] = $flight_segment[$s]['@attributes']['ResBookDesigCode'];
                      $flight_datum['NumberInParty'] = $flight_segment[$s]['@attributes']['NumberInParty'];
                      /*************************************************************************************/
                      $flight_datum['DepartureAirport'] = $flight_segment[$s]['DepartureAirport'];
                      $flight_datum['ArrivalAirport'] = $flight_segment[$s]['ArrivalAirport'];
                      $flight_datum['OperatingAirline'] = $flight_segment[$s]['OperatingAirline'];
                      $flight_datum['OperatingAirlineId'] = $operating_airline_id = preg_replace('/\s+/', '_', $flight_segment[$s]['OperatingAirline']);
                      /*************************************************************************************/
                      $flight_datum['Cabin'] = $flight_segment[$s]['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                      $flight_datum['JourneyTotalDuration'] = $flight_segment[$s]['TPA_Extensions']['JourneyTotalDuration'];
                      $flight_datum['JourneyDuration'] = $flight_segment[$s]['TPA_Extensions']['JourneyDuration'];
                      /*************************************************************************************/

//                      $start = 0;
////                      if ($s == count($flight_segment) - 1) {
//                        for ($a = 0; $a < (count($flight_segment)); $a++) {
//                          $fare_array = array();
//
////                          dd(count($flight_segment) + $origin_destination_siz
                              $segment_info = $segment_num + $s;
                      $flight_datum['FilingAirlineCode'] = $fare_info[$segment_info]['FilingAirline']['@attributes']['Code'];
                      $flight_datum['DepartureAirportCode'] = $fare_info[$segment_info]['DepartureAirport']['@attributes']['LocationCode'];
                      $flight_datum['ArrivalAirportCode'] = $fare_info[$segment_info]['ArrivalAirport']['@attributes']['LocationCode'];
//                          $flight_datum['FareInfo'] = $fare_array;
//                          $start = $start+1;
//                        }
//                      }
//                      $flight_datum['FilingAirlineCode'] = $fare_info[$no_segments]['FilingAirline']['@attributes']['Code'];
//                      $flight_datum['DepartureAirportCode'] = $fare_info[$no_segments]['DepartureAirport']['@attributes']['LocationCode'];
//                      $flight_datum['ArrivalAirportCode'] = $fare_info[$no_segments]['ArrivalAirport']['@attributes']['LocationCode'];
                      array_push($flight_data, $flight_datum);
                    }
                  }
                  else {
                    $segs = 1;
                    $flight_data = array();
                    /* If there is just one segment, then it is a straight flight with no stop overs */
                    $flight_datum = array();
                    $flight_datum['DepartureDateTime'] = $flight_segment['@attributes']['DepartureDateTime'];
                    $flight_datum['ArrivalDateTime'] = $flight_segment['@attributes']['ArrivalDateTime'];
                    $flight_datum['RPH'] = $flight_segment['@attributes']['RPH'];
                    $flight_datum['FlightNumber'] = $flight_segment['@attributes']['FlightNumber'];
                    $flight_datum['ResBookDesigCode'] = $flight_segment['@attributes']['ResBookDesigCode'];
                    $flight_datum['NumberInParty'] = $flight_segment['@attributes']['NumberInParty'];
                    /*************************************************************************************/
                    $flight_datum['DepartureAirport'] = $flight_segment['DepartureAirport'];
                    $flight_datum['ArrivalAirport'] = $flight_segment['ArrivalAirport'];
                    $flight_datum['OperatingAirline'] = $flight_segment['OperatingAirline'];
                    $flight_datum['OperatingAirlineId'] = $operating_airline_id = preg_replace('/\s+/', '_', $flight_segment['OperatingAirline']);
                    /*************************************************************************************/
                    $flight_datum['Cabin'] = $flight_segment['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                    $flight_datum['JourneyTotalDuration'] = $flight_segment['TPA_Extensions']['JourneyTotalDuration'];
                    $flight_datum['JourneyDuration'] = $flight_segment['TPA_Extensions']['JourneyDuration'];

//                      if($search_parameters[8] > 0 || $search_parameters[9] > 0){
//                        $fare_info = $itinerary[$i]['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0];
//                      }
                      $flight_datum['FilingAirlineCode'] = $fare_info[$segment_num]['FilingAirline']['@attributes']['Code'];
                      $flight_datum['DepartureAirportCode'] = $fare_info[$segment_num]['DepartureAirport']['@attributes']['LocationCode'];
                      $flight_datum['ArrivalAirportCode'] = $fare_info[$segment_num]['ArrivalAirport']['@attributes']['LocationCode'];
                    array_push($flight_data, $flight_datum);
                  }
                  $segment_num = $segment_num + $segs;
                  array_push($trips_info, $flight_data);
                }
              }
              else
                {
                $direction['direction'] = 'OneWay';
                $flight_data = array();
                $trips_info = array();
                $flight_segment = $origin_destination_options['FlightSegment'];
                $fare_info = $itinerary[$i]['AirItineraryPricingInfo']['FareInfos']['FareInfo'];
                if(isset($origin_destination_options['FlightSegment'][0]))
                {
                  $trips_info = array();
                  /*If there is more than one segments meaning if there is stop over..*/
                  $no_segments = 0;
                  for($s = 0; $s < count($flight_segment); $s++)
                  {
                    $flight_datum = array();
                    $flight_datum['DepartureDateTime'] = $flight_segment[$s]['@attributes']['DepartureDateTime'];
                    $flight_datum['ArrivalDateTime'] = $flight_segment[$s]['@attributes']['ArrivalDateTime'];
                    $flight_datum['RPH'] = $flight_segment[$s]['@attributes']['RPH'];
                    $flight_datum['FlightNumber'] = $flight_segment[$s]['@attributes']['FlightNumber'];
                    $flight_datum['ResBookDesigCode'] = $flight_segment[$s]['@attributes']['ResBookDesigCode'];
                    $flight_datum['NumberInParty'] = $flight_segment[$s]['@attributes']['NumberInParty'];
                    /*************************************************************************************/
                    $flight_datum['DepartureAirport'] = $flight_segment[$s]['DepartureAirport'];
                    $flight_datum['ArrivalAirport'] = $flight_segment[$s]['ArrivalAirport'];
                    $flight_datum['OperatingAirline'] = $flight_segment[$s]['OperatingAirline'];
                    $flight_datum['OperatingAirlineId'] = $operating_airline_id = preg_replace('/\s+/', '_', $flight_segment[$s]['OperatingAirline']);
                    /*************************************************************************************/
                    $flight_datum['Cabin'] = $flight_segment[$s]['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                    $flight_datum['JourneyTotalDuration'] = $flight_segment[$s]['TPA_Extensions']['JourneyTotalDuration'];
                    $flight_datum['JourneyDuration'] = $flight_segment[$s]['TPA_Extensions']['JourneyDuration'];
                    /*************************************************************************************/
                    $flight_datum['FilingAirlineCode'] = $fare_info[$no_segments]['FilingAirline']['@attributes']['Code'];
                    $flight_datum['DepartureAirportCode'] = $fare_info[$no_segments]['DepartureAirport']['@attributes']['LocationCode'];
                    $flight_datum['ArrivalAirportCode'] = $fare_info[$no_segments]['ArrivalAirport']['@attributes']['LocationCode'];
                    $no_segments = $no_segments + 1;
                    array_push($flight_data, $flight_datum);
                  }
                }
                else
                  {
                  /* If there is just one segment, then it is a straight flight with no stop overs */
                  $flight_datum = array();
                  $flight_datum['DepartureDateTime'] = $flight_segment['@attributes']['DepartureDateTime'];
                  $flight_datum['ArrivalDateTime'] = $flight_segment['@attributes']['ArrivalDateTime'];
                  $flight_datum['RPH'] = $flight_segment['@attributes']['RPH'];
                  $flight_datum['FlightNumber'] = $flight_segment['@attributes']['FlightNumber'];
                  $flight_datum['ResBookDesigCode'] = $flight_segment['@attributes']['ResBookDesigCode'];
                  $flight_datum['NumberInParty'] = $flight_segment['@attributes']['NumberInParty'];
                  /*************************************************************************************/
                  $flight_datum['DepartureAirport'] = $flight_segment['DepartureAirport'];
                  $flight_datum['ArrivalAirport'] = $flight_segment['ArrivalAirport'];
                  $flight_datum['OperatingAirline'] = $flight_segment['OperatingAirline'];
                  $flight_datum['OperatingAirlineId'] = $operating_airline_id = preg_replace('/\s+/', '_', $flight_segment['OperatingAirline']);
                  /*************************************************************************************/
                  $flight_datum['Cabin'] = $flight_segment['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                  $flight_datum['JourneyTotalDuration'] = $flight_segment['TPA_Extensions']['JourneyTotalDuration'];
                  $flight_datum['JourneyDuration'] = $flight_segment['TPA_Extensions']['JourneyDuration'];

                  if(Session::get('no_kids') > 0 || Session::get('no_infants') > 0)
                  {
                    $fare_info = $itinerary[$i]['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0];
                  }
                  $flight_datum['FilingAirlineCode'] = $fare_info['FilingAirline']['@attributes']['Code'];
                  $flight_datum['DepartureAirportCode'] = $fare_info['DepartureAirport']['@attributes']['LocationCode'];
                  $flight_datum['ArrivalAirportCode'] = $fare_info['ArrivalAirport']['@attributes']['LocationCode'];
                  array_push($flight_data, $flight_datum);
                }
              }
              $other_datum['ValidatingAirlineCode'] = $itinerary[$i]['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'];
              $other_datum['Amount'] = flightPriceConvertToNaira($itinerary[$i]['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount']);
              $other_datum['TicketTimeLimit'] = $itinerary[$i]['TicketingInfo']['@attributes']['TicketTimeLimit'];
              array_push($other_data, $other_datum);

              $individual_fares = $itinerary[$i]['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
              if(isset($individual_fares[0]))
              {
                for($m = 0; $m < count($individual_fares); $m++)
                {
                  $individual_fare = array();
                  $individual_fare['nameType'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Code'];
                  $individual_fare['quantity'] = $individual_fares[$m]['PassengerTypeQuantity']['@attributes']['Quantity'];
                  $individual_fare['totalFare'] = $individual_fares[$m]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                  array_push($individual_fare_data, $individual_fare);
                }
              }
              else
                {
                $individual_fare['nameType'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Code'];
                $individual_fare['quantity'] = $individual_fares['PassengerTypeQuantity']['@attributes']['Quantity'];
                $individual_fare['totalFare'] = $individual_fares['PassengerFare']['TotalFare']['@attributes']['Amount'];
                array_push($individual_fare_data, $individual_fare);
              }
              array_push($result, $direction);
              if(isset($origin_destination_options[0])){
                array_push($result, $trips_info);
              }else{
                array_push($result, $flight_data);
              }
              array_push($result, $other_data);
              array_push($result, $individual_fare_data);
              array_push($final_result, $result);
            }
          }
        }
        return $final_result;
      }
    }
  }
  function hotelBuild($booking_code, $rate_plan_code, $adult, $kid, $check_in, $check_out, $duration, $guarantee, $deposit_payment,
                      $chain_code, $hotel_code, $hotel_city_code,
                      $hotel_code_context, $title, $last_name, $first_name, $email, $phone_number)
  {
    if(($kid > 0) AND ($adult > 0)){
      $passengers = "<GuestCount AgeQualifyingCode='ADT' Age='0' Count='$adult'></GuestCount>
                  <GuestCount AgeQualifyingCode='CHD' Age='0' Count='$kid'></GuestCount>";
    }
    elseif(($adult > 0) AND ($kid == "0")){
      $passengers = "<GuestCount AgeQualifyingCode='ADT' Age='0' Count='$adult'></GuestCount>";
    }
$request ="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Header>
    <TripXML xmlns='http://amadeusws.tripxml.com/wsTravelBuild'>
      <userName>string</userName>
      <password>string</password>
      <compressed>boolean</compressed>
    </TripXML>
  </soap:Header>
  <soap:Body>
    <wmTravelBuild xmlns='http://traveltalk.com/wsTravelBuild'>
      <OTA_TravelItineraryRQ>".amadeus_pos()."
        <OTA_HotelResRQ><HotelReservations>
            <HotelReservation RoomStayReservation='1'>
              <RoomStays>
                <RoomStay>
                  <RoomRates>
                    <RoomRate BookingCode='".$booking_code."' NumberOfUnits='1' RatePlanCode='".$rate_plan_code."'>
                    </RoomRate>
                  </RoomRates>
                  <GuestCounts>
                    ".$passengers."
                  </GuestCounts>
                  <TimeSpan Start='".$check_in."' Duration='".$duration."' End='".$check_out."' >
                  </TimeSpan>
                  ".$guarantee.$deposit_payment."
                  <BasicPropertyInfo ChainCode='".$chain_code."' HotelCode='".$hotel_code."' HotelCityCode='".$hotel_city_code."' HotelCodeContext='".$hotel_code_context."'>
                  </BasicPropertyInfo>
                </RoomStay>
              </RoomStays>
            </HotelReservation>
          </HotelReservations></OTA_HotelResRQ><TPA_Extensions><PNRData>
            <Traveler>
              <PersonName>
                <NamePrefix>".$title."</NamePrefix>
                <GivenName>".$last_name."</GivenName>
                <Surname>".$first_name."</Surname>
                <NameTitle>".ucfirst(strtolower($title))."</NameTitle>
              </PersonName>
              <TravelerRefNumber RPH='1'/>
            </Traveler>
            <Telephone PhoneLocationType='Home' CountryAccessCode='234'  FormattedInd='0' AreaCityCode='".$hotel_city_code."' PhoneNumber='".$phone_number."'/>
            <Email>".$email."</Email>
            <Ticketing><TicketAdvisory>OK</TicketAdvisory></Ticketing>
          </PNRData></TPA_Extensions>
      </OTA_TravelItineraryRQ>
    </wmTravelBuild>
  </soap:Body>
</soap:Envelope>";
    return $request;
  }