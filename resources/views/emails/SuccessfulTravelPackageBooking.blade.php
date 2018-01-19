@component('mail::message')
<p style="text-align: center;"><img src="{{asset('img/logo-invert.png')}}" style="height: 100px;" alt="" /></p>
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
