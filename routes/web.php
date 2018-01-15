<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('frontend.home');
});
Route::view('/login','frontend.register_login');
Route::view('/register','frontend.register_login');
Route::view('/contact-us','frontend.contact_us');
Route::view('/about-us','frontend.about_us');
Route::view('/register-login','frontend.register_login');
Route::view('/log', 'frontend.online_payment');
Route::view('/logs', 'frontend.online_payment');

Route::middleware('auth')->group(function(){
    Route::view('/bookings','frontend.bookings');
    Route::view('/flight-bookings','frontend.flight_bookings');
    Route::view('/my-online-payments','frontend.my_online_payments');
    Route::view('/manage-user','frontend.manage_user');
    Route::post('/update-user','CustomerProfileController@updateProfile');
    Route::post('/update-password','CustomerProfileController@updatePassword');
//    Route::view('/hotel-bookings','frontend.hotel_bookings');
//    Route::view('/package-bookings','frontend.package_bookings');
});


Route::get('/logout','Auth\LoginController@logout');


Route::post('/subscribe','FrontEndController@subscribe');
Route::post('/message','FrontEndController@message');
Route::post('/tokenRefresh','FrontEndController@tokenRefresh');
Route::post('/pageTimeOut','FrontEndController@pageTimeOut');
Route::post('/requery','FrontEndPaymentController@interswitchRequery');


Route::get('typeaheadJs', 'FlightController@typeaheadJs')->name('typeaheadJs');
Route::view('/flights', 'frontend.flights.deals');
Route::post('/searchFlight','FlightController@searchFlight');
Route::post('/multiCitySearch','FlightController@multiCitySearch');
Route::get('/available-flights','FlightController@availableFlights');
Route::post('/passengerDetailsRQ','FlightController@flightCreatePNR');
Route::get('/flight-booking-payment-methods','FlightController@flightPaymentPage');
Route::post('/flightBookPricing','FlightController@flightBookPricing');
Route::get('/flight-passenger-details', 'FlightController@flightPassengerDetails');
Route::get('/flight-booking-complete', 'FrontEndPaymentController@bookingComplete');
Route::view('/loading','frontend.loading');

Route::post('/searchHotel','HotelController@searchHotel');
Route::get('/available-hotels', 'HotelController@availableHotels');
Route::post('/hotelPropertyDescription', 'HotelController@hotelPropertyDescription');
Route::get('/hotel-information', 'HotelController@selectedHotel');
Route::view('/hotels', 'frontend.hotels.deals');
Route::get('/room-booking/{room}','HotelController@selectedRoomBooking');
Route::post('/hotelPassengerDetailsRQ','HotelController@createReservation');
Route::get('/payment-option/{room}/reservation','HotelController@hotelPaymentOption');

Route::post('/initiatePaystack','FrontEndPaymentController@initiatePaystack');
Route::post('/saveTransaction','FrontEndPaymentController@saveTransaction');

Route::get('/flight-booking-confirmation','FrontEndPaymentController@flightPaymentConfirmationPaystack');
Route::post('/flight-booking-confirmation','FrontEndPaymentController@flightPaymentConfirmationInterswitch');
Route::get('/hotel-booking-confirmation','FrontEndPaymentController@hotelPaymentConfirmationPaystack');
Route::post('/hotel-booking-confirmation','FrontEndPaymentController@hotelPaymentConfirmationInterswitch');
Route::get('/package-booking-confirmation','FrontEndPaymentController@packagePaymentConfirmationPaystack');
Route::post('/package-booking-confirmation','FrontEndPaymentController@packagePaymentConfirmationInterswitch');



Route::view('/test', 'backend.test');

Route::prefix('backend')->group(function (){
  Route::get('home', 'HomeController@index')->name('backend-home');

  Route::get('password/reset', 'PasswordController@showLinkRequestForm')->name('backend-password-reset');
  Route::post('password/reset', 'PasswordController@sendPasswordResetLink')->name('backend-password-reset-post');
  Route::get('login', 'LoginController@index')->name('backend-login');
  Route::post('login', 'LoginController@authenticate')->name('backend-post-login');
  Route::post('password/change','PasswordController@changePassword')->name('backend-change-password');

  Route::get('logout', 'LogoutController@logout')->name('backend-logout');

  Route::prefix('users')->group(function () {
    Route::get('new', 'UserController@index')->name('backend-new-users');
    Route::post('new','UserController@saveUser')->name('backend-save-new-users');
    Route::get('fetch','UserController@fetchUsers')->name('backend-fetch-users');
    Route::get('edit/{id}','UserController@editUser')->name('backend-edit-user');
    Route::get('delete/{id}','UserController@deleteUser')->name('backend-delete-user');
    Route::view('manage', 'backend.users.manage')->name('backend-manage-users');
  });

  Route::prefix('additions')->group(function (){
    Route::get('markup', 'MarkupController@markupView')->name('backend-markup');
    Route::post('markup/admin', 'MarkupController@saveAdminMarkup')->name('backend-save-markup');

    Route::view('markdown', 'backend.additions.markdown')->name('backend-markdown');

    Route::get('vat', 'VatController@vatView')->name('backend-vat');
    Route::post('vat', 'VatController@saveVat')->name('backend-save-vat');
    });

  Route::prefix('profile')->group(function (){
    Route::get('', 'ProfileController@profileView')->name('backend-profile-view');
  });

  Route::prefix('wallet')->group(function (){
    Route::get('', 'WalletController@walletView')->name('backend-wallet-view');
  });

  Route::prefix('bank-details')->group(function (){
    Route::get('/fetch/{id}', 'WalletController@getBankDetail')->name('backend-bank-details');
  });

});


Auth::routes();


