@extends('layouts.app')
@section('title')Contact Us  @endsection
{{--@section('activeContactUs')active@endsection--}}
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
                <p>Sodales laoreet mattis ut in nullam consequat turpis mus aenean mattis senectus mollis luctus ornare et at feugiat a habitasse hendrerit justo mollis penatibus cras blandit proin euismod nostra dignissim</p>
                <p>Morbi sit mattis at ligula himenaeos ante morbi lacinia mattis varius vulputate ultricies habitant ipsum elit ultrices lorem diam orci</p>
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
                            <h5>Email</h5><a href="#">info@traveler.com</a>
                        </li>
                        <li>
                            <h5>Phone Number</h5><a href="#">+1 (286) 929-1739</a>
                        </li>
                        <li>
                            <h5>Skype</h5><a href="#">contact_traveller</a>
                        </li>
                        <li>
                            <h5>Address</h5><address>Traveler Ltd.<br />1355 Market St, Suite 900<br />San Francisco, CA 94103<br />United States<br /></address>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection