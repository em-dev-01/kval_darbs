@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit project</h1>
  </div>

  <div class="container">
    <div class="row">

      <form action="{{route('client_requests.update', $clientRequest)}}" method="post">
        @csrf
        @method('put')

      <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
          @foreach (App\Enums\ClientRequestStatusEnum::values() as $enumValue)
          <option value="{{ $enumValue }}"
            {{ old('status', App\Enums\ClientRequestStatusEnum::PENDING) == $enumValue ? 'selected' : '' }}>{{ $enumValue }}
          </option>
        @endforeach
        </select>
      </div>
       @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      <button type="submit" class="btn btn-primary">Update</button>

    </form>
    </div>
  </div>
</main>

@endsection