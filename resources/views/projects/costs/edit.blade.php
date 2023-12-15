@extends('layouts.app')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit cost</h1>
  </div>

<div class="container">
	<div class="row">
        <form method="POST" action="{{ route('projects.costs.update', [$project_id, $cost]) }}">
          @csrf
          @method('PUT')
          <!-- Task title -->

			<div class="form-group">
        <label for="task_title">Task title</label>
        <input type="text" name="task_title" id="task_title" class="form-control" value="{{old('task_title', $cost->task_title)}}" required autofocus>
        @error('task_title')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

			<!-- Unit -->

			<div class="form-group">
				<label for="unit">Unit</label>
				<select name="unit" id="unit" class="from-control" autofocus>
					<option value=""></option>
					<option value="m2">m2</option>
					<option value="m3">m3</option>
					<option value="m">m</option>
					<option value="gab">gab</option>
				</select>
				<label for="custom_unit">Write your own<label>
				<input id="custom_unit" class="form-control" type="text" name="custom_unit"
					value={{old('custom_unit', $cost->custom_unit)}}>

				@error('unit')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
        @error('custom_unit')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

			<!-- Amount -->

			<div class="form-group">
				<label for="amount" class="form-label">{{ __('Amount') }}</label>
				<input id="amount" class="form-control" type="number" name="amount" value="{{ old('amount', $cost->amount) }}"
						required autofocus autocomplete="amount">
				@if($errors->has('amount'))
						<div class="invalid-feedback">
								{{ $errors->first('amount') }}
						</div>
				@endif
		</div>
		

			<!-- Task cost per unit -->

			<div class="form-group">
				<label for="task_cost_per_unit" class="form-label">{{ __('Task cost per unit') }}</label>
				<input id="task_cost_per_unit" class="form-control" type="number" name="task_cost_per_unit"
							 value="{{ old('task_cost_per_unit', $cost->task_cost_per_unit) }}" required autofocus autocomplete="task_cost_per_unit">
				@if($errors->has('task_cost_per_unit'))
						<div class="invalid-feedback">
								{{ $errors->first('task_cost_per_unit') }}
						</div>
				@endif
		</div>
		
		
			<!-- Material cost per unit -->

			<div class="form-group">
				<label for="material_cost_per_unit" class="form-label">{{ __('Material cost per unit') }}</label>
				<input id="material_cost_per_unit" class="form-control" type="number" name="material_cost_per_unit"
							 value="{{ old('material_cost_per_unit', $cost->material_cost_per_unit) }}" required autofocus autocomplete="material_cost_per_unit">
				@if($errors->has('material_cost_per_unit'))
						<div class="invalid-feedback">
								{{ $errors->first('material_cost_per_unit') }}
						</div>
				@endif
		</div>
		

		<button type="submit" class="btn btn-primary">Submit</button>

          </form>
    </div>
  </div>
</main>
@endsection
