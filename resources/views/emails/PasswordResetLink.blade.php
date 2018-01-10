@component('mail::message')
  <p style="text-align: center;"><img src="{{asset('backend/images/logo/logo.jpg')}}" style="height: 100px;" alt="" /></p>
# Hi {{$first_name}},

You recently requested to reset your password for your Kalife Account.<br>
Click the button below to reset it.


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

If you did not request a password reset, please ignore this email. This password reset is only valid for the next 30 minutes.

Thanks,<br>
{{ config('app.name') }} Team

  <hr>

  <small>If you're having troubles clicking the password reset button, copy and paste the url below in your browser</small> <br>
  <small>sdf</small>
@endcomponent
