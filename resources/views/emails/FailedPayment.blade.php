@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>

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
