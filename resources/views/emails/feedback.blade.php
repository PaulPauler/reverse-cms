@component('mail::message')
# New message from site "{{ env('APP_NAME') }}"

Name: **{{ $order->name }}**

Phone: **{{ $order->phone }}**

Mail: **{{ $order->mail }}**

Message:

- {{ $order->message }}

@component('mail::button', ['url' => URL::to('/panel/modules/feedback/answer/'.$order->id)])
Send answer
@endcomponent

@endcomponent
