@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">Top Flight Deals</li>
        </ul>
        <h3 class="booking-title">530 things to do in New York on Mar 22 - Apr 17</h3>
        <div class="row">
            <div class="col-md-12">
                {{--php artisian serve--}}
                <div class="row row-wrap page-content">
                    <div class="col-md-3 page-content-1">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/new_york_at_an_angle_800x600.jpg" alt="Image Alternative text" title="new york at an angle" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Manhattan Skyline</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Queens (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> Free</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-2">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/pictures_at_the_museum_800x600.jpg" alt="Image Alternative text" title="Pictures at the museum" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">The Metropolitan Museum of Art</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Ozone Park, NY (Kennedy Airport (JFK))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$35</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-3">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/department_of_theatre_arts_800x600.jpg" alt="Image Alternative text" title="Department of Theatre Arts" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Beautiful - The Carole King...</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Times Square)</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> $100</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-4">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/plunklock_live_in_cologne_800x600.jpg" alt="Image Alternative text" title="Plunklock live in Cologne" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">After Midnight</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Times Square)</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >average</small> $350</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-5">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/me_with_the_uke_800x600.jpg" alt="Image Alternative text" title="Me with the Uke" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Ukle Master Class</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Midtown East)</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">Free</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-6">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/amaze_800x600.jpg" alt="Image Alternative text" title="AMaze" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Fashion Glasses Showcase</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Jamaica, NY (Kennedy Airport (JFK))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">Free</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-7">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/old_no7_800x600.jpg" alt="Image Alternative text" title="Old No7" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Old No7 Bar</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Queens (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >average</small> $100</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-8">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/bubbles_800x600.jpg" alt="Image Alternative text" title="Bubbles" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Music Festival</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Flushing, NY (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> $50</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-9">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/food_is_pride_800x600.jpg" alt="Image Alternative text" title="Food is Pride" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Food is Prime</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Chelsea)</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$100</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-10">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/spidy_800x600.jpg" alt="Image Alternative text" title="Spidy" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Marvel Heros is Here!</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> East Elmhurst, NY (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$700</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-11">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/street_yoga_800x600.jpg" alt="Image Alternative text" title="Street Yoga" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Street Yoga</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Queens (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >from</small> $115</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-12">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/trebbiano_ristorante_-_japenese_breakfast_800x600.jpg" alt="Image Alternative text" title="Trebbiano Ristorante - japenese breakfast" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Tea Ceremony</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Jamaica, NY (Kennedy Airport (JFK))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$300</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-13">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/the_big_showoff-take_2_800x600.jpg" alt="Image Alternative text" title="The Big Showoff-Take 2" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Extreme Biking</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> East Elmhurst, NY (LaGuardia Airport (LGA))</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color"><small >average</small> $185</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-14">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/upper_lake_in_new_york_central_park_800x600.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Central Park Trip</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> Bronx (Bronx)</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">Free</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 page-content-15">
                        <div class="thumb">
                            <header class="thumb-header">
                                <a class="hover-img" href="#">
                                    <img src="img/4_strokes_of_fun_800x600.jpg" alt="Image Alternative text" title="4 Strokes of Fun" />
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
                                <h5 class="thumb-title"><a class="text-darken" href="#">Adrenaline Madness</a></h5>
                                <p class="mb0"><small><i class="fa fa-map-marker"></i> New York, NY (Chelsea)</small>
                                </p>
                                <p class="mb0 text-darken"><span class="text-lg lh1em text-color">$105</span>  <small> /person</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><small>530 things to do in New York. &nbsp;&nbsp;Showing 1 – 15</small>
                        </p>
                        <ul class="pagination">
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">6</a>
                            </li>
                            <li><a href="#">7</a>
                            </li>
                            <li class="dots">...</li>
                            <li><a href="#">43</a>
                            </li>
                            <li class="next"><a href="#">Next Page</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection