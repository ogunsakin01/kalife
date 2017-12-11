
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <a class="logo" href="">
                        <img src="{{url('img/logo-invert.png')}}" alt="Image Alternative text" title="Image Title" />
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="top-user-area clearfix">
                        <ul class="top-user-area-list list list-horizontal list-border">
                            @if(auth()->guest())
                            <li class="top-user-area-avatar">
                                <a>Guest</a>
                            </li>
                            <li><a href="{{url('/register-login')}}">Sign in</a>
                            </li>
                                @endif
                            @if(!auth()->guest())
                                    <li class="top-user-area-avatar">
                                        <a>Hi, {{auth()->user()->first_name}} </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-default" style="color:#000;">Bookings</a>
                                    </li>
                                    <li><a href="{{url('/logout')}}">Sign Out</a>
                                    </li>
                                @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

