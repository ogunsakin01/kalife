<!DOCTYPE HTML>
<html>

<head>
    <title>Kalife - @yield('title')</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="affordable tickets in Nigeria, cheap flights, cheap tickets, travel deals" />
    <meta name="description" content="Kalife - Travel Agency">
    <meta name="author" content="Touchcore">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">
        var baseUrl = "{{url("/")}}";
        var path = "{{ route('typeaheadJs') }}";
    </script>
    @include('partials.css')
</head>

<body class="full">
<div class="global-wrap">
    <div class="template-content">
        @include('partials.header')
        <header id="main-header">
            <div class="container">
                <div class="nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li class="@yield('activeHome')"><a href="{{url('/')}}">Home</a></li>
                        <li class="@yield('activeFlight')"><a href="{{url('/flights')}}">Flights</a></li>
                        {{--<li class="@yield('activeHotel')"><a href="{{url('/hotels')}}">Hotels</a></li>--}}
                          {{--<li class="@yield('activeCar')"><a href="#">Cars</a></li>--}}
                        <li class="@yield('activeAttraction')"><a href="{{url('/attractions')}}">Deals</a></li>
                        <li class="@yield('activeAbout')"><a href="{{url('/about-us')}}">About Us</a></li>
                        <li class="@yield('activeContact')"><a href="{{url('/contact-us')}}">Contact Us</a></li>
                        @if(auth()->guest())
                            <li class="@yield('activeRegisterLogin')"><a href="{{url('/register-login')}}">Log In</a></li>
                        @else
                            {{--<li class="active"><a>Active</a></li>--}}
                        @endif
                    </ul>
                </div>
            </div>
        </header>

        @yield('content')
        @include('partials.footer')
    @include('partials.flightSearch')
    @include('partials.multiCity')
    @include('partials.usersReg');
    </div>
    @yield('loadingOverlay')
    @include('partials.js')
</div>
@yield('timeoutScript')
{!! Toastr::message() !!}
</body>

</html>




