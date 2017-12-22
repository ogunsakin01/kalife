@component('mail::message')
<img src="{{asset('img/logo-invert.png') }}">
# Hi {{$userInfo->first_name}},
Your attempt tp make a payment failed,

@component('mail::panel')
    {{$transactionStatus['responseDescription']}}
@endcomponent

@component('mail::button', ['url' => url('/bookings')])
Bookings
@endcomponent

Regards,
Kalife Travels and Tours<br>
{{ config('app.name') }}
@endcomponent
