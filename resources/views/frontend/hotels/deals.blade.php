@extends('layouts.app')

@section('title') Top Hotels Deals   @endsection
@section('activeHotel') active @endsection
@section('loadingOverlay')
    @include('partials.hotelSearchOverlay')
@endsection
@section('content')

    <div class="container">
        <h1 class="page-title">Search Hotels</h1>
    </div>




    <div class="container">
        <form class="booking-item-dates-change mb40">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>
                        <label>Where</label>
                        <input class="typeahead form-control destination_city" value="" placeholder="City, Hotel Name or U.S. Zip Code" type="text" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-daterange" data-date-format="MM d, D">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                    <label>Check in</label>
                                    <input class="form-control checkin_date" name="start" type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                    <label>Check out</label>
                                    <input class="form-control checkout_date" name="end" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group- form-group-select-plus">
                                <label>Guests</label>
                                <select class="form-control guests">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-select-plus">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-primary search_hotel">Search Hotel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="gap gap-small"></div>
        <h3 class="mb20">Hotels in Popular Destinations</h3>
        <div class="row row-wrap">
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/gaviota_en_el_top_800x600.jpg" alt="Image Alternative text" title="Gaviota en el Top" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>New York City Hotels</h5>
                                <p>68065 reviews</p>
                                <p class="mb0">359 offers from $88</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/sydney_harbour_800x600.jpg" alt="Image Alternative text" title="Sydney Harbour" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Sydney Hotels</h5>
                                <p>59897 reviews</p>
                                <p class="mb0">804 offers from $82</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/street_800x600.jpg" alt="Image Alternative text" title="Street" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Disney World Hotels</h5>
                                <p>78609 reviews</p>
                                <p class="mb0">805 offers from $72</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/the_journey_home_400x300.jpg" alt="Image Alternative text" title="the journey home" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Seattle Hotels</h5>
                                <p>60169 reviews</p>
                                <p class="mb0">971 offers from $96</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/lack_of_blue_depresses_me_800x600.jpg" alt="Image Alternative text" title="lack of blue depresses me" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Miami Hotels</h5>
                                <p>58440 reviews</p>
                                <p class="mb0">508 offers from $52</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/waipio_valley_800x600.jpg" alt="Image Alternative text" title="waipio valley" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Sydney Hotels</h5>
                                <p>58085 reviews</p>
                                <p class="mb0">722 offers from $52</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/the_best_mode_of_transport_here_in_maldives_800x600.jpg" alt="Image Alternative text" title="the best mode of transport here in maldives" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Virginia Beach Hotels</h5>
                                <p>71223 reviews</p>
                                <p class="mb0">592 offers from $84</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/upper_lake_in_new_york_central_park_800x600.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Atlantic City Hotels</h5>
                                <p>75641 reviews</p>
                                <p class="mb0">309 offers from $63</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/viva_las_vegas_800x600.jpg" alt="Image Alternative text" title="Viva Las Vegas" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Las Vegas</h5>
                                <p>70579 reviews</p>
                                <p class="mb0">649 offers from $87</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/el_inevitable_paso_del_tiempo_800x600.jpg" alt="Image Alternative text" title="El inevitable paso del tiempo" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Budapest</h5>
                                <p>66475 reviews</p>
                                <p class="mb0">880 offers from $86</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/new_york_at_an_angle_800x600.jpg" alt="Image Alternative text" title="new york at an angle" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Boston</h5>
                                <p>75294 reviews</p>
                                <p class="mb0">417 offers from $54</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <a class="hover-img" href="#">
                        <img src="img/196_365_800x600.jpg" alt="Image Alternative text" title="196_365" />
                        <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                            <div class="text-small">
                                <h5>Paris</h5>
                                <p>77203 reviews</p>
                                <p class="mb0">665 offers from $97</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="gap"></div>
        <h3 class="mb20">Top Deals</h3>
        <div class="row row-wrap">
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_porto_bay_serra_golf_suite_800x600.jpg" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF suite" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">The Kimberly Hotel</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> East Elmhurst, NY (LaGuardia Airport (LGA))</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$499</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_1_800x600.jpg" alt="Image Alternative text" title="hotel 1" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star-half-empty"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">InterContinental New York B...</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> Ozone Park, NY (Kennedy Airport (JFK))</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$212</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_porto_bay_serra_golf_library_800x600.jpg" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF library" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star-half-empty"></i>
                            </li>
                            <li><i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">The Benjamin</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> Bronx (Bronx)</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$399</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_porto_bay_serra_golf_living_room_800x600.jpg" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF living room" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">Waldorf Astoria New York</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Upper West Side)</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$413</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_porto_bay_rio_internacional_de_luxe_800x600.jpg" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL de luxe" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">The London NYC</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Times Square)</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$441</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_the_cliff_bay_spa_suite_800x600.jpg" alt="Image Alternative text" title="hotel THE CLIFF BAY spa suite" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">Wellington Hotel</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Downtown - Wall Street)</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$438</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/hotel_porto_bay_serra_golf_suite2_800x600.jpg" alt="Image Alternative text" title="hotel PORTO BAY SERRA GOLF suite2" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star-o"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">Affinia Shelburne</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> Jamaica, NY (Kennedy Airport (JFK))</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$399</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumb">
                    <header class="thumb-header">
                        <a class="hover-img" href="#">
                            <img src="img/lhotel_porto_bay_sao_paulo_lobby_800x600.jpg" alt="Image Alternative text" title="LHOTEL PORTO BAY SAO PAULO lobby" />
                            <h5 class="hover-title-center">Book Now</h5>
                        </a>
                    </header>
                    <div class="thumb-caption">
                        <ul class="icon-group text-tiny text-color">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star-half-empty"></i>
                            </li>
                        </ul>
                        <h5 class="thumb-title"><a class="text-darken" href="#">JFK Inn</a></h5>
                        <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Midtown East)</small>
                        </p>
                        <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$306</span><small> avg/night</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap gap-small"></div>
    </div>

@endsection