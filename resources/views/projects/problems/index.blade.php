@extends('layouts.app')
@section('content')

    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        @include('components.success-alert')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Problēmas: {{ $project->title }}</h1>
                <a href="{{ route('projects.problems.create', $project) }}" class="btn btn-success">Ziņot par problēmu</a>
            </div>
            <div class="pl-2">
                @if ($problems->isEmpty())
                    <p>Projektam nav pievienota neviena problēma</p>
                @else
                    @foreach ($problems as $problem)
                        <div class="card mb-3 w-50">
                            <div class="card-body">
                                <h5 class="card-title">{{ $problem->title }}</h5>
                                <p class="card-text">{{ $problem->description }}</p>
                                <div class="btn-group" role="group" aria-label="Problem actions">
                                    <a href="{{ route('projects.problems.show', [$project, $problem]) }}"
                                        class="btn btn-primary">Skatīt</a>
                                    <a href="{{ route('projects.problems.edit', [$project, $problem]) }}"
                                        class="btn btn-primary">Rediģēt</a>
                                    <form action="{{ route('projects.problems.destroy', [$project, $problem]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger custom-delete"
                                            onclick="return confirm('Vai tiešām vēlaties dzēst šo problēmu?')">Dzēst</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>

@endsection
