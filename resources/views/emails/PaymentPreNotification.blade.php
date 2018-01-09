@component('mail::message')
<img src="{{asset('img/logo-invert.png') }}">
# Hi {{$userInfo->first_name}},
You are about to make a payment of &#x20A6; {{number_format($amount,2)}} for a booking on our platform.
Kindly confirm the transaction before proceeding.
@component('mail::panel')
   Payment Reference : {{$reference}}
@endcomponent
Regards,
Kalife Travels and Tours <br>
{{ config('app.name') }}
@endcomponent
