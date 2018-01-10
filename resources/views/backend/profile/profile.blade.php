@extends('layouts.backend')

@section('tab-title')Profile @endsection

@section('title')Profile Management @endsection

@section('content')
  <div class="row">
    <div class="col-md-3">

      <!-- Photo & Description card -->
      <div class="profile-side">
        <div class="profile-photo">
          <img src="{{asset('backend/images/profiles/05.jpg')}}" class="circle" alt="">
          <div class="prof-name">
            {{$name}}
          </div>
          <div class="prof-title">
            {{$role}}
          </div>
        </div>
        <div class="profile-body">
          <div class="prof-misc">
            <span class="ti-time mr-2"></span>
            Signed Up {{$sign_up_date}}
          </div>
        </div>
      </div>
      <!-- /End Photo & Description card -->

    </div>

    <div class="col-md-9">

      <!-- Main Profile card -->
      <div class="card">
        <ul class="nav nav-tabs card-header" id="profile" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile_tab" aria-expanded="true">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change_password" aria-expanded="false">Change Password</a>
          </li>
        </ul>

        <div class="card-body">
          <div class="tab-content profile-content" id="profileContent">

            <!-- Dashboard tab -->
            <div class="tab-pane fade active show" id="profile_tab" aria-expanded="true">

              <div class="row mb-2">
                <div class="col-12">
                  <div class="subheading">
                    Basic Information
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Fullname</div>
                <div class="col-sm-10">
                  {{$profile['full_name']}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Birthday</div>
                <div class="col-sm-10">
                 {{$profile['date_of_birth']}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Address</div>
                <div class="col-sm-10">
                  {{$profile['address']}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Gender</div>
                <div class="col-sm-10">
                  {{$profile['gender']}}
                </div>
              </div>

              <div class="row mt-4  mb-2">
                <div class="col-12">
                  <div class="subheading">
                    Contact Information
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Email</div>
                <div class="col-sm-10">
                  {{$profile['email']}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Phone</div>
                <div class="col-sm-10">
                  {{$profile['phone_number']}}
                </div>
              </div>

              <div class="row mt-4 mb-2">
                <div class="col-12">
                  <div class="subheading">
                    Account Information
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Account Status</div>
                <div class="col-sm-10">
                  @php
                    echo $profile['account_status']
                  @endphp
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Created On</div>
                <div class="col-sm-10">
                  {{$sign_up_date}}
                </div>
              </div>

              @role('agent')
              <div class="row mt-4 mb-2">
                <div class="col-12">
                  <div class="subheading">
                    Agency Information
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Agency Name</div>
                <div class="col-sm-10">
                  {{$profile['agency_name']}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Agency ID</div>
                <div class="col-sm-10">
                  {{$profile['agent_id']}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2 text-muted">Office Number</div>
                <div class="col-sm-10">
                  {{$profile['office_number']}}
                </div>
              </div>
              @endrole

            </div>
            <!-- /End Dashboard tab -->

            <!-- Messages tab -->
            <div class="tab-pane fade" id="change_password" aria-expanded="false">
              <div class="row mb-3">
                <div class="col-3">
                  <button class="btn btn-alt-primary btn-block" type="button"><i class="fa fa-edit"></i> New Compose</button>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control form-control-lg" placeholder="Search...">
                </div>
              </div>
              <ul class="message-list"><!-- Message list -->
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/02.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Harris Kane
                  </div>
                  <div class="title">
                    Nihil anim keffiyeh helvetica, craft beer
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/01.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Thomas Mollor
                  </div>
                  <div class="title">
                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/03.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Gigi Laonard
                  </div>
                  <div class="title">
                    Leggings occaecat craft beer farm-to-table
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/06.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Michael Wong
                  </div>
                  <div class="title">
                    Euweuh nu bisa ngajar kuring ka lembur, kumaha?
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/04.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Phil Neck
                  </div>
                  <div class="title">
                    Nganggo naon urang teu tiasa hilap kana iyeu teh
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/05.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Jane Doe
                  </div>
                  <div class="title">
                    Ulah ngan ukur di ogo wae ateuh
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/07.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Chris Wilox
                  </div>
                  <div class="title">
                    Onsta kal bureno un saena kana
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/08.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Martin Plermo
                  </div>
                  <div class="title">
                    Teu pati teuing ari geuring tapi masih keneh
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/09.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Oscar Dunn
                  </div>
                  <div class="title">
                    Sing sehat badan sareng sakaluargi kasep
                  </div>
                </li>
                <li>
                  <div class="check">
                    <input type="checkbox">
                  </div>
                  <div class="pic-container">
                    <div class="pic">
                      <img src="assets/images/profiles/10.jpg" alt="">
                    </div>
                  </div>
                  <div class="sender">
                    Frans Likuwa
                  </div>
                  <div class="title">
                    Mun hoyong terang mah diajar atuh geura
                  </div>
                </li>
              </ul><!-- End Message list -->
            </div>
            <!-- /End Messages tab -->

          </div><!-- .profile-content -->
        </div><!-- .card-body -->
      </div><!-- .card -->
      <!-- /End Main Profile card -->

    </div><!-- .col -->
  </div>
@endsection