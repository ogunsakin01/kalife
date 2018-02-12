@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>

# Hi {{$userInfo->first_name}},
Below is the information of your booking
@component('mail::panel')
> Your PNR Code is  **{{$bookingInfo->pnr}}**
@endcomponent
@component('mail::table')
    |                            |                                                                     |
    | -------------------------- |:-------------------------------------------------------------------:|
    |**Total Amount**            | &#x20A6; {{number_format(($bookingInfo['total_amount'] / 100),2)}}  |
    |**Booking Reference         |                          {{$bookingInfo['reference']}}              |
@endcomponent
@component('mail::panel')
Note that your reservation has been created on the flights of your choice according to the number of passengers and cabin you selected.
We urge you to follow the link below to get more information on your booking.
@endcomponent
@component('mail::button', ['url' => url('/flight-bookings') ])
Flight Bookings
@endcomponent
Regards,
Kalife Travels and Tours <br>
{{ config('app.name') }}
@endcomponent
