@component('mail::message')
# Booking Status Update

Hello {{ $booking->customer_name }},

Your booking (ID: {{ $booking->id }}) has been updated to:

**Status:** {{ $booking->status }}

@isset($booking->product)
**Product:** {{ $booking->product->name }}
@endisset

@isset($booking->service)
**Service:** {{ $booking->service->title }}
@endisset

**Start Date:** {{ $booking->start_date }}  
**End Date:** {{ $booking->end_date }}

@component('mail::button', ['url' => url('/')])
Visit our website
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
