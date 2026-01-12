<!DOCTYPE html>
<html>
<head>
    <title>Subscribers PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Subscribers Report</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Status</th>
                <th>Subscribed At</th>
                <th>Unsubscribed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subs as $s)
            <tr>
                <td>{{ $s->email }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->status }}</td>
                <td>{{ optional($s->subscribed_at)->toDateTimeString() }}</td>
                <td>{{ optional($s->unsubscribed_at)->toDateTimeString() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
