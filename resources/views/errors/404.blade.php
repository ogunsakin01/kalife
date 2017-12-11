<!DOCTYPE HTML>
<html class="full">

<head>
    <title>Kalife - Invalid Access</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="Traveler - Premium template for travel companies">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
   @include('partials.css')
</head>

<body class="full">

<!-- FACEBOOK WIDGET -->
<div id="fb-root"></div>
<!-- /FACEBOOK WIDGET -->
<div class="global-wrap">
    <div class="full-page">
        <div class="bg-holder full">
            <div class="bg-mask"></div>
            <div class="bg-blur" style="background-image:url({{url("img/196_365_1300x900.jpg")}});"></div>
            <div class="bg-holder-content full text-white">
                <a class="logo-holder" href="{{url("/")}}">
                    <img src="{{url("img/logo-invert.png")}}" alt="Image Alternative text" title="Image Title" />
                </a>
                <div class="full-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <p class="text-hero">404</p>
                                <h1>Page is not found</h1>
                                <p>The page your are trying to access does not exist. Check if the address you are entering is correct or complete</p><a class="btn btn-white btn-ghost btn-lg mt5" href="{{url("/")}}"><i class="fa fa-long-arrow-left"></i> to Homepage</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="footer-links">
                    <li><a href="{{url("/")}}">Home</a>
                    </li>
                    <li><a href="{{url("/flight-deals")}}">Flight</a>
                    </li>
                    <li><a href="#">Hotel</a>
                    </li>
                    <li><a href="#">Attractions</a>
                    </li>
                    <li><a href="{{url("/about-us")}}">About Us</a>
                    </li>
                    <li><a href="{{url("/contact-us")}}">Contact Us</a>
                    </li>
                    <li><a href="{{url("/register-login")}}">Log In</a>
                    </li>
                    <li><a href="{{url("/register-login")}}">Join Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

   @include('partials.js')
</div>
</body>

</html>