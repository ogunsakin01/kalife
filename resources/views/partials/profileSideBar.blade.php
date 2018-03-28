<div class="col-md-3">
    <aside class="user-profile-sidebar">
        <div class="user-profile-avatar text-center">
            @if(is_null(auth()->user()->profile_photo))
                @if(auth()->user()->gender == 1)
                    <img src="{{asset('/img/male.png')}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
                @elseif(auth()->user()->gender == 2)
                    <img src="{{asset('/img/female.png')}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
                @endif
            @else
                <img src="{{asset(auth()->user()->profile_photo)}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
            @endif
            <h5>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h5>
            <p>Member Since {{date('M Y',strtotime(auth()->user()->created_at))}}</p>
        </div>
        <ul class="list user-profile-nav">
            <li class="@yield('booking')"><a href="{{url('/bookings')}}"><i class="fa fa-dashboard"></i>  Summary</a></li>
            <li class="@yield('flightBooking')@yield('hotelBooking')@yield('carBooking')@yield('packageBooking')"><a id="show_booking_history"><i class="fa fa-list-alt"></i> Bookings History <i class="fa fa-caret-right pull-right"></i></a>

                    <ul id="bookings_history" class="hidden list user-profile-nav">
                        <li class="@yield('flightBooking')"><a href="{{url('/flight-bookings')}}"> <small> <i class="fa fa-plane"></i> Flight Bookings</small> </a></li>
                        <li class="@yield('hotelBooking')"><a href="#"><small><i class="fa fa-building-o"></i> Hotel Bookings <span class="badge badge-info"> Not Avail</span></small> </a></li>
                        <li class="@yield('carBooking')"><a href="#"><small><i class="fa fa-car"></i> Car Bookings <span class="badge badge-info"> Not Avail</span></small></a> </li>
                        <li class="@yield('packageBooking')"><a href="{{url('/package-bookings')}}"> <small><i class="fa fa-suitcase"></i> Travel Packages</small> </a></li>
                    </ul>

            </li>
            <li class="@yield('onlinePayment')@yield('bankPayment')"><a id="show_payments"><i class="fa fa-money"></i> Payments <i class="fa fa-caret-right pull-right"></i></a>
                <ul id="payments" class="hidden list user-profile-nav">
                    <li class="@yield('onlinePayment')"><a href="{{url('/my-online-payments')}}"> <small><i class="fa fa-money"></i> Online Payments</small></a></li>
                    <li class="@yield('bankPayment')"><a href="{{url('/bank-payments')}}"> <small><i class="fa fa-bank"></i> Bank Payments</small></a></li>
                </ul>
            </li>
            <li class="@yield('user')"><a href="{{url('/manage-user')}}"><i class="fa fa-user"></i>Manage Info</a></li>



        </ul>
    </aside>
</div>