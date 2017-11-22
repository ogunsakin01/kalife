@extends('layouts.app')

@section('content')
    <!-- TOP AREA -->
    <div class="top-area show-onload">
        <div class="bg-holder full">
            <div class="bg-mask"></div>
            <div class="bg-parallax" style="background-image:url(img/196_365_2048x1365.jpg);"></div>
            <div class="bg-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-tabs search-tabs-bg mt50">
                                <h1>Find Your Perfect Trip</h1>
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-plane"></i> <span >Flights</span></a>
                                        </li>
                                        <li><a href="#tab-2" data-toggle="tab"><i class="fa fa-building-o"></i> <span >Hotels</span></a>
                                        </li>
                                        <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-home"></i> <span >Rentals</span></a>
                                        </li>
                                        <li><a href="#tab-4" data-toggle="tab"><i class="fa fa-car"></i> <span >Cars</span></a>
                                        </li>
                                        <li><a href="#tab-5" data-toggle="tab"><i class="fa fa-bolt"></i> <span >Activities</span></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab-1">
                                            <h2>Search for Cheap Flights</h2>
                                            <form>
                                                <div class="tabbable">
                                                    <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                                                        <li class="active"><a href="#flight-search-1" data-toggle="tab" class="trip_type">Round Trip</a>
                                                        </li>
                                                        <li><a href="#flight-search-2" data-toggle="tab" class="trip_type">One Way</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <input type="hidden" class="flight_type" value="Round Trip"/>
                                                        <div class="tab-pane fade in active" id="flight-search-1">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>From</label>
                                                                        <input class="typeahead form-control departure_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>To</label>
                                                                        <input class="typeahead form-control arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-daterange" data-date-format="M d, D">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                            <label>Departing</label>
                                                                            <input class="form-control departure_date" value="" name="start" type="text" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                            <label>Returning</label>
                                                                            <input class="form-control arrival_date" value="" name="end" type="text" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Adults <small>12 years +</small></label>
                                                                            <select class="form-control adult_passengers">
                                                                                <option selected="selected" value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Children <small>2 - 11 years</small></label>
                                                                            <select class="form-control child_passengers">
                                                                                <option value="0" selected="selected">0</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Infants <small>below 2 years</small></label>
                                                                            <select class="form-control infant_passengers">
                                                                                < <option value="0" selected="selected">0</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="flight-search-2">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>From</label>
                                                                        <input class="typeahead form-control departure_airport" placeholder="City, Airport, U.S. Zip" value="" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>To</label>
                                                                        <input class="typeahead form-control arrival_airport" placeholder="City, Airport, U.S. Zip" value="" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>Departing</label>
                                                                        <input class="date-pick form-control departure_date" data-date-format="M d, D" value="" type="text" />
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" class="arrival_date" value=""/>
                                                                <div class="col-md-3">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Adults <small>12 years +</small></label>
                                                                        <select class="form-control adult_passengers">
                                                                            <option selected="selected" value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Children <small>2 - 11 years</small></label>
                                                                        <select class="form-control child_passengers">
                                                                            <option value="0" selected="selected">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Infants <small>below 2 years</small></label>
                                                                        <select class="form-control infant_passengers">
                                                                            < <option value="0" selected="selected">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-lg search_flight" type="button">Search for Flights</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="tab-2">
                                            <h2>Search and Save on Hotels</h2>
                                            <form>
                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                    <label>Where are you going?</label>
                                                    <input class="typeahead form-control" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" />
                                                </div>
                                                <div class="input-daterange" data-date-format="M d, D">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>Check-in</label>
                                                                <input class="form-control" name="start" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>Check-out</label>
                                                                <input class="form-control" name="end" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                <label>Rooms</label>
                                                                <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                    <label class="btn btn-primary active">
                                                                        <input type="radio" name="options" />1</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />2</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3+</label>
                                                                </div>
                                                                <select class="form-control hidden">
                                                                    <option selected="selected">1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                    <option>6</option>
                                                                    <option>7</option>
                                                                    <option>8</option>
                                                                    <option>9</option>
                                                                    <option>10</option>
                                                                    <option>11</option>
                                                                    <option>12</option>
                                                                    <option>13</option>
                                                                    <option>14</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                <label>Guests</label>
                                                                <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                    <label class="btn btn-primary active">
                                                                        <input type="radio" name="options" />1</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />2</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3+</label>
                                                                </div>
                                                                <select class="form-control hidden">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option selected="selected">4</option>
                                                                    <option>5</option>
                                                                    <option>6</option>
                                                                    <option>7</option>
                                                                    <option>8</option>
                                                                    <option>9</option>
                                                                    <option>10</option>
                                                                    <option>11</option>
                                                                    <option>12</option>
                                                                    <option>13</option>
                                                                    <option>14</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-lg" type="submit">Search for Hotels</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="tab-3">
                                            <h2>Find Your Perfect Home</h2>
                                            <form>
                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                    <label>Where are you going?</label>
                                                    <input class="typeahead form-control" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" />
                                                </div>
                                                <div class="input-daterange" data-date-format="M d, D">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>Check-in</label>
                                                                <input class="form-control" name="start" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>Check-out</label>
                                                                <input class="form-control" name="end" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                <label>Rooms</label>
                                                                <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                    <label class="btn btn-primary active">
                                                                        <input type="radio" name="options" />1</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />2</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3+</label>
                                                                </div>
                                                                <select class="form-control hidden">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option selected="selected">4</option>
                                                                    <option>5</option>
                                                                    <option>6</option>
                                                                    <option>7</option>
                                                                    <option>8</option>
                                                                    <option>9</option>
                                                                    <option>10</option>
                                                                    <option>11</option>
                                                                    <option>12</option>
                                                                    <option>13</option>
                                                                    <option>14</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                <label>Guests</label>
                                                                <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                    <label class="btn btn-primary active">
                                                                        <input type="radio" name="options" />1</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />2</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3</label>
                                                                    <label class="btn btn-primary">
                                                                        <input type="radio" name="options" />3+</label>
                                                                </div>
                                                                <select class="form-control hidden">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option selected="selected">4</option>
                                                                    <option>5</option>
                                                                    <option>6</option>
                                                                    <option>7</option>
                                                                    <option>8</option>
                                                                    <option>9</option>
                                                                    <option>10</option>
                                                                    <option>11</option>
                                                                    <option>12</option>
                                                                    <option>13</option>
                                                                    <option>14</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-lg" type="submit">Search for Vacation Rentals</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="tab-4">
                                            <h2>Search for Cheap Rental Cars</h2>
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                            <label>Pick-up Location</label>
                                                            <input class="typeahead form-control" placeholder="City, Airport, U.S. Zip" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                            <label>Drop-off Location</label>
                                                            <input class="typeahead form-control" placeholder="City, Airport, U.S. Zip" type="text" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-daterange" data-date-format="M d, D">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>Pick-up Date</label>
                                                                <input class="form-control" name="start" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                                                                <label>Pick-up Time</label>
                                                                <input class="time-pick form-control" value="12:00 AM" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>Drop-off Date</label>
                                                                <input class="form-control" name="end" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                                                                <label>Drop-off Time</label>
                                                                <input class="time-pick form-control" value="12:00 AM" type="text" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-lg" type="submit">Search for Rental Cars</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="tab-5">
                                            <h2>Search for Activities</h2>
                                            <form>
                                                <div class="input-daterange" data-date-format="M d, D">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                <label>Where are you going?</label>
                                                                <input class="typeahead form-control" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>From</label>
                                                                <input class="form-control" name="start" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                <label>To</label>
                                                                <input class="form-control" name="end" type="text" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-lg" type="submit">Search for Activities</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOP AREA  -->

    <div class="gap"></div>


    <div class="container">
        <div class="row row-wrap" data-gutter="60">
            <div class="col-md-4">
                <div class="thumb">
                    <header class="thumb-header"><i class="fa fa-dollar box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
                    </header>
                    <div class="thumb-caption">
                        <h5 class="thumb-title"><a class="text-darken" href="#">Best Price Guarantee</a></h5>
                        <p class="thumb-desc">Eu lectus non vivamus ornare lacinia elementum faucibus natoque parturient ullamcorper placerat</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumb">
                    <header class="thumb-header"><i class="fa fa-lock box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
                    </header>
                    <div class="thumb-caption">
                        <h5 class="thumb-title"><a class="text-darken" href="#">Trust & Safety</a></h5>
                        <p class="thumb-desc">Imperdiet nisi potenti fermentum vehicula eleifend elementum varius netus adipiscing neque quisque</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumb">
                    <header class="thumb-header"><i class="fa fa-thumbs-o-up box-icon-md round box-icon-black animate-icon-top-to-bottom"></i>
                    </header>
                    <div class="thumb-caption">
                        <h5 class="thumb-title"><a class="text-darken" href="#">Best Travel Agent</a></h5>
                        <p class="thumb-desc">Curae urna fusce massa a lacus nisl id velit magnis venenatis consequat</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap gap-small"></div>
    </div>
    <div class="bg-holder">
        <div class="bg-mask"></div>
        <div class="bg-parallax" style="background-image:url(img/hotel_the_cliff_bay_spa_suite_2048x1310.jpg);"></div>
        <div class="bg-content">
            <div class="container">
                <div class="gap gap-big text-center text-white">
                    <h2 class="text-uc mb20">Last Minute Deal</h2>
                    <ul class="icon-list list-inline-block mb0 last-minute-rating">
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
                    <h5 class="last-minute-title">The Peninsula - New York</h5>
                    <p class="last-minute-date">Fri 14 Mar - Sun 16 Mar</p>
                    <p class="mb20"><b>$120</b> / person</p><a class="btn btn-lg btn-white btn-ghost" href="#">Book Now <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="gap"></div>
        <h2 class="text-center">Top Destinations</h2>
        <div class="gap">
            <div class="row row-wrap">
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="{{url('img/the_journey_home_400x300.jpg')}}" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Africa</h4>
                            <p class="thumb-desc">Ut blandit pharetra suspendisse montes libero eleifend bibendum</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="{{url('img/upper_lake_in_new_york_central_park_800x600.jpg')}}" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">USA</h4>
                            <p class="thumb-desc">Cursus faucibus egestas rutrum mauris vulputate consequat ante</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="{{url('img/people_on_the_beach_800x600.jpg')}}" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Australia</h4>
                            <p class="thumb-desc">Senectus hendrerit torquent lorem scelerisque quam a curae</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="{{url('img/lack_of_blue_depresses_me_800x600.jpg')}}" alt="Image Alternative text" title="lack of blue depresses me" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Greece</h4>
                            <p class="thumb-desc">Penatibus ac lacinia platea cras lobortis nullam dapibus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection