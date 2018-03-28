@extends('layouts.app')
@section('title')Contact Us  @endsection
@section('activeContact') active @endsection
@section('content')
    <div class="gap gap-small"></div>
    <div class="container">
        <h1>Contact Us</h1>
    </div>
        <div class="container">
    </div>
    <div id="map-canvas" style="height:400px;"></div>
    <div class="container">
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-7">
                <p>Kalife Travel Bureau can be considered as one of the pioneers in the travel agency industry in Lagos, if not in Nigeria as a whole. It was first registered under the Business Name Acts 1961 on April 18, 1963 and acquired its incorporation on March 5, 1974. It opened its first agency at 25, Balogun Street, Lagos and is presently located at 20 – 24 Ozumba Mbadiwe Avenue in Victoria Island, Lagos.</p>

                <form class="mt30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" id="message_name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" id="message_email" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" id="message"></textarea>
                    </div>
                    <input class="btn btn-primary" type="button" value="Send Message" id="send_message"/>
                </form>
            </div>
            <div class="col-md-4">
                <aside class="sidebar-right">
                    <ul class="address-list list">
                        <li>
                            <h5>Email</h5><a href="#">info@kalifetravel.com</a>
                        </li>
                        <li>
                            <h5>Phone Number</h5><a href="#"> 0818 727 1255</a>
                        </li>
                        {{--<li>--}}
                            {{--<h5>Skype</h5><a href="#">contact_traveller</a>--}}
                        {{--</li>--}}
                        <li>

                            <h5>Address</h5><address>Kalife Travel Bureau
                                <br />20 – 24 Ozumba Mbadiwe Avenue
                                <br />in Victoria Island, Lagos.<br />
                                Nigeria<br />
                            </address>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
        <div class="gap"></div>
    </div>
    <script>
        var customLatitude = '6.4400755';
        var customLongitude = '3.4301604';
    </script>
@endsection