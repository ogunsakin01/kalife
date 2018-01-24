@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>
# Hi {{$userInfo->first_name}},
You are about to make a payment of &#x20A6; {{number_format(($amount/ 100),2)}} for a booking on our platform.
Kindly confirm the transaction before proceeding.
@component('mail::panel')
   Payment Reference : {{$reference}}
@endcomponent
Regards,
{{ config('app.name') }}
@endcomponent
