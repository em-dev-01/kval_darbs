@extends('layouts.app')
@section('content')

    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        @include('components.success-alert')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1>{{ $project->title }}</h1>
            <div id="actions">
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-md active" role="button"
                    aria-pressed="true">Rediģēt projektu</a>
                <a href="{{ route('projects.costs.index', $project) }}" class="btn btn-primary btn-md active" role="button"
                    aria-pressed="true">Skatīt projekta izmaksas</a>
                <a href="{{ route('projects.problems.index', $project) }}" class="btn btn-primary btn-md active"
                    role="button" aria-pressed="true">Skatīt problēmas</a>
                <a href="{{ route('projects.problems.create', $project) }}" class="btn btn-primary btn-md active"
                    role="button" aria-pressed="true">Ziņot par problēmu</a>
                <form method="POST" action="{{ route('projects.destroy', $project) }}" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-md"
                        onclick="return confirm('Vai tiešām vēlaties dzēst projektu? Tiks dzēsti visi projekta dati, ieskaitot ziņotās problēmas, pieteikumu un izmaksas.')">
                        Dzēst projektu</button>
                </form>
            </div>
        </div>

        <div class="container">
            <div id="description">
                {{ $project->description }}
            </div>
            <hr>
            <h5>Adrese:</h5>
            <p>
                {{$project->city}}
                {{$project->county}}
                {{$project->parish}}
                {{$project->village}}
                {{$project->county}}
                {{$project->street}}
                {{$project->house}}
                {{$project->apartment}}
            </p>
            <div id="employees">
                @if (count($project->users) != 0)
                    Projekta darbinieki:
                    @foreach ($project->users as $user)
                        <li>{{ $user->name }}</li>
                    @endforeach
                    <hr>
                @else
                    <p>Projektam nav pievienots neviens darbinieks.</p>
                @endif
            </div>
            <div id="client-info">
                <p>Klients:
                    @if ($project->client_email != null || $project->client_name != null)
                        {{ $project->client_name }}, {{ $project->client_email }}
                    @else
                        Klienta informācija nav pievienota.
                    @endif
                </p>
            </div>
        </div>
    </main>
@endsection
