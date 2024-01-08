@extends('layouts.app')
@section('content')

    <main class="col-md-9 mx-auto col-lg-10 px-md-4 mb-10">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Izveidot jaunu projektu</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('projects.store') }}" method="post" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="title">Nosaukums</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Apraksts</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="Īss projekta apraksts...">{{ $product->description ?? old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if (count($employees) > 0)
                            <div class="form-group">
                                <span>Projekta darbinieki:</span>
                                @foreach ($employees as $employee)
                                    <div class="form-check">
                                        <input type="checkbox" name="selected_employees[]" value="{{ $employee->id }}"
                                            class="form-check-input" id="employee{{ $employee->id }}">
                                        <label class="form-check-label"
                                            for="employee{{ $employee->id }}">{{ $employee->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="client_name">Klienta vārds</label>
                            <input type="text" name="client_name" id="client_name" class="form-control"
                                value="{{ isset($clientRequest) ? $clientRequest->name : old('client_name') }}">
                            @error('client_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="client_email">Klienta e-pasts</label>
                            <input type="email" name="client_email" id="client_email" class="form-control"
                                value="{{ isset($clientRequest) ? $clientRequest->email : old('client_email') }}">
                            @error('client_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">Pilsēta</label>
                                            <input type="text" name="city" id="city" class="form-control"
                                                value="{{ old('city') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="county">Novads</label>
                                            <input type="text" name="county" id="county" class="form-control"
                                                value="{{ old('county') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="parish">Pagasts</label>
                                            <input type="text" name="parish" id="parish" class="form-control"
                                                value="{{ old('parish') }}">
                                        </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="village">Ciems</label>
                                    <input type="text" name="village" id="village" class="form-control"
                                        value="{{ old('village') }}">
                                </div>

                                <div class="form-group">
                                    <label for="street">Iela</label>
                                    <input type="text" name="street" id="street" class="form-control"
                                        value="{{ old('street') }}">
                                </div>

                                <div class="form-group">
                                    <label for="house">Māja</label>
                                    <input type="text" name="house" id="house" class="form-control"
                                        value="{{ old('house') }}">
                                </div>

                                <div class="form-group">
                                    <label for="apartment">Dzīvoklis</label>
                                    <input type="text" name="apartment" id="apartment" class="form-control"
                                        value="{{ old('apartment') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                <button type="submit" class="btn btn-primary w-25 mx-auto">Pievienot projektu</button>
                </form>
            </div>
        </div>
    </main>
@endsection
