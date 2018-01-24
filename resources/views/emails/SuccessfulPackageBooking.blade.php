@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>
# Hi {{$userInfo->first_name}},
You package booking is successful. See your package booking breakdown below.

@component('mail::panel')
    > Your booking reference **{{$bookingInfo->reference}}**
@endcomponent
@component('mail::table')
    |                            |                                                                     |
    | -------------------------- |:-------------------------------------------------------------------:|
    |**Package Name**            |                   {{$packageInfo->package_name}}                    |
    |**Adult**                   |       {{$bookingInfo->adults}} x ({{$packageInfo->adult_price}})    |
    |**kids**                    |       {{$bookingInfo->kids}} x ({{$packageInfo->kids_price}})       |
    |**Total Amount**            | &#x20A6; {{number_format(($bookingInfo->total_amount / 100),2)}}    |

@endcomponent
@component('mail::button', ['url' => url('/package-bookings') ])
    Package Bookings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
