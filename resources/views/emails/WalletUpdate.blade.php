@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>
# Hi  {{$userInfo['first_name']}}

Your wallet has been @if($type == 1)credited with@elseif($type == 0) debited of @endif the sum of &#x20A6;{{number_format($amount,2)}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
