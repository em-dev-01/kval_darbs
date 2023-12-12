@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>{{$project->title}}</h1>
  </div>

  <div class="container">
    <div class="row">
      @if ($costs->count() == 0)
          <div>There are no costs created for this project yet</div>
        @else
        <table class="table-light">
          <tr class="table-light">
            <th>Task title</th>
            <th>Unit</th>
            <th>Amount</th>
            <th>Task cost per unit</th>
            <th>Material cost per unit</th>
            <th>Total task cost</th>
            <th>Total material cost</th>
            <th>Total cost</th>
          </tr>

          @foreach ($costs as $cost)
            <tr class="table-light">
              <td>{{ $cost->task_title }}</td>
              <td>{{ $cost->unit }}</td>
              <td>{{ $cost->amount }}</td>
              <td>{{ $cost->task_cost_per_unit }}</td>
              <td>{{ $cost->material_cost_per_unit }}</td>
              <td>{{ $cost->total_task_cost }}</td>
              <td>{{ $cost->total_material_cost }}</td>
              <td><b>{{ $cost->total_cost }}</b></td>
              {{-- <td><a href="{{ route('projects.costs.edit', [$project->id, $cost->id]) }}">Edit</a></td>
              <td><form method="POST" action="{{ route('projects.costs.destroy', [$project->id, $cost->id]) }}">
                @csrf
                @method('DELETE')
                <x-danger-button>Delete</x-danger-button>
              </form></td> --}}
            </tr>
          @endforeach
        </table>
        @endif
    </div>
        
      </div>
      <a href="{{ route('projects.costs.create', $project->id) }}" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Add cost</a>
      <a href="{{ route('projects.costs.export', $project->id) }}" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Export costs as excel</a>
@endsection
