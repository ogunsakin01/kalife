<div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="flight-search-dialog">
    <h3>Search for Flight</h3>
    <form>
        <div class="tabbable">
            <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                <li class="active"><a href="#flight-search-1" data-toggle="tab" class="trip_type">Round Trip</a>
                </li>
                <li><a href="#flight-search-2" data-toggle="tab" class="trip_type">One Way</a>
                </li>
                <li><a data-toggle="tab" class="popup-text trip_type" href="#multi-city-dialog" data-effect="mfp-zoom-out">Multi City</a>
                </li>
            </ul>
            <div class="tab-content">
                <input type="hidden" class="flight_type" value="Round Trip"/>
                <div class="tab-pane fade in active" id="flight-search-1">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                <label>From</label>
                                <input class="typeahead form-control" id="departure_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                <label>To</label>
                                <input class="typeahead form-control" id="arrival_airport" value="" placeholder="City, Airport, U.S. Zip" type="text" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-lg form-group-select-plus">
                                <label>Cabin Type</label>
                                <select class="form-control cabin_type">
                                    <option selected="selected" value="Y">Economy</option>
                                    <option value="S">Premium Economy</option>
                                    <option value="C">Business</option>
                                    <option value="J">Premium Business</option>
                                    <option value="F">First</option>
                                    <option value="P">Premium First</option>
                                </select>
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
                                    <input class="form-control return_date" value="" name="end" type="text" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group form-group-lg form-group-select-plus">
                                    <label>Adults </label>
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
                                    <label>Children </label>
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
                                    <label>Infants </label>
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
                        <div class="col-md-5">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                <label>From</label>
                                <input class="typeahead form-control" id="departure_airport_one" placeholder="City, Airport, U.S. Zip" value="" type="text" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                <label>To</label>
                                <input class="typeahead form-control" id="arrival_airport_one" placeholder="City, Airport, U.S. Zip" value="" type="text" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form-group-lg form-group-select-plus">
                                <label>Cabin Type</label>
                                <select class="form-control cabin_type_one">
                                    <option selected="selected" value="Y">Economy</option>
                                    <option value="S">Premium Economy</option>
                                    <option value="C">Business</option>
                                    <option value="J">Premium Business</option>
                                    <option value="F">First</option>
                                    <option value="P">Premium First</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                <label>Departing</label>
                                <input class="date-pick form-control departure_date_one" data-date-format="M d, D" value="" type="text" />
                            </div>
                        </div>
                        <input type="hidden" class="arrival_date_one" value=""/>
                        <div class="col-md-3">
                            <div class="form-group form-group-lg form-group-select-plus">
                                <label>Adults <small>12 years +</small></label>
                                <select class="form-control adult_passengers_one">
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
                                <select class="form-control child_passengers_one">
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
                                <select class="form-control infant_passengers_one">
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