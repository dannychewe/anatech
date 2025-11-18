<!doctype html>
<html>
  <body>
    <h2>Thanks for your booking, {{ $booking->customer_name }}!</h2>
    <p>We received your request for <strong>
      @if($booking->service) {{ $booking->service->title }}
      @elseif($booking->product) {{ $booking->product->name }}
      @else a service/product @endif
    </strong>.</p>

    <p>
      Dates: {{ \Illuminate\Support\Carbon::parse($booking->start_date)->toFormattedDateString() }}
      – {{ \Illuminate\Support\Carbon::parse($booking->end_date)->toFormattedDateString() }} <br>
      Quantity: {{ $booking->quantity }}<br>
      @if(!is_null($booking->price_per_unit))
        Price per unit: ${{ number_format($booking->price_per_unit, 2) }}<br>
      @endif
      Total: ${{ number_format($booking->total_price, 2) }}
    </p>

    @if($booking->notes)
      <p><strong>Your notes:</strong> {{ $booking->notes }}</p>
    @endif

    <p>We'll get back to you shortly.</p>
  </body>
</html>
