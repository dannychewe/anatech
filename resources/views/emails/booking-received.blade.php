<!doctype html>
<html>
  <body>
    <h2>New Booking Received (#{{ $booking->id }})</h2>
    <p>
      Customer: {{ $booking->customer_name }} ({{ $booking->customer_email }})<br>
      Phone: {{ $booking->customer_phone ?: 'N/A' }}<br>
      Linked: 
      @if($booking->service) Service: {{ $booking->service->title }}
      @elseif($booking->product) Product: {{ $booking->product->name }}
      @else N/A @endif
    </p>
    <p>
      Dates: {{ $booking->start_date }} → {{ $booking->end_date }}<br>
      Qty: {{ $booking->quantity }}<br>
      Unit: ${{ number_format($booking->price_per_unit, 2) }}<br>
      Total: ${{ number_format($booking->total_price, 2) }}
    </p>
    @if($booking->notes)
      <p><strong>Notes:</strong> {{ $booking->notes }}</p>
    @endif
  </body>
</html>
