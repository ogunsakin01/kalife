<header id="main-header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a class="logo" href="">
                        <img src="{{url('img/logo-invert.png')}}" alt="Image Alternative text" title="Image Title" />
                    </a>
                </div>
                <div class="col-md-3 col-md-offset-2">
                    <form class="main-header-search">
                        <div class="form-group form-group-icon-left">
                            <i class="fa fa-search input-icon"></i>
                            <input type="text" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="top-user-area clearfix">
                        <ul class="top-user-area-list list list-horizontal list-border">
                            <li class="top-user-area-avatar">
                                <a href="user-profile.html">
                                    <img class="origin round" src="{{url('img/amaze_40x40.jpg')}}" alt="Image Alternative text" title="AMaze" />Hi, John</a>
                            </li>
                            <li><a href="#">Sign Out</a>
                            </li>
                            {{--<li class="nav-drop"><a href="#">USD $<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>--}}
                                {{--<ul class="list nav-drop-menu">--}}
                                    {{--<li><a href="#">EUR<span class="right">€</span></a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="#">GBP<span class="right">£</span></a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="#">JPY<span class="right">円</span></a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="#">CAD<span class="right">$</span></a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="#">AUD<span class="right">A$</span></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <li class="top-user-area-lang nav-drop">
                                <a href="#">
                                    <img src="{{url('img/flags/32/uk.png')}}" alt="Image Alternative text" title="Image Title" />ENG<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
                                </a>
                                <ul class="list nav-drop-menu">
                                    <li>
                                        <a title="German" href="#">
                                            <img src="{{url('img/flags/32/de.png')}}" alt="Image Alternative text" title="Image Title" /><span class="right">GER</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Japanise" href="#">
                                            <img src="{{url('img/flags/32/jp.png')}}" alt="Image Alternative text" title="Image Title" /><span class="right">JAP</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Italian" href="#">
                                            <img src="{{url('img/flags/32/it.png')}}" alt="Image Alternative text" title="Image Title" /><span class="right">ITA</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="French" href="#">
                                            <img src="{{url('img/flags/32/fr.png')}}" alt="Image Alternative text" title="Image Title" /><span class="right">FRE</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Russian" href="#">
                                            <img src="{{url('img/flags/32/ru.png')}}" alt="Image Alternative text" title="Image Title" /><span class="right">RUS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Korean" href="#">
                                            <img src="{{url('img/flags/32/kr.png')}}" alt="Image Alternative text" title="Image Title" /><span class="right">KOR</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="nav">
            <ul class="slimmenu" id="slimmenu">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/flight-deals')}}">Flights</a></li>
            </ul>
        </div>
    </div>
</header>