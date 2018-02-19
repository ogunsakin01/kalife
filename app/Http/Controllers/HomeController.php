<?php

namespace App\Http\Controllers;

use App\BankDetail;
use App\BankPayment;
use App\FlightBooking;
use App\PackageBooking;
use App\Services\InterswitchConfig;
use App\Services\SabreConfig;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use App\SessionToken;
use App\User;
use App\Wallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->Sabreflight = new SabreFlight();
        $this->SabreConfig = new SabreConfig();
        $this->SabreSession = new SabreSessionManager();
        $this->InterswitchConfig = new InterswitchConfig();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();

        $name = $user->getAuthenticatedUserFullName();

        $userFlightBookings = count(FlightBooking::where('user_id',auth()->user()->id)->get());

        $userPackagesBookings = count(PackageBooking::where('user_id',auth()->user()->id)->get());


        $userWalletBalance = Wallet::where('user_id',auth()->user()->id)->first()->balance;

        $allFlightBookings = count(FlightBooking::all());


        $allPackagesBookings = count(PackageBooking::all());

        return view('backend.home', compact('name','userFlightBookings','userWalletBalance','userPackagesBookings','allFlightBookings','allPackagesBookings'));
    }

    public function availableFlights(){
        if(!session()->has(['availableFlights','flightSearchParam'])){
            Toastr::error('Session Expired. Try search again');
            return back();
        }
        $flightsResult = session()->get('availableFlights');
        $flightSearchParam = session()->get('flightSearchParam');
        $airlines = $this->Sabreflight->availableAirline($flightsResult);
        $flightsResult = $this->Sabreflight->sortFlightArray($flightsResult);
        return view('backend.flights.available_flights',compact('flightsResult','flightSearchParam','airlines'));
    }

    public function flightPassengerDetails(){
        if(!session()->has('selectedItinerary')){
            Toastr::error('Session Expired. Try search again');
            return redirect(url('backend/home'));

        }
        $itinerary = session()->get('selectedItinerary');
        return view('backend.flights.passenger_details',compact('itinerary'));
    }

    public function flightCreatePNR(Request $r){
        $itinerary = session()->get('selectedItinerary');
        $message_id = session()->get('message_id');
        $token = SessionToken::getTokenWithId($message_id);
        $session_info = [
            'token' => $token,
            'message_id' => $message_id
        ];

        $check_session = $this->SabreSession->sessionRefreshValidator($this->SabreSession->refreshSession($session_info['token'],$session_info['message_id']));

        if($check_session == 1){

            $request = $this->Sabreflight->doCall($this->Sabreflight->callsHeader('PassengerDetailsRQ',$session_info),$this->Sabreflight->PassengerDetailsRQXML($r),'PassengerDetailsRQ');
            $responseArray = $this->SabreConfig->mungXmlToArray($request);
            $info = $this->Sabreflight->passengerDetailsValidator($responseArray);

            $file = fopen("TestSamplePassengerDetailsRQ.txt","w");
            fwrite($file,$this->Sabreflight->PassengerDetailsRQXML($r));
            fclose($file);
            $file = fopen("TestSamplePassengerDetailsRS.txt","w");
            fwrite($file,$request);
            fclose($file);

            if($info == 0){
                Toastr::error('Bad internet connection. Unable to connect to booking server');
                return redirect(url('backend/flight-passenger-details'))->with('errorMessage','Unable to connect to the booking server. Ensure your internet connection is strong and try again');
            }
            else{
                if($info['pnrStatus'] == 0){
                    Toastr::error("You can no longer continue this booking process, this itinerary is no longer available. Select another flight and try again");
                    return redirect(url('backend/flight-passenger-details'))->with('errorMessage','You cannot continue the booking process. Select another flight from the result and try again.');
                }else{
                    $total_amount = 0;
                    $markup = 0;
                    if(auth()->user()->hasRole('Agent')){
                        $total_amount = $itinerary[0]['adminToAgentSumTotal'];
                        $markup = $itinerary[0]['adminToAgentMarkup'];
                    }elseif(auth()->user()->hasRole('Super Admin')){
                        $total_amount = $itinerary[0]['adminToAdminSumTotal'];
                        $markup = $itinerary[0]['adminToAdminMarkup'];
                    }elseif(auth()->user()->hasRole('Customer')){
                        $total_amount = $itinerary[0]['adminToUserSumTotal'];
                        $markup = $itinerary[0]['adminToUserMarkup'];
                    }
                    if(auth())
                        $this->SabreSession->closeSession($token,$message_id);
                    SessionToken::tokenClosed($message_id);
                    SessionToken::tokenUsed($message_id);
                    $txnRef = $this->SabreConfig->bookingReference('flight');
                    $data = [
                        'user_id' => auth()->user()->id,
                        'booking_reference' => $txnRef,
                        'pnr_code' => $info['pnr'],
                        'itinerary_amount' => $itinerary[0]['totalPrice'],
                        'admin_markup' => $markup,
                        'airline_markdown' => $itinerary[0]['airlineMarkdown'],
                        'vat' => $itinerary[0]['vat'],
                        'agent_markup' => 0,
                        'total_amount' => $total_amount,
                        'ticket_time_limit' => $info['ticketTimeLimit'],
                        'pnr_status' => $info['pnrStatus'],
                        'pnr_request_response' => $info['responseObject']
                    ];
                    FlightBooking::store($data);
                    session()->put('bookingReference',$txnRef);
                    return redirect(url("backend/flight-booking-payment-methods"));
                }

            }
        }elseif($check_session == 0){
            Toastr::error('Bad internet connection. Unable to connect to booking server');
            return redirect(url('backend/flight-passenger-details'))->with('errorMessage','Unable to connect to the booking server. Ensure your internet connection is strong and try again');
        }elseif($check_session == 2){
            Toastr::error('Session Expired. You spent too much time on your booking, your session has expired');
            return redirect(url('backend/flight-passenger-details'))->with('errorMessage','Your booking session expired, select another flight and try again');
        }elseif($check_session == 3){
            Toastr::error('Server Error. Please try again later');
            return redirect(url('backend/flight-passenger-details'))->with('errorMessage','Server error, try again later');

        }


    }

    public function flightPaymentPage(){
        if(!session()->has(['selectedItinerary','bookingReference'])){return back();}
        $itinerary = session()->get('selectedItinerary');
        $txnRef = session()->get('bookingReference');
        $bookingInfo = FlightBooking::getBooking($txnRef);
        $custInfo = User::getUserById($bookingInfo->user_id);
        $bank_details = BankDetail::getActiveBanksDetails();
        $paymentInfo = [
            'reference' => $txnRef,
            'amount' => $bookingInfo->total_amount,
            'pay_item_id' => $this->InterswitchConfig->item_id,
            'site_redirect_url' => url('backend/flight-booking-confirmation'),
            'product_id' => $this->InterswitchConfig->product_id,
            'cust_id' => $bookingInfo->user_id,
            'cust_name' => $custInfo->first_name.' '.$custInfo->last_name,
            'hash' => $this->InterswitchConfig->transactionHash($txnRef,$bookingInfo->total_amount,url('backend/flight-booking-confirmation')),
            'email' => $custInfo->email
        ];
        return view('backend.flights.payment_options',compact('itinerary','paymentInfo','bank_details'));
    }

    public function bookingComplete(){
        $itinerary = session()->get('selectedItinerary');
        $transactionStatus = session()->get('transactionStatus');
        return view("backend.flights.success_payment", compact('transactionStatus','itinerary'));
    }

    public function flightBankPayment(Request $r){
        if(substr($r->reference,0,3) == 'AIR'){
            $booking = FlightBooking::getBooking($r->reference);
        }elseif(substr($r->reference,0,3) == 'PKG'){
            $booking = PackageBooking::getBookingByReference($r->reference);
        }
        $amount = $booking->total_amount;
        $rawData = [
            'reference' => $r->reference,
            'user_id'   => auth()->user()->id,
            'amount'    => $amount,
            'bank_detail_id' =>$r->selected_bank,
            'slip_photo'      => '',
            'status'          => 2,
            'email' => auth()->user()->id,
            'responseCode' => 2,
            'responseDescription' => "You selected the bank payment option, proceed to upload your payment proof at your bank payments page.",
            'responseFull' => '0'
        ];
        $data = (object) $rawData;
        BankPayment::storeOrUpdate($data);
        session()->put('transactionStatus',$rawData);
        return redirect(route('backend-flight-booking-complete'));
    }
}
