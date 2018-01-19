@extends('layouts.app')
@section('title') {{$name}} Details @endsection
@section('activeAttraction')  active @endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a>
            </li>
            <li><a href="{{url('/attractions')}}">Attractions</a>
            </li>
            <li><a href="#">{{\App\PackageCategory::find($attraction_info->package_category_id)->category}}</a>
            </li>
            <li class="active"><a>{{$name}}</a>
            </li>
        </ul>
        <div class="booking-item-details">
            <header class="booking-item-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="lh1em">{{$name}}</h2>
                        <p class="lh1em text-small"><i class="fa fa-map-marker"></i>{{$attraction_info->info}}</p>
                        <ul class="list list-inline text-small">
                            {{--<li><a href="#"><i class="fa fa-envelope"></i> Owner E-mail</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#"><i class="fa fa-home"></i> Owner Website</a>--}}
                            {{--</li>--}}
                            <li><i class="fa fa-phone"></i> {{$attraction_info->phone_number}}</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="booking-item-header-price"><small>price from</small>  <span class="text-lg"> &#x20A6;{{number_format($attraction_info->adult_price)}}</span>
                        </p>
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-md-7">
                    <div class="tabbable booking-details-tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i>Photos</a>
                            </li>
                            <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i>On the Map</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-1">
                                <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
                                    <img src="{{asset($images[0]['image_path'])}}" alt="{{"Why"}}" title="{{$name}}"/>
                                    <img src="{{asset('img/upper_lake_in_new_york_central_park_800x600.jpg')}}" alt="Image Alternative text" title="Upper Lake in New York Central Park" />
                                    <img src="{{asset('img/new_york_at_an_angle_800x600.jpg')}}" alt="Image Alternative text" title="new york at an angle" />
                                    <img src="{{asset('img/pictures_at_the_museum_800x600.jpg')}}" alt="Image Alternative text" title="Pictures at the museum" />
                                    <img src="{{asset('img/plunklock_live_in_cologne_800x600.jpg')}}" alt="Image Alternative text')}}" title="Plunklock live in Cologne" />
                                    <img src="{{asset('img/amaze_800x600.jpg')}}" alt="Image Alternative text" title="AMaze'" />
                                    <img src="{{asset('img/old_no7_800x600.jpg')}}" alt="Image Alternative text" title="Old No7" />
                                    <img src="{{asset('img/the_big_showoff-take_2_800x600.jpg')}}" alt="Image Alternative text" title="The Big Showoff-Take 2" />
                                    <img src="{{asset('img/4_strokes_of_fun_800x600.jpg')}}" alt="Image Alternative text" title="4 Strokes of Fun" />
                                    <img src="{{asset('img/me_with_the_uke_800x600.jpg')}}" alt="Image Alternative text" title="Me with the Uke" />
                                @if(isset($images[0]))
                                     @foreach($images as $image)
                                            <img src="{{asset($image['image_path'])}}" alt="{{"Why"}}" title="{{$name}}"/>
                                        @endforeach
                                    @else
                                        <img src="{{asset('images/gallery/packages/no-image.jpg')}}" alt="No image available for this attraction" title="No image available for this attraction" />
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="google-map-tab">
                                <div id="map-canvas" style="width:100%; height:500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="booking-item-meta">
                        <h2 class="lh1em mt40">Exeptional!</h2>
                        <h3>97% <small >of guests recommend</small></h3>
                        <div class="booking-item-rating">
                            <ul class="icon-list icon-group booking-item-rating-stars">
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
                            </ul><span class="booking-item-rating-number"><b >4.7</b> of 5 <small class="text-smaller">guest rating</small></span>
                            <p><a class="text-default" href="#">based on 1535 reviews</a>
                            </p>
                        </div>
                    </div>
                    <div class="gap gap-small">
                        <h3>Owner description</h3>
                        <p>Dictumst sit auctor sodales suspendisse nullam facilisi magnis pretium malesuada sit cum id dapibus ac est ullamcorper suscipit per senectus ultricies et diam eu massa orci habitasse nostra elit phasellus mus euismod elementum nisl nulla et blandit cras torquent aliquam tempor malesuada egestas montes dolor integer vehicula et curae auctor</p>
                    </div>
                    <a href="#" class="btn btn-primary btn-lg">Book</a>
                </div>
            </div>
        </div>
        {{--<div class="gap"></div>--}}
        {{--<h3 class="mb20">Activity Reviews</h3>
        <div class="row row-wrap">
            <div class="col-md-8">
                <ul class="booking-item-reviews list">
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/afro_70x70.jpg" alt="Image Alternative text" title="Afro" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">John Doe</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">90 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Vivamus gravida lorem vivamus vehicula lorem suspendisse"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>Maecenas aenean curae habitant sollicitudin nascetur tempor aenean eu interdum netus magnis mauris tortor ridiculus sodales rhoncus tempus imperdiet penatibus purus platea turpis aptent pharetra dictumst fames non etiam porta aliquet justo rhoncus augue blandit augue suspendisse<span class="booking-item-review-more"> Penatibus ullamcorper phasellus rutrum fames magna semper enim fusce etiam netus maecenas nostra erat neque dis luctus tincidunt torquent non rhoncus cras consequat leo sit maecenas habitant ultrices malesuada torquent dictum quam cras sit porttitor</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Curae natoque eros mauris suspendisse curabitur pellentesque posuere augue primis vulputate tellus metus odio proin congue lacinia pretium sollicitudin ac magnis feugiat sed pellentesque vel facilisis natoque pellentesque mauris vivamus nostra condimentum interdum dui turpis netus gravida gravida ultrices dolor montes duis non mollis primis dapibus litora</p>
                                        <p>Porta congue aptent laoreet est ipsum donec a fusce suscipit lorem conubia mattis curae dolor etiam tempus molestie eleifend lacus aliquet porttitor turpis ante auctor tincidunt augue condimentum neque sed augue arcu pellentesque per quis torquent tristique donec ligula at inceptos odio adipiscing morbi purus per scelerisque semper aliquam mi</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 19</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/bubbles_70x70.jpg" alt="Image Alternative text" title="Bubbles" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">Minnie Aviles</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">50 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Nullam sit suspendisse ut sollicitudin aptent"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>Felis condimentum felis lobortis a quis hendrerit mollis a congue sociosqu eget ullamcorper tempus blandit accumsan sociis facilisi vel suscipit habitant arcu ridiculus eget nam integer inceptos commodo aptent amet dapibus ut ut dis urna potenti sagittis neque<span class="booking-item-review-more"> Adipiscing tincidunt potenti justo facilisi lectus facilisis lacinia blandit sociis odio senectus enim aliquam feugiat feugiat consequat mauris litora curabitur mollis elit nunc aenean suspendisse porta urna cursus ullamcorper sit velit eu aptent consectetur scelerisque nisl conubia metus</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Arcu sollicitudin lobortis mi senectus eget ultricies blandit phasellus litora sociosqu phasellus proin risus arcu est nec</p>
                                        <p>Tincidunt ultricies feugiat facilisis ac etiam semper malesuada taciti lobortis dui est per fringilla maecenas dis cubilia duis class iaculis massa vitae ad ipsum luctus ut praesent imperdiet etiam vel dapibus tristique nulla hendrerit sociis ante pretium ad placerat justo felis enim dignissim condimentum nisl ullamcorper fermentum posuere felis habitant</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 20</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/gamer_chick_70x70.jpg" alt="Image Alternative text" title="Gamer Chick" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">Cyndy Naquin</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">95 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Mollis faucibus penatibus"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>Inceptos senectus mauris himenaeos interdum nunc ipsum parturient duis varius nisi eget dictum dui dapibus felis conubia lacinia posuere orci interdum aliquet<span class="booking-item-review-more"> Felis ipsum tellus aenean nibh hac suscipit suspendisse nulla platea dis malesuada vulputate convallis erat justo semper tortor taciti netus pharetra potenti himenaeos lorem penatibus sagittis nostra amet iaculis sodales vehicula rhoncus turpis condimentum dolor nostra sollicitudin eu primis aptent facilisis nisi iaculis aptent sollicitudin ridiculus luctus bibendum nibh adipiscing</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Tempus congue consequat auctor ut nisl molestie convallis luctus molestie justo ultrices suscipit hendrerit tellus penatibus turpis auctor maecenas</p>
                                        <p>Augue viverra consequat hac id ultricies luctus augue euismod auctor nulla purus adipiscing etiam massa vehicula fames tempor non risus habitant potenti tortor sociis tellus cras sodales dui commodo volutpat</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 16</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/good_job_70x70.jpg" alt="Image Alternative text" title="Good job" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">Carol Blevins</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">27 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Interdum magnis purus non"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>At sagittis aliquam sollicitudin rutrum placerat pharetra amet aliquam et tortor amet risus cubilia ipsum dignissim magna inceptos lectus feugiat cubilia nullam porttitor sapien dignissim ultricies ipsum leo nulla tempus facilisi<span class="booking-item-review-more"> Nostra tincidunt nisi nascetur cum venenatis penatibus varius in fermentum dapibus ornare dictumst ultricies praesent in tempus enim in interdum felis erat sapien integer sociis justo accumsan nisi et porttitor orci potenti volutpat neque rutrum vestibulum senectus ad ad bibendum consectetur maecenas leo et posuere vel penatibus enim vehicula</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Tempus quisque enim pharetra elit fusce vivamus elementum mauris luctus pellentesque luctus penatibus risus accumsan purus cum fusce enim tellus vehicula purus commodo donec metus commodo rhoncus nisi sollicitudin volutpat viverra imperdiet imperdiet massa vestibulum ipsum consectetur enim lacus adipiscing magnis felis</p>
                                        <p>Nisi arcu malesuada euismod dictum tellus nibh et integer facilisis quam suscipit viverra phasellus laoreet conubia cubilia tellus nulla placerat nibh dolor rhoncus nullam nam mi suscipit montes quis dictumst gravida mi interdum ad donec diam eget iaculis ullamcorper nec laoreet commodo lacus fringilla quam mi egestas mi in mattis est quisque augue in aenean conubia aenean accumsan lorem dui</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 15</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/amaze_70x70.jpg" alt="Image Alternative text" title="AMaze" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">Cheryl Gustin</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">20 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Venenatis praesent auctor"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>Consequat class habitant sapien laoreet cum enim congue eros fusce et viverra dictumst in quam tincidunt fames mauris mi sagittis donec laoreet velit<span class="booking-item-review-more"> Curae vulputate himenaeos tempor venenatis erat aliquet nullam per bibendum pellentesque aptent enim auctor vehicula massa diam fermentum consequat senectus ipsum ipsum tristique habitant lacinia ligula mauris ultricies dictumst aliquam per tortor cursus elementum netus consectetur feugiat per volutpat turpis cum justo</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Class cras netus bibendum nostra convallis consequat quam risus purus potenti adipiscing facilisi felis sociosqu vivamus imperdiet platea ligula eget risus dui amet suspendisse phasellus pretium natoque litora semper natoque magnis cras integer nibh</p>
                                        <p>Scelerisque lobortis curae cras varius nam fames amet torquent a nam penatibus conubia tempus cras sociosqu nisl sed quisque tristique sed suscipit ornare potenti placerat nunc mauris nisl pretium egestas nibh lacinia tempus eget neque mauris odio pulvinar potenti pretium vehicula habitasse porta imperdiet euismod curae</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 7</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/chiara_70x70.jpg" alt="Image Alternative text" title="Chiara" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">Joe Smith</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">69 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Quisque habitasse nunc quam nulla vestibulum laoreet"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>Egestas magna augue phasellus dapibus commodo accumsan senectus placerat parturient nunc sodales hendrerit tempor est dolor facilisis volutpat ridiculus tempor bibendum potenti maecenas feugiat sem eros enim mi augue habitasse interdum varius vestibulum dui sem montes blandit morbi scelerisque scelerisque<span class="booking-item-review-more"> Mi netus dui phasellus tempor ante inceptos ornare eleifend cum dis phasellus dictumst nisl velit elementum sociosqu odio mauris facilisis ridiculus venenatis egestas fermentum blandit sed ultricies eu id tempor velit ornare pulvinar integer dapibus imperdiet quisque class tortor vestibulum mollis diam vulputate hac per himenaeos scelerisque aenean elementum tincidunt curae vehicula sollicitudin leo ipsum neque neque et ipsum tristique</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Ante augue magna iaculis feugiat blandit magnis vitae adipiscing ad risus cursus egestas bibendum dapibus ullamcorper metus ac adipiscing platea ad ac dictum lobortis facilisi sed vivamus potenti ligula nostra et in blandit curabitur inceptos vitae facilisi ornare dolor laoreet pellentesque sem aenean eleifend etiam taciti</p>
                                        <p>Praesent gravida quam metus nulla eget cursus ac natoque taciti consectetur aliquet ultrices praesent porttitor sociis mattis quis massa congue placerat libero nunc bibendum eu rhoncus per maecenas pellentesque diam potenti mauris ornare ornare habitasse ullamcorper nibh orci platea tempus gravida cras felis cum eleifend nisl fermentum ultricies conubia a facilisis ut gravida sed habitant</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 6</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-review-person">
                                    <a class="booking-item-review-person-avatar round" href="#">
                                        <img src="img/me_with_the_uke_70x70.jpg" alt="Image Alternative text" title="Me with the Uke" />
                                    </a>
                                    <p class="booking-item-review-person-name"><a href="#">Ava McDonald</a>
                                    </p>
                                    <p class="booking-item-review-person-loc">Palm Beach, FL</p><small><a href="#">42 Reviews</a></small>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="booking-item-review-content">
                                    <h5>"Inceptos pulvinar vivamus aptent"</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                    <p>Aenean pellentesque vulputate metus ante vehicula senectus fusce diam varius urna nibh nunc maecenas euismod tincidunt convallis ultricies hac felis torquent congue consectetur lobortis odio iaculis aenean laoreet neque natoque arcu semper leo aliquet platea<span class="booking-item-review-more"> Porttitor libero nulla tempor platea felis pellentesque class tellus erat a faucibus sociosqu volutpat vulputate volutpat placerat proin lorem congue ac dui sagittis convallis tortor orci risus adipiscing vel purus sagittis eros eros proin per sed justo fringilla quis convallis metus quam tortor donec curae pretium laoreet magnis</span>
                                    </p>
                                    <div class="booking-item-review-more-content">
                                        <p>Lacus libero donec vitae ultricies penatibus natoque condimentum pulvinar neque hac suspendisse litora ullamcorper ultrices porttitor dignissim tincidunt class non metus duis eget amet morbi conubia</p>
                                        <p>Cursus vivamus suspendisse feugiat enim tempus morbi amet fermentum potenti duis vulputate primis velit vel in felis nascetur habitant venenatis lacinia adipiscing malesuada ultrices torquent euismod a viverra augue sociis vehicula iaculis sem nullam urna sem lectus cras amet mattis sem fringilla tempus dis eros phasellus mollis augue ornare curabitur non tempus facilisis duis</p>
                                        <p class="text-small mt20">Stayed March 2014, traveled as a couple</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Sleep</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o text-gray"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Location</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Service</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list booking-item-raiting-summary-list">
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Clearness</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="booking-item-raiting-list-title">Rooms</div>
                                                        <ul class="icon-group booking-item-rating-stars">
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                            <li><i class="fa fa-smile-o"></i>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-review-expand"><span class="booking-item-review-expand-more">More <i class="fa fa-angle-down"></i></span><span class="booking-item-review-expand-less">Less <i class="fa fa-angle-up"></i></span>
                                    </div>
                                    <p class="booking-item-review-rate">Was this review helpful?
                                        <a class="fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> 8</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="row wrap">
                    <div class="col-md-5">
                        <p><small>1261 reviews on this activity. &nbsp;&nbsp;Showing 1 to 7</small>
                        </p>
                    </div>
                    <div class="col-md-7">
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
                </div>
                <div class="gap gap-small"></div>
                <div class="box bg-gray">
                    <h3>Write a Review</h3>
                    <form>
                        <div class="form-group">
                            <label>Review Title</label>
                            <input class="form-control" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Review Text</label>
                            <textarea class="form-control" rows="6"></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Leave a Review" />
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Activities Near</h4>
                <ul class="booking-list">
                    <li>
                        <div class="booking-item booking-item-small">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="img/upper_lake_in_new_york_central_park_800x600.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" />
                                </div>
                                <div class="col-xs-5">
                                    <h5 class="booking-item-title">Central Park Trip</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                </div>
                                <div class="col-xs-3"><span class="booking-item-price">Free</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item booking-item-small">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="img/new_york_at_an_angle_800x600.jpg" alt="Image Alternative text" title="new york at an angle" />
                                </div>
                                <div class="col-xs-5">
                                    <h5 class="booking-item-title">Manhattan Skyline</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                </div>
                                <div class="col-xs-3"><span class="booking-item-price">Free</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item booking-item-small">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="img/department_of_theatre_arts_800x600.jpg" alt="Image Alternative text" title="Department of Theatre Arts" />
                                </div>
                                <div class="col-xs-5">
                                    <h5 class="booking-item-title">Beautiful - The Carole King Musical</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                </div>
                                <div class="col-xs-3"><span class="booking-item-price">$100</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item booking-item-small">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="img/food_is_pride_800x600.jpg" alt="Image Alternative text" title="Food is Pride" />
                                </div>
                                <div class="col-xs-5">
                                    <h5 class="booking-item-title">Food is Prime</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                </div>
                                <div class="col-xs-3"><span class="booking-item-price">$100</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="booking-item booking-item-small">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="img/me_with_the_uke_800x600.jpg" alt="Image Alternative text" title="Me with the Uke" />
                                </div>
                                <div class="col-xs-5">
                                    <h5 class="booking-item-title">Ukle Master Class</h5>
                                    <ul class="icon-group booking-item-rating-stars">
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
                                </div>
                                <div class="col-xs-3"><span class="booking-item-price">Free</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>--}}
        <div class="gap gap-small"></div>
    </div>
    <script>
        var customLatitude = '6.45407';
        var customLongitude = '3.39467';
    </script>
@endsection