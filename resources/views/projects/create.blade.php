@extends('layouts.app')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create a new project</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-text-bottom" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        This week
      </button>
    </div>
  </div>

  <div class="container">
    <div class="row">

      <form action="{{route('projects.store')}}" method="post">
        @csrf
      {{-- Title --}}
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" >
        @error('title')
          <div class="alert alert-danger">{{$message}}</div>
        @enderror
        </div>

      {{-- Adress --}}
      {{-- City --}}
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" id="city" class="form-control" value="{{old('city')}}" >
      </div>

      <div class="form-group">
        <label for="county">County</label>
        <input type="text" name="county" id="county" class="form-control" value="{{old('county')}}" >
      </div>

      <div class="form-group">
        <label for="parish">Parish</label>
        <input type="text" name="parish" id="parish" class="form-control" value="{{old('parish')}}" >
      </div>

      <div class="form-group">
        <label for="village">Village</label>
        <input type="text" name="village" id="village" class="form-control" value="{{old('village')}}" >
      </div>

      <div class="form-group">
        <label for="street">Street</label>
        <input type="text" name="street" id="street" class="form-control" value="{{old('street')}}" >
      </div>

      <div class="form-group">
        <label for="house">House</label>
        <input type="text" name="house" id="house" class="form-control" value="{{old('house')}}" >
      </div>

      <div class="form-group">
        <label for="apartment">Apartment</label>
        <input type="text" name="apartment" id="apartment" class="form-control" value="{{old('apartment')}}" >
      </div>

      <div class="form-group">
        <label for="due_date">Date</label>
        <input class="form-control" id="due_date" name="due_date" placeholder="MM/DD/YYYY" type="date">
        @error('due_date')
          <div class="alert alert-danger">{{$message}}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Example select</label>
        <select class="form-control" id="status" required>
          @foreach (App\Enums\StatusEnum::values() as $enumValue)
          <option value="{{ $enumValue }}"
            {{ old('status', App\Enums\StatusEnum::STARTED) == $enumValue ? 'selected' : '' }}>{{ $enumValue }}
          </option>
        @endforeach
        </select>
        @error('status')
          <div class="alert alert-danger">{{$message}}</div>
        @enderror
      </div>

      @if (count($employees) > 0)
      <div class="form-group">
        <span>List of employees working on this project</span>
        @foreach ($employees as $employee)
        <div class="form-check">
            <input type="checkbox" name="selected_employees[]" value="{{ $employee->id }}" class="form-check-input" id="employee{{$employee->id}}">
            <label class="form-check-label" for="employee{{$employee->id}}">{{ $employee->name }}</label>
        </div>
        @endforeach
    </div>
    
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>

    </form>
    </div>
  </div>
</main>
@endsection
