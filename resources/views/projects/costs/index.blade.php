@extends('layouts.app')
@section('content')

    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1>{{ $project->title }}</h1>
            <div>
                @if ($costs->count() != 0)
                    <a href="{{ route('projects.costs.export', $project->id) }}" class="btn btn-primary btn-md active"
                        role="button" aria-pressed="true">Lejupielādēt izmaksas</a>
                @endif
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCostModal">
                    Pievienot izmaksu
                </button>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @if ($costs->count() == 0)
                    <div>Projektam vēl van pievienotas izmaksas</div>
                @else
                    <table class="table table-bordered">
                        <tr class="">
                            <th>Darba nosaukums</th>
                            <th>Mērvienība</th>
                            <th>Apjoms</th>
                            <th>Darba vienības izmaksas</th>
                            <th>Materiāla vienības izmaksas</th>
                            <th>Vienības izmaksas</th>
                            <th>Kopējās darba izmaksas</th>
                            <th>Kopējās materiāla izmaksas</th>
                            <th>Kopā</th>
                        </tr>

                        @foreach ($costs as $cost)
                            <tr class="">
                                <td>{{ $cost->task_title }}</td>
                                <td>{{ $cost->unit }}</td>
                                <td>{{ $cost->amount }}</td>
                                <td>{{ $cost->task_cost_per_unit }}</td>
                                <td>{{ $cost->material_cost_per_unit }}</td>
                                <td>{{ $cost->total_unit_cost }}</td>
                                <td>{{ $cost->total_task_cost }}</td>
                                <td>{{ $cost->total_material_cost }}</td>
                                <td><b>{{ $cost->total_cost }}</b></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Cost Actions">
                                        <button type="button" class="btn btn-primary btn-md edit-cost-form m-1 rounded"
                                            data-cost-id="{{ $cost->id }}" data-project-id="{{ $project->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z">
                                                </path>
                                            </svg>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('projects.costs.destroy', [$project->id, $cost]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-md btn-danger m-1 rounded" onclick="return confirm('Vai tiešām dzēst izmaksu?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                                    </path>
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
        @include('projects.costs.create')
        @include('projects.costs.edit')
    @endsection
