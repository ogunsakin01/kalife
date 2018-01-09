<nav id="sidebar" class="sidenav">
  <div class="sidebar-wrapper">
    <div class="profile-sidebar">
      <div class="avatar">
        <img src="{{asset('backend/images/profiles/05.jpg')}}" alt="">
      </div>
      <div class="profile-name">
        Jane Doe
        <button class="btn-prof" type="button" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#"><span class="icon ti-user mr-3"></span>Profile</a>
          <a class="dropdown-item" href="#"><span class="icon ti-email mr-3"></span>Inbox</a>
          <a class="dropdown-item" href="#"><span class="icon ti-settings mr-3"></span>Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><span class="icon ti-power-off mr-3"></span>Logout</a>
        </div>
      </div>
      <div class="profile-title">
        Administrator
      </div>
    </div>
    <ul class="main-menu" id="menus">
      <li>
        <a class="pr-mn collapsed" href="{{route('backend-home')}}">
          <span class="icon ti-home"></span>Dashboard
        </a>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#users" aria-expanded="true">
          <span class="icon ti-notepad"></span>User Management
        </a>
        <ul id="users" class="collapse" data-parent="#menus">
          <li><a href="{{route('backend-new-users')}}">New</a></li>
          <li><a href="{{route('backend-manage-users')}}">Manage</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#logs" aria-expanded="true">
          <span class="icon ti-notepad"></span>Log Management
        </a>
        <ul id="logs" class="collapse" data-parent="#menus">
          <li><a href="{{--{{route('backend-users-new')}}--}}">Wallet Transactions</a></li>
          <li><a href="{{--{{route('backend-users-new')}}--}}">Online Transactions</a></li>
          <li><a href="{{--{{route('backend-users-manage')}}--}}">Bank Transactions</a></li>
        </ul>
      </li>

      <li>
        <a class="pr-mn collapsed" data-toggle="collapse" href="#additions" aria-expanded="true">
          <span class="icon ti-notepad"></span>Addition Management
        </a>
        <ul id="additions" class="collapse" data-parent="#menus">
          <li><a href="{{route('backend-markup')}}">Markup</a></li>
          <li><a href="{{route('backend-markdown')}}">Markdown</a></li>
          <li><a href="{{route('backend-vat')}}">VAT</a></li>
        </ul>
      </li>


      <li class="header">User Interface</li>
    </ul>
  </div>
</nav>