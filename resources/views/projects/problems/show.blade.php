@extends('layouts.app')

@section('content')
    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        @include('components.success-alert')
        <div class="container pt-3">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            
           @if ($problem->open_status)
           <h1>{{ $problem->title }}</h1>
            <form method="POST" action="{{ route('problems.close', $problem) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger btn-md">Aizvērt problēmu</button>
            </form> 
            @else
            <h1 class="text-secondary">{{ $problem->title }}</h1>
           @endif
        </div>
           <p>{{ $problem->description }}</p>
                      
            @if ($problemImages->isNotEmpty())
            <div>
                <h2>Attēli:</h2>
                <div class="row">
                    @foreach ($problemImages as $image)
                        <div class="col-md-3">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                                <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Problem Image" class="img-fluid">
                            </a>
                            <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $image->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel{{ $image->id }}"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Problem Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        </div>
    </main>
@endsection
