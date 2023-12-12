@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Projects</h1>
  </div>
    <div class="container">
      <div class="row">
        <table>
          <tr>
            <th>Name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone nr.</th>
            <th>Role</th>
          </tr>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone }}</td>
              <td>{{ $user->role->role_name }}</td>
              <td><a href="{{route('users.show', $user->id)}}">View</a></td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
</main>
@endsection