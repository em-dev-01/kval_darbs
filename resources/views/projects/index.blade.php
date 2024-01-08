@extends('layouts.app')
@section('content')
    <main class="col-md-9 col-lg-10 mx-auto px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
      @include('components.success-alert')
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Projekti</h1>
      </div>
      <div class="container">
        <div class="row">
          @if (count($projects)>0)
          @foreach ($projects as $project)
            <div class="col-lg-6 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <hr>
                <p class="card-text">{{$project->description}}</p>
                <a href="{{route('projects.show', $project)}}" class="btn btn-outline-success btn-md">Skatīt</a>
              </div>
            </div>
          </div>
          @endforeach
          @else
            <div>Nav pievienots neviens projekts</div>
          @endif
        </div>
      </div>
    </main>
@endsection
