@component('mail::message')
<img src="{{asset('img/logo-invert.png') }}">
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
Note that your reservation has been created on the flights of your house according to the number of passengers and cabin you selected.
We urge you to follow the link below to you issue the ticket to the flight yourself.
@endcomponent
@component('mail::button', ['url' => url('/flight-bookings') ])
Flight Bookings
@endcomponent
Regards,
Kalife Travels and Tours <br>
{{ config('app.name') }}
@endcomponent
