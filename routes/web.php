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
Route::get('/available-flights','FlightController@availableFlights');


Route::view('/test', 'backend.test');
Route::prefix('backend')->group(function (){
  Route::view('home', 'backend.home')->name('home');
});

