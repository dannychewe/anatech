<!DOCTYPE html>
<html>
<head>
    <title>Bookings PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Bookings Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Linked To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->customer_name }}</td>
                <td>{{ $b->customer_email }}</td>
                <td>{{ $b->customer_phone }}</td>
                <td>{{ $b->start_date }}</td>
                <td>{{ $b->end_date }}</td>
                <td>{{ $b->status }}</td>
                <td>
                    @if($b->product)
                        Product: {{ $b->product->name }}
                    @elseif($b->service)
                        Service: {{ $b->service->title }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Bookings PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Bookings Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Linked To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->customer_name }}</td>
                <td>{{ $b->customer_email }}</td>
                <td>{{ $b->customer_phone }}</td>
                <td>{{ $b->start_date }}</td>
                <td>{{ $b->end_date }}</td>
                <td>{{ $b->status }}</td>
                <td>
                    @if($b->product)
                        Product: {{ $b->product->name }}
                    @elseif($b->service)
                        Service: {{ $b->service->title }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
