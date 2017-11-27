@extends('layouts.app')
@section('content')
    <pre>
        {{\App\Services\SabreFlight::sortFlightArray($flightsResult)}}
    {{die}}
        </pre>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}.html">Home</a>
            </li>
            <li><a href="#">United States</a>
            </li>
            <li><a href="#">New York (NY)</a>
            </li>
            <li><a href="#">New York City</a>
            </li>
            <li class="active">New York City Flights</li>
        </ul>
        <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog">
            <h3>Search for Flight</h3>
            <form>
                <div class="tabbable">
                    <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                        <li class="active"><a href="#flight-search-1" data-toggle="tab">Round Trip</a>
                        </li>
                        <li><a href="#flight-search-2" data-toggle="tab">One Way</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="flight-search-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                        <label>From</label>
                                        <input class="typeahead form-control" placeholder="City, Airport or U.S. Zip Code" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                        <label>To</label>
                                        <input class="typeahead form-control" placeholder="City, Airport or U.S. Zip Code" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="input-daterange" data-date-format="MM d, D">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                            <label>Departing</label>
                                            <input class="form-control" name="start" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                            <label>Returning</label>
                                            <input class="form-control" name="end" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-lg form-group-select-plus">
                                            <label>Passengers</label>
                                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="options" />1</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />2</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />3</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />4</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />5</label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="options" />5+</label>
                                            </div>
                                            <select class="form-control hidden">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option selected="selected">6</option>
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
                        </div>
                        <div class="tab-pane fade" id="flight-search-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                        <label>From</label>
                                        <input class="typeahead form-control" placeholder="City, Airport or U.S. Zip Code" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                        <label>To</label>
                                        <input class="typeahead form-control" placeholder="City, Airport or U.S. Zip Code" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                        <label>Departing</label>
                                        <input class="date-pick form-control" data-date-format="MM d, D" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-lg form-group-select-plus">
                                        <label>Passengers</label>
                                        <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                            <label class="btn btn-primary active">
                                                <input type="radio" name="options" />1</label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" />2</label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" />3</label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" />4</label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" />5</label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" />5+</label>
                                        </div>
                                        <select class="form-control hidden">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option selected="selected">6</option>
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
                    </div>
                </div>
                <button class="btn btn-primary btn-lg" type="submit">Search for Flights</button>
            </form>
        </div>
        <h3 class="booking-title">12 Flights from London to New York on Mar 22 for 1 adult <small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Change search</a></small></h3>
        <div class="row">
            <div class="col-md-3">
                <aside class="booking-filters text-white">
                    <h3>Filter By:</h3>
                    <ul class="list booking-filters-list">
                        <li>
                            <h5 class="booking-filters-title">Stops <small>Price from</small></h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Non-stop<span class="pull-right">$215</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />1 Stop<span class="pull-right">$154</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />2+ Stops<span class="pull-right">$197</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Price </h5>
                            <input type="text" id="price-slider">
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Flight Class <small>Price from</small></h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Economy<span class="pull-right">$154</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Business<span class="pull-right">$316</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />First<span class="pull-right">$450</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Airlines <small>Price from</small></h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Lufthansa<span class="pull-right">$215</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />American Airlines<span class="pull-right">$350</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Airfrance<span class="pull-right">$154</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Croatia Airlines<span class="pull-right">$197</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Delta<span class="pull-right">$264</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Air Canada<span class="pull-right">$445</span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <h5 class="booking-filters-title">Departure Time</h5>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Morning (5:00a - 11:59a)</label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Afternoon (12:00p - 5:59p)</label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Evening (6:00p - 11:59p)</label>
                            </div>
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9">
                <div class="nav-drop booking-sort">
                    <h5 class="booking-sort-title"><a href="#">Sort: Sort: Price (low to high)<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a></h5>
                    <ul class="nav-drop-menu">
                        <li><a href="#">Price (high to low)</a>
                        </li>
                        <li><a href="#">Duration</a>
                        </li>
                        <li><a href="#">Stops</a>
                        </li>
                        <li><a href="#">Arrival</a>
                        </li>
                        <li><a href="#">Departure</a>
                        </li>
                    </ul>
                </div>
                <ul class="booking-list">
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/lufthansa.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Lufthansa</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>non-stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$307</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Economy</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/lufthansa.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Lufthansa</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>2 stops</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$486</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/airfrance.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Airfrance</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>non-stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$474</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/lufthansa.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Lufthansa</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>1 stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$195</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: First</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/american-airlines.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>American Airlines</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>non-stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$317</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: First</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/american-airlines.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>American Airlines</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>non-stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$291</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Economy</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/airfrance.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Airfrance</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>2 stops</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$278</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/aircanada.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Air Canada</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>non-stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$392</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/delta.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Delta</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>1 stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$161</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Business</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/american-airlines.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>American Airlines</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>non-stop</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$219</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: Economy</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item-container">
                            <div class="booking-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="booking-item-airline-logo">
                                            <img src="img/croatia.jpg" alt="Image Alternative text" title="Image Title" />
                                            <p>Croatia Airlines</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5>10:25 PM</h5>
                                                <p class="booking-item-date">Sun, Mar 22</p>
                                                <p class="booking-item-destination">London, England, United Kingdom (LHR)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5>12:25 PM</h5>
                                                <p class="booking-item-date">Sat, Mar 23</p>
                                                <p class="booking-item-destination">New York, NY, United States (JFK)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>22h 50m</h5>
                                        <p>2 stops</p>
                                    </div>
                                    <div class="col-md-3"><span class="booking-item-price">$447</span><span>/person</span>
                                        <p class="booking-item-flight-class">Class: First</p><a class="btn btn-primary" href="#">Select</a>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-item-details">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Flight Details</p>
                                        <h5 class="list-title">London (LHR) to Charlotte (CLT)</h5>
                                        <ul class="list">
                                            <li>US Airways 731</li>
                                            <li>Economy / Coach Class ( M), AIRBUS INDUSTRIE A330-300</li>
                                            <li>Depart 09:55 Arrive 15:10</li>
                                            <li>Duration: 9h 15m</li>
                                        </ul>
                                        <h5>Stopover: Charlotte (CLT) 7h 1m</h5>
                                        <h5 class="list-title">Charlotte (CLT) to New York (JFK)</h5>
                                        <ul class="list">
                                            <li>US Airways 1873</li>
                                            <li>Economy / Coach Class ( M), Airbus A321</li>
                                            <li>Depart 22:11 Arrive 23:53</li>
                                            <li>Duration: 1h 42m</li>
                                        </ul>
                                        <p>Total trip time: 17h 58m</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <p class="text-right">Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                </p>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection