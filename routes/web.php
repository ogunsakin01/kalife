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

/**
Front routes starts here
 */


Route::get('/','FrontEndController@index');
Route::view('/login','frontend.register_login');
Route::view('/register','frontend.register_login');
Route::view('/contact-us','frontend.contact_us');
Route::view('/about-us','frontend.about_us');
Route::view('/register-login','frontend.register_login');
Route::view('/log', 'frontend.online_payment');
Route::view('/logs', 'frontend.online_payment');
Route::get('/attractions','FrontEndController@attractions');
Route::get('/attraction-details/{id}/{name}','FrontEndController@attractionDetails');
Route::get('/book-package/{id}/{name}','FrontEndController@attractionBook');
Route::post('/package-booking','FrontEndController@bookPackage');
Route::get('/hotels', 'FrontEndController@hotelDeals');
Route::get('/hotel-details/{id}/{name}','FrontEndController@hotelDetails');
Route::get('/flights', 'FrontEndController@flightDeals');
Route::post('/bankPayment','FrontEndPaymentController@bankPayment');



Route::middleware(['auth','role:Customer'])->group(function(){
    Route::view('/bookings','frontend.bookings');
    Route::view('/flight-bookings','frontend.flight_bookings');
    Route::view('/package-bookings','frontend.package_bookings');
    Route::view('/my-online-payments','frontend.my_online_payments');
    Route::view('/manage-user','frontend.manage_user');
    Route::post('/update-user','CustomerProfileController@updateProfile');
    Route::post('/update-password','CustomerProfileController@updatePassword');
    Route::get('/bank-payments','FrontEndController@banksPayment');
    Route::get('/package-booking-complete','FrontEndPaymentController@packageBookingComplete');
    Route::get('/package-payment-methods/{txnRef}','FrontEndController@packagePaymentMethod');

});


Route::get('/logout','Auth\LoginController@logout');


Route::post('/subscribe','FrontEndController@subscribe');
Route::post('/message','FrontEndController@message');
Route::post('/tokenRefresh','FrontEndController@tokenRefresh');
Route::post('/pageTimeOut','FrontEndController@pageTimeOut');
Route::post('/requery','FrontEndPaymentController@interswitchRequery');


Route::get('typeaheadJs', 'FlightController@typeaheadJs')->name('typeaheadJs');
Route::get('airlineTypeAheadJs', 'FlightController@airlineTypeAheadJs')->name('airlineTypeAheadJs');



Route::post('/searchFlight','FlightController@searchFlight');
Route::post('/multiCitySearch','FlightController@multiCitySearch');
Route::get('/available-flights','FlightController@availableFlights');
Route::post('/passengerDetailsRQ','FlightController@flightCreatePNR');
Route::get('/flight-booking-payment-methods','FlightController@flightPaymentPage');
Route::post('/flightBookPricing','FlightController@flightBookPricing');
Route::get('/flight-passenger-details', 'FlightController@flightPassengerDetails');
Route::get('/flight-booking-complete', 'FrontEndPaymentController@bookingComplete');
Route::get('/flight-details/{id}/{name}','FrontEndController@flightDealDetails');
Route::view('/loading','frontend.loading');

Route::post('/searchHotel','HotelController@searchHotel');
Route::get('/available-hotels', 'HotelController@availableHotels');
Route::post('/hotelPropertyDescription', 'HotelController@hotelPropertyDescription');
Route::get('/hotel-information', 'HotelController@selectedHotel');

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

Route::post('/updatePaymentProof','WalletController@updateBankPaymentProof');



/**
Front routes ends here
 */



Route::view('/test', 'backend.test');

Route::group(['prefix' => 'backend'],function (){

  Route::get('', 'HomeController@index')->name('backend-home')->middleware('role:Super Admin|Agent');
  Route::get('home', 'HomeController@index')->name('backend-home')->middleware('role:Super Admin|Agent');

  Route::get('password/reset', 'PasswordController@showLinkRequestForm')->name('backend-password-reset');
  Route::post('password/reset', 'PasswordController@sendPasswordResetLink')->name('backend-password-reset-post');
  Route::get('login', 'LoginController@index')->name('backend-login');
  Route::post('login', 'LoginController@authenticate')->name('backend-post-login');
  Route::post('password/change','PasswordController@changePassword')->name('backend-change-password')->middleware('role:Super Admin|Agent');

  Route::group(['prefix' => 'users', 'middleware' => 'role:Super Admin'],function(){
      Route::get('new', 'UserController@index')->name('backend-new-users');
      Route::post('new','UserController@saveUser')->name('backend-save-new-users');
      Route::get('fetch','UserController@fetchUsers')->name('backend-fetch-users');
      Route::get('edit/{id}','UserController@editUser')->name('backend-edit-user');
      Route::get('delete/{id}','UserController@deleteUser')->name('backend-delete-user');
      Route::view('manage', 'backend.users.manage')->name('backend-manage-users');
  });

  Route::group(['prefix' => 'additions', 'middleware' => 'role:Super Admin'],function(){
        Route::get('markup', 'MarkupController@markupView')->name('backend-markup');
        Route::post('markup/admin', 'MarkupController@saveAdminMarkup')->name('backend-save-markup');
        Route::get('getMarkup/{id}','MarkupController@getMarkupById');

        Route::get('markdown', 'MarkdownController@index')->name('backend-markdown');
        Route::post('createOrUpdateMarkdown','MarkdownController@createOrUpdate');
        Route::get('getMarkdown/{id}','MarkdownController@getMarkdownById');

        Route::get('vat', 'VatController@vatView')->name('backend-vat');
        Route::post('vat', 'VatController@saveVat')->name('backend-save-vat');
        Route::get('getVat/{type}','VatController@getVat');

        Route::get('manage-user-roles', 'RoleController@index')->name('manage-user-roles');
        Route::post('add-user-permission','RoleController@addPermission');
    });


  Route::get('logout', 'LogoutController@logout')->name('backend-logout');


  Route::prefix('profile')->group(function (){
    Route::get('', 'ProfileController@profileView')->name('backend-profile-view')->middleware('role:Super Admin|Agent');
  });

  Route::group(['prefix' => 'wallet', 'middleware' => ['role:Super Admin|Agent']],function (){

    Route::get('', 'WalletController@walletView')->name('backend-wallet-view');
    Route::post('deposit', 'WalletController@saveWalletDeposit')->name('backend-save-wallet-deposit');
    Route::post('updatePaymentProof', 'WalletController@updatePaymentProof');
    Route::get('online-transactions','WalletController@onlineTransactions')->name('backend-online-transactions')->middleware('role:Super Admin');
    Route::get('all-wallets-transaction-log','WalletController@allWalletsTransactionLogs')->name('backend-wallet-transactions')->middleware('role:Super Admin');
    Route::get('all-bank-transactions-log','WalletController@allBankTransactionLogs')->name('backend-bank-transactions')->middleware('role:Super Admin');

    Route::post('buildInterswitchTransaction','WalletController@buildInterswitchTransaction');
    Route::post('initiatePaystackTransaction','WalletController@initiatePaystackTransaction');
    Route::post('payment-confirmation','WalletController@interswitchPaymentConfirmation');
    Route::get('payment-confirmation','WalletController@paystackPaymentConfirmation');
    Route::get('payment-complete','WalletController@onlinePaymentComplete');
    Route::post('requery','WalletController@requeryOnlinePayment');

    Route::post('approve-bank-payment','WalletController@approveBankPayment')->middleware('role:Super Admin');
    Route::post('decline-bank-payment','WalletController@declineBankPayment')->middleware('role:Super Admin');

    Route::post('approve-wallet-deposit','WalletController@approveWalletDeposit')->middleware('role:Super Admin');
    Route::post('decline-wallet-deposit','WalletController@declineWalletDeposit')->middleware('role:Super Admin');


  });

  Route::group(['prefix' => 'bank-details'],function (){
    Route::get('/fetch/{id}', 'WalletController@getBankDetail')->name('backend-bank-details');
    Route::view('','backend.additions.bank_details')->name('banks')->middleware('role:Super Admin');
    Route::post('/saveOrUpdate','WalletController@saveOrUpdateBankDetails')->middleware('role:Super Admin');
    Route::post('/activate','WalletController@activateBankDetails')->middleware('role:Super Admin');
    Route::post('/deActivate','WalletController@deActivateBankDetails')->middleware('role:Super Admin');
    Route::post('/delete','WalletController@deleteBankDetails')->middleware('role:Super Admin');



  });

  Route::prefix('bookings')->group(function(){

      Route::prefix('package-bookings')->group(function(){
          Route::get('/user','BookingsController@authenticatedUserPackageBookings')->name('my-package-bookings')->middleware('role:Super Admin|Agent');
          Route::get('/agents','BookingsController@agentsPackageBookings')->name('agents-package-bookings')->middleware('role:Super Admin');
          Route::get('/customers','BookingsController@customersPackageBookings')->name('customers-package-bookings')->middleware('role:Super Admin');
      });

      Route::prefix('flight-bookings')->group(function(){
          Route::get('/user','BookingsController@authenticatedUserFlightBookings')->name('my-flight-bookings')->middleware('role:Super Admin|Agent');
          Route::get('/agents','BookingsController@agentsFlightBookings')->name('agents-flight-bookings')->middleware('role:Super Admin');
          Route::get('/customers','BookingsController@customersFlightBookings')->name('customers-flight-bookings')->middleware('role:Super Admin');
      });

      Route::prefix('hotel-bookings')->group(function(){
          Route::get('/user','BookingsController@authenticatedUserHotelBookings')->name('my-hotel-bookings')->middleware('role:Super Admin|Agent');
          Route::get('/agents','BookingsController@agentsHotelBookings')->name('agents-hotel-bookings')->middleware('role:Super Admin');
          Route::get('/customers','BookingsController@customersHotelBookings')->name('customers-hotel-bookings')->middleware('role:Super Admin');
      });

      Route::prefix('car-bookings')->group(function(){
          Route::get('/user','BookingsController@authenticatedUserCarBookings')->name('my-car-bookings')->middleware('role:Super Admin|Agent');
          Route::get('/agents','BookingsController@agentsCarBookings')->name('agents-car-bookings')->middleware('role:Super Admin');
          Route::get('/customers','BookingsController@customersCarBookings')->name('customers-car-bookings')->middleware('role:Super Admin');
      });


  });

});

Route::group(['prefix' => 'backend/packages',  'middleware' => ['auth','role:Super Admin']], function() {
    Route::get('', 'ActivitiesController@index')->name('packages');
    Route::get('activate/{id}', 'ActivitiesController@activate')->name('activate');
    Route::get('deactivate/{id}', 'ActivitiesController@deactivate')->name('deactivate');
    Route::get('create', 'ActivitiesController@packageCreate');
    Route::get('description', 'ActivitiesController@packageDescription');
    Route::get('delete/{id}', 'ActivitiesController@deleteActivities');
    Route::get('delete/picture/{id}', 'ActivitiesController@deletePicture');
    Route::get('delete/sight/{id}', 'ActivitiesController@deleteSight');
    Route::post('storePackageInfo', 'ActivitiesController@storePackageInfo');
    Route::post('storeFlightInfo', 'ActivitiesController@storeFlightInfo');
    Route::post('storeHotelInfo', 'ActivitiesController@storeHotelInfo');
    Route::post('storeAttractionInfo', 'ActivitiesController@storeAttractionInfo');
    Route::post('storeSightSeeingInfo', 'ActivitiesController@storeSightSeeingInfo');
    Route::post('storeGoodToKnowInfo', 'ActivitiesController@storeGoodToKnowInfo');
    Route::post('storeGalleryInfo', 'ActivitiesController@storeGalleryInfo');
    Route::post('sight-seeing', 'ActivitiesController@saveSightSeeing');
    Route::post('update/sight-seeing', 'ActivitiesController@updateSightSeeing');
    Route::get('edit/{id}', 'ActivitiesController@updateActivitiesView');

    Route::patch('information/{id}', 'ActivitiesController@updateActivityInformation');
    Route::patch('schedule/{id}', 'ActivitiesController@updateTimeSchedule');
    Route::patch('good-to-know/{id}', 'ActivitiesController@updateGoodToKnow');
    Route::post('gallery/{id}', 'ActivitiesController@updateGallery');

});

Route::group(['prefix' => 'backend/travel-packages', 'middleware' => ['auth','role:Super Admin'] ], function(){

    Route::get('', 'TravelPackageController@travelPackages');
    Route::get('create', 'TravelPackageController@packageCreate');
    Route::post('createPackage','TravelPackageController@create');
    Route::post('createFlightDeal','TravelPackageController@createFlightDeal');
    Route::post('createHotelDeal','TravelPackageController@createHotelDeal');
    Route::post('createAttraction','TravelPackageController@createAttraction');
    Route::get('activate/{id}', 'TravelPackageController@activate')->name('activate');
    Route::get('deactivate/{id}', 'TravelPackageController@deactivate')->name('deactivate');
    Route::get('delete/{id}', 'TravelPackageController@deletePackage');
    Route::get('edit/{id}', 'TravelPackageController@editPackage');
    Route::post('delete-image','TravelPackageController@deleteImage');

});



Auth::routes();


