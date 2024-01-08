<div class="modal fade" id="createCostModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="createModal">Pievienot ierakstu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('.alert-danger').remove(); "></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <form method="POST" action="{{ route('projects.costs.store', $project->id) }}">
                  @csrf
                  <!-- Task title -->
            
                  <div class="form-group">
                    <label for="create_task_title">Darba nosaukums</label>
                    <input type="text" name="task_title" id="create_task_title" class="form-control" value="{{old('task_title')}}">
                    @error('task_title')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
            
                  <!-- Unit -->
            
                  <div class="form-group">
                    <label for="create_unit">Mērvienība</label>
                    <select name="unit" id="create_unit" class="from-control">
                      <option value=""></option>
                      <option value="m2">m2</option>
                      <option value="m3">m3</option>
                      <option value="m">m</option>
                      <option value="gab">gab</option>
                    </select>
                    
                    <label for="create_custom_unit">Cita mērvienība<label>
                    <input id="create_custom_unit" class="form-control" type="text" name="custom_unit"
                      value={{old('custom_unit')}}>
                  </div>
            
                  <!-- Amount -->
            
                  <div class="form-group">
                    <label for="create_amount" class="form-label">Daudzums</label>
                    <input id="create_amount" class="form-control" type="number" name="amount" value="{{ old('amount') }}">
                </div>
                
            
                  <!-- Task cost per unit -->
            
                  <div class="form-group">
                    <label for="create_task_cost_per_unit" class="form-label">Darba vienības izmaksas</label>
                    <input id="create_task_cost_per_unit" class="form-control" type="number" name="task_cost_per_unit"
                      value="{{ old('task_cost_per_unit') }}">
                </div>
                
                
                  <!-- Material cost per unit -->
            
                  <div class="form-group">
                    <label for="create_material_cost_per_unit" class="form-label">Materiāla vienības izmaksas</label>
                    <input id="create_material_cost_per_unit" class="form-control" type="number" name="material_cost_per_unit"
                      value="{{ old('material_cost_per_unit') }}">
                  </div>
                
            
                <button type="submit" class="btn btn-primary">Pievienot</button>
                </form>
            
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
