@extends('layouts.app')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="container">
    <div class="row">
      <table>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Email</th>
          <th>Status</th>
        </tr>
        @foreach ($clientRequests as $clientRequest)
          <tr>
            <td>{{ $clientRequest->name }}</td>
            <td>{{ $clientRequest->description }}</td>
            <td>{{ $clientRequest->email }}</td>
            <td>{{ $clientRequest->status }}</td>
            <td><a href="{{route('client_requests.show', $clientRequest)}}">View</a></td>
            <td><a href="{{route('client_requests.edit', $clientRequest)}}">Edit</a></td>

          </tr>
        @endforeach
      </table>
    </div>
  </div>
</main>
@endsection