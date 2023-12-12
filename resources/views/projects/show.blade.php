@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>{{$project->title}}</h1>
  </div>

  <div class="container">
    <div id="description">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo delectus dicta assumenda vero facere impedit, nam, nobis neque adipisci voluptates, deleniti ipsum. Pariatur a, voluptatibus quo facilis sint perferendis cupiditate!
    </div>
    <div>
      {{ $project->status }}
    </div>
    <hr>

    <div id="actions">

    </div>


    <div id="employees">
      List of employees working on this project:
      @foreach($project->users as $user)
        <li>{{ $user->name }}</li>
      @endforeach
    </div>

    <a href="{{route('projects.edit', $project)}}" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Edit project</a>

    <a href="{{ route('projects.costs.index', $project) }}"  class="btn btn-primary btn-md active" role="button" aria-pressed="true">Show project costs</a>
    
    <form method="POST" action="{{ route('projects.destroy', $project) }}">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    </div>
</main>
@endsection
