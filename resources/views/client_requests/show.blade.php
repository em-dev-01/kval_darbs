@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Pieteikums nr. {{ $clientRequest->id }}</h1>
  </div>

  <div class="container">
    <div id="name">
      {{ $clientRequest->name }}
    </div>
    <div id="description">
      {{ $clientRequest->description }}
    </div>
    <div id="email">
      {{ $clientRequest->email }}
    </div>
    <div id="actions">
      {{ $clientRequest->status  }}
    </div>
    <hr>
    <a href="{{route('client_requests.edit', $clientRequest->id)}}" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Edit request</a>
    <a href="{{route('client_requests.index')}}" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Show all requests</a>

    
    <form method="POST" action="{{ route('client_requests.destroy', $clientRequest) }}">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    </div>
</main>
@endsection
