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
Route::get('typeaheadJs', 'FlightController@typeaheadJs')->name('typeaheadJs');
Route::get('/', function () {
    return view('frontend.home');
});
Route::get('/flight-deals', 'FlightController@flightDeals');
Route::post('/searchFlight','FlightController@searchFlight');
Route::post('/multiCitySearch','FlightController@multiCitySearch');
Route::get('/available-flights','FlightController@availableFlights');
Route::view('/contact-us','frontend.contact_us');
Route::view('/about-us','frontend.about_us');
Route::post('/subscribe','FrontEndController@subscribe');
Route::post('/message','FrontEndController@message');
Route::post('/tokenRefresh','FrontEndController@tokenRefresh');
Route::post('/pageTimeOut','FrontEndController@pageTimeOut');
Route::post('/flightBookPricing','FlightController@flightBookPricing');
Route::get('/flight-passenger-details', 'FlightController@flightPassengerDetails');

Route::view('/test', 'backend.test');
Route::prefix('backend')->group(function (){
    Route::view('home', 'backend.home')->name('home');
});

