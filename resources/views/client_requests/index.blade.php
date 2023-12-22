@extends('layouts.app')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <button id="markAsReadBtn" class="btn btn-primary">Mark All as Read</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#markAsReadBtn').on('click', function() {
            $.ajax({
                url: '/requests/mark_all_as_read',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('All requests marked as read!');
                    $('#notificationBadge').text('');
                },
                error: function(error) {
                    console.error('Error marking requests as read:', error);
                }
            });
        });
    });
</script>
