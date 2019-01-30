@component('mail::message')
# Order Shipped

Your order has been shipped!

@component('mail::button', ['url' => URL::to('/')])
View Order
@endcomponent

Next Steps:

- Track Your Order On Our Website
- Pre-Sign For Delivery

Thanks,<br>
{{ config('app.name') }}
@endcomponent
