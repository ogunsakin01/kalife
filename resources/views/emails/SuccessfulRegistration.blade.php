@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>
# Hi  {{$userInfo['first_name']}}

Welcome To Kalife Travels and Tours. Your account and booking information can be seen and managed through the bookings button at the top of the page each time you login.
Thank you for choosing us.



Regards,
Kalife Travels and Tours<br>
{{ config('app.name') }}
@endcomponent
