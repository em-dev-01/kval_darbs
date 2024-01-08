@extends('layouts.app')
@section('content')
    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        @include('components.success-alert')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pieteikumi</h1>
        </div>
        <div class="container">
            <div class="row">
                @if (count($clientRequests)>0)
                <table>
                    <tr>
                        <th>Vārds</th>
                        <th>Apraksts</th>
                        <th>E-pasts</th>
                        <th>Statuss</th>
                    </tr>
                        @foreach ($clientRequests as $clientRequest)
                            <tr>
                                <td>{{ $clientRequest->name }}</td>
                                <td>{{ $clientRequest->description }}</td>
                                <td>{{ $clientRequest->email }}</td>
                                <td>{{ $clientRequest->status }}</td>
                                <td><a href="{{ route('client_requests.show', $clientRequest) }}" type="button" class="btn btn-primary btn-md">Atvērt</a></td>

                            </tr>
                        @endforeach
                    </table>
                    @else
                        <div>Nav neviena pieteikuma</div>
                    @endif
            </div>
        </div>
    </main>
@endsection
