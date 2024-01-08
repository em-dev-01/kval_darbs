@extends('layouts.app')
@section('content')

    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div>
                <h1>Pieteikums nr. {{ $clientRequest->id }}</h1>
            </div>

            <div class="buttons">
                @if (!$clientRequest->read_status)
                    <form method="POST" action="{{ route('client_requests.mark_as_read', $clientRequest) }}"
                        style="display: inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary btn-md">Atzīmēt kā skatītu</button>
                    </form>
                @endif
                @if ($clientRequest->status == App\Enums\ClientRequestStatusEnum::PENDING)
                    <form method="POST" action="{{ route('client_requests.accept', $clientRequest) }}"
                        style="display: inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary">Apstiprināt</button>
                    </form>
                    <form method="POST" action="{{ route('client_requests.deny', $clientRequest) }}"
                        style="display: inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Noraidīt</button>
                    </form>
                @elseif($clientRequest->status == App\Enums\ClientRequestStatusEnum::ACCEPTED)
                    @if (isset($clientRequest->project_id))
                        <a href="{{ route('projects.show', $clientRequest->project_id) }}"
                            class="btn btn-primary btn-md active" role="button">Atvērt projektu</a>
                    @else
                        <a href="{{ route('projects.create-with-client', $clientRequest) }}"
                            class="btn btn-primary btn-md active" role="button">Izveidot projektu</a>
                    @endif
                @endif
                <a href="{{ route('client_requests.index') }}" class="btn btn-primary btn-md active" role="button"
                    aria-pressed="true">Visi pieteikumi</a>
                <form method="POST" action="{{ route('client_requests.destroy', $clientRequest) }}"
                    style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Vai tiešām vēlaties dzēst pieteikumu? Attiecīgais projekts netiks dzēsts')">Dzēst
                        pieteikumu</button>
                </form>
            </div>
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
                {{ $clientRequest->status }}
            </div>
            <hr>
        </div>
    </main>
@endsection
