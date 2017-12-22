<div class="col-md-3">
    <aside class="user-profile-sidebar">
        <div class="user-profile-avatar text-center">
            <img src="{{asset('/img/amaze_300x300.jpg')}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
            <h5>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h5>
            <p>Member Since {{date('M Y',strtotime(auth()->user()->created_at))}}</p>
        </div>
        <ul class="list user-profile-nav">
            <li><a href="{{url('/bookings')}}"><i class="fa fa-dashboard"></i> Bookings</a></li>
            <li><a href="{{url('/flight-bookings')}}"><i class="fa fa-plane"></i> Flight Bookings</a></li>
            <li><a href="#"><i class="fa fa-building-o"></i> Hotel Bookings</a></li>
            <li><a href="#"><i class="fa fa-car"></i> Car Bookings</a></li>
            <li><a href="#"><i class="fa fa-suitcase"></i> Travel Packages</a></li>
            <li><a href="#"><i class="fa fa-money"></i>Online Payments</a></li>
        </ul>
    </aside>
</div>