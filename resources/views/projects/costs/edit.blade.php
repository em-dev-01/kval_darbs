<div class="modal fade" id="editCostModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="$('.alert-danger').remove(); "></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        @isset($cost)
                            <form method="POST" id="editForm">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="edit_task_title">Darba nosaukums</label>
                                    <input type="text" name="task_title" id="edit_task_title" class="form-control"
                                        value="{{ old('task_title', $cost->task_title) }}">
                                    @error('task_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="edit_unit">Mērvienība</label>
                                    <select name="unit" id="edit_unit" class="from-control">
                                        <option value=""></option>
                                        <option value="m2" {{ old('unit', $cost->unit) == 'm2' ? 'selected' : '' }}>m2</option>
                                        
                                        <option value="m3" {{ old('unit', $cost->unit) == 'm3' ? 'selected' : '' }}>m3</option>
                                        
                                        <option value="m" {{ old('unit', $cost->unit) == 'm' ? 'selected' : '' }}>m</option>
                                        
                                        <option value="gab" {{ old(' unit', $cost->unit) == 'gab' ? 'selected' : '' }}>gab</option>
                                    </select>
                                    @error('unit')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label for="edit_custom_unit">Cita mērvienība<label>
                                            <input id="edit_custom_unit" class="form-control" type="text" name="custom_unit">
                                            @error('custom_unit')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                </div>

                                <div class="form-group">
                                    <label for="edit_amount" class="form-label">Daudzums</label>
                                    <input id="edit_amount" class="form-control" type="number" name="amount">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="edit_task_cost_per_unit" class="form-label">Darba vienības izmaksas</label>
                                    <input id="edit_task_cost_per_unit" class="form-control" type="number"
                                        name="task_cost_per_unit">
                                </div>

                                <div class="form-group">
                                    <label for="edit_material_cost_per_unit" class="form-label">Materiāla vienības
                                        izmaksas</label>
                                    <input id="edit_material_cost_per_unit" class="form-control" type="number"
                                        name="material_cost_per_unit">
                                </div>
                                <button type="submit" class="btn btn-primary">Saglabāt</button>
                            </form>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
