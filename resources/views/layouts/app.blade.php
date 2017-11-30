<!DOCTYPE HTML>
<html>

<head>
    <title>Kalife - @yield('title')</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="Traveler - Premium template for travel companies">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">
        var baseUrl = "{{url("/")}}";

        var path = "{{ route('typeaheadJs') }}";
    </script>
    @include('partials.css')
</head>

<body id="body">

<!-- FACEBOOK WIDGET -->
{{--<div id="fb-root"></div>--}}
{{--<script>--}}
    {{--(function(d, s, id) {--}}
        {{--var js, fjs = d.getElementsByTagName(s)[0];--}}
        {{--if (d.getElementById(id)) return;--}}
        {{--js = d.createElement(s);--}}
        {{--js.id = id;--}}
        {{--js.src = "../../../../connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";--}}
        {{--fjs.parentNode.insertBefore(js, fjs);--}}
    {{--}(document, 'script', 'facebook-jssdk'));--}}
{{--</script>--}}
<!-- /FACEBOOK WIDGET -->
<div class="global-wrap">
    <header id="main-header">
    @include('partials.header')
        <div class="container">
            <div class="nav">
                <ul class="slimmenu" id="slimmenu">
                    <li class=""><a href="{{url('/')}}">Home</a></li>
                    <li class=""><a href="{{url('/flight-deals')}}">Flights</a></li>
                    <li class=""><a href="#">Hotels</a></li>
                    <li class=""><a href="#">Cars</a></li>
                    <li class=""><a href="#">Activities</a></li>
                    <li class=""><a href="{{url('/about-us')}}">About Us</a></li>
                    <li class=""><a href="{{url('/contact-us')}}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </header>

   @yield('content')
    @include('partials.flightSearch')
    @include('partials.multiCity')

   @include('partials.footer')

    @include('partials.js')
</div>
@yield('timeoutScript')
</body>

</html>




