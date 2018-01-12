@component('mail::message')
# Hi  {{$userInfo['first_name']}}

Welcome To Kalife Travels and Tours. Your account and booking information can be seen and managed through the bookings button at the top of the page each time you login.
Thank you for choosing us.



Regards,
Kalife Travels and Tours<br>
{{ config('app.name') }}
@endcomponent
