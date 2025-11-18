@extends('layouts.admin')
@section('content')
<h1>Subscribers</h1>
<!--  -->
<table class="table table-bordered">
  <thead><tr><th>Email</th><th>Name</th><th>Status</th><th>Joined</th></tr></thead>
  <tbody>
    @foreach($subs as $s)
      <tr>
        <td>{{ $s->email }}</td>
        <td>{{ $s->name }}</td>
        <td>{{ $s->status }}</td>
        <td>{{ optional($s->subscribed_at)->toDayDateTimeString() }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $subs->links() }}
@endsection
