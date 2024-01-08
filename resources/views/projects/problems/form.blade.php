@extends('layouts.app')
@section('content')
    <main class="col-md-9 mx-auto col-lg-10 px-md-4">

        <div class="container pt-3">
            <h1>{{ isset($problem) ? 'Rediģēt problēmu' : 'Ziņot par problēmu' }}</h1>

            @if (isset($problem))
                <form action="{{ route('projects.problems.update', [$project, $problem]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('projects.problems.store', $project) }}" method="POST"
                        enctype="multipart/form-data">
            @endif
            @csrf
            <div class="w-50">

            
            <div class="mb-3">
                <label for="title" class="form-label">Nosaukums</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ isset($problem) ? $problem->title : old('title') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Apraksts</label>
                <textarea class="form-control" id="description" name="description">{{ isset($problem) ? $problem->description : old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            @if (isset($images) && $images->isNotEmpty())
                <div class="mt-4">
                    <p>Pievienotie attēli:</p>
                    <div class="row">
                        @foreach ($images as $image)
                            <div class="col-md-3 mb-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $image->id }}">
                                    <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Image"
                                        class="img-fluid">
                                </a>
                            </div>
                    </div>
                </div>
                <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1"
                    aria-labelledby="imageModalLabel{{ $image->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel{{ $image->id }}"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Problem Image"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif

            <div class="form-group">
                <label for="images">Pievienot attēlus</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
                @error('images.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

            <button type="submit"
                class="btn btn-primary">{{ isset($problem) ? 'Rediģēt problēmu' : 'Ziņot par problēmu' }}</button>
            </form>
        </div>
    </main>
@endsection
