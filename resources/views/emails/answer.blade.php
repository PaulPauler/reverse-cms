@component('mail::message')
# Hello, {{ucfirst($order->name)}}

{{$order->answer}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
