<nav id="sidebar" class="sidenav">
  <div class="sidebar-wrapper">
    <div class="profile-sidebar">
      <div class="avatar">
        @if(empty(auth()->user()->profile_photo))
        <img src="{{asset('backend/img/logo-invert.png')}}" class="circle" alt="">
        @else
        <img src="{{asset(auth()->user()->profile_photo)}}" class="circle" alt="">
        @endif
      </div>
      <div class="profile-name">
        {{auth()->user()->first_name}} {{auth()->user()->last_name}}
        <button class="btn-prof" type="button" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('backend-profile-view')}}"><span class="icon ti-user mr-3"></span>Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('backend-logout')}}"><span class="icon ti-power-off mr-3"></span>Logout</a>
        </div>
      </div>
      <div class="profile-title">
        @php
        $role = new \App\Role();
        @endphp

        {{$role->role(auth()->id())}}
      </div>
    </div>
    <ul class="main-menu" id="menus">

      @role('Super Admin')
      <li class="header">Admin Interface</li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-home')}}">
          <span class="icon ti-home"></span>Dashboard
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-new-users')}}">
          <span class="icon fa fa-users"></span>Users Management
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-profile-view')}}">
          <span class="icon ti-user"></span>Profile Management
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#flights" aria-expanded="true">
          <span class="icon fa fa-plane"></span>Flight Bookings
        </a>
        <ul id="flights" class="collapse" data-parent="#menus">
          <li><a href="{{route('my-flight-bookings')}}">My Bookings</a></li>
          <li><a href="#">Agent Bookings</a></li>
          <li><a href="#">Customers Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#" aria-expanded="true">
          <span class="icon fa fa-hotel"></span>Hotel Bookings <span class="badge badge-warning"><i class="fa fa-warning"></i></span>
        </a>
        <ul id="hotels" class="collapse" data-parent="#menus">
          <li><a href="#">My Bookings</a></li>
          <li><a href="#">Agent Bookings</a></li>
          <li><a href="#">Customers Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#" aria-expanded="true">
          <span class="icon fa fa-cab"></span>Car Bookings  <span class="badge badge-warning"><i class="fa fa-warning"></i></span>
        </a>
        <ul id="cars" class="collapse" data-parent="#menus">
          <li><a href="#">My Bookings</a></li>
          <li><a href="#">Agent Bookings</a></li>
          <li><a href="#">Customers Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#package" aria-expanded="true">
          <span class="icon fa fa-suitcase"></span>Package Bookings
        </a>
        <ul id="package" class="collapse" data-parent="#menus">
          <li><a href="{{route('my-package-bookings')}}">My Bookings</a></li>
          <li><a href="{{route('agents-package-bookings')}}">Agent Bookings</a></li>
          <li><a href="{{route('customers-package-bookings')}}">Customers Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#logs" aria-expanded="true">
          <span class="icon ti-notepad"></span>Log Management
        </a>
        <ul id="logs" class="collapse" data-parent="#menus">
          <li><a href="{{route('backend-wallet-transactions')}}">Wallet Transactions</a></li>
          <li><a href="{{route('backend-online-transactions')}}">Online Transactions</a></li>
          <li><a href="{{route('backend-bank-transactions')}}">  Bank Transactions</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#additions" aria-expanded="true">
          <span class="icon fa fa-cog"></span>Addition Management
        </a>
        <ul id="additions" class="collapse" data-parent="#menus">
          <li><a href="{{route('backend-markup')}}">Markup</a></li>
          <li><a href="{{route('backend-markdown')}}">Markdown</a></li>
          <li><a href="{{route('backend-vat')}}">VAT</a></li>
          <li><a href="{{route('banks')}}">Banks</a></li>
          <li><a href="{{route('manage-user-roles')}}">Roles and Permissions</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-wallet-view')}}">
          <span class="icon ti-wallet"></span>Wallet Management
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#packages" aria-expanded="true">
          <span class="icon ti-briefcase"></span>Travel Packages
        </a>
        <ul id="packages" class="collapse" data-parent="#menus">
          {{--<li><a href="{{url('backend/packages')}}">All Packages</a></li>--}}
          {{--<li><a href="{{url('backend/packages/create')}}">Create Package</a></li>--}}
          <li><a href="{{url('backend/travel-packages')}}">All Travel Package</a></li>
          <li><a href="{{url('backend/travel-packages/create')}}">Create Travel Package</a></li>
        </ul>
      </li>

      @endrole

      @role('Agent')
      <li class="header">Agent Interface</li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-home')}}">
          <span class="icon ti-home"></span>Dashboard
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-profile-view')}}">
          <span class="icon ti-user"></span>Profile Management
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#flights" aria-expanded="true">
          <span class="icon fa fa-plane"></span>Flight Bookings
        </a>
        <ul id="flights" class="collapse" data-parent="#menus">
          <li><a href="{{route('my-flight-bookings')}}">My Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#" aria-expanded="true">
          <span class="icon fa fa-hotel"></span>Hotel Bookings <span class="badge badge-warning"><i class="fa fa-warning"></i></span>
        </a>
        <ul id="hotels" class="collapse" data-parent="#menus">
          <li><a href="#">My Bookings</a></li>
          <li><a href="#">Agent Bookings</a></li>
          <li><a href="#">Customers Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#" aria-expanded="true">
          <span class="icon fa fa-cab"></span>Car Bookings  <span class="badge badge-warning"><i class="fa fa-warning"></i></span>
        </a>
        <ul id="cars" class="collapse" data-parent="#menus">
          <li><a href="#">My Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#package" aria-expanded="true">
          <span class="icon fa fa-suitcase"></span>Package Bookings
        </a>
        <ul id="package" class="collapse" data-parent="#menus">
          <li><a href="{{route('my-package-bookings')}}">My Bookings</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" href="{{route('backend-wallet-view')}}">
          <span class="icon ti-wallet"></span>Wallet Management
        </a>
      </li>

      @endrole




    </ul>
  </div>
</nav>