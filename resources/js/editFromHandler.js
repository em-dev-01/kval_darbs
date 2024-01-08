$(document).ready(function () {

    $('.edit-cost-form').on('click', function() {
        var cost_id = $(this).data('cost-id');
        var project_id = $(this).data('project-id');

        $.ajax({
            url: '/projects/' + project_id + '/costs/' + cost_id + '/edit',
            method: 'GET',
            success: function(response) {
                var formAction = '/projects/' + response.project_id + '/costs/' + response.cost_id;

                var units = ['m2', 'm3', 'm', 'gab'];
                if ($.inArray(response.unit, units) !== -1) {
                    $('#edit_unit').val(response.unit);
                } else {
                    $('#edit_unit').val('');
                    $('#edit_custom_unit').val(response.unit);
                }
                $('#editForm').attr('action', formAction);
                $('#edit_task_title').val(response.task_title);
                $('#edit_amount').val(response.amount);
                $('#edit_task_cost_per_unit').val(response.task_cost_per_unit);
                $('#edit_material_cost_per_unit').val(response.material_cost_per_unit);

                $('#editCostModal').modal('show');
            },
            error: function(error) {
                console.error('Error fetching cost data:', error.responseJSON);
            }
        });
    });

  $('#editCostModal form').submit(function (e) {
      e.preventDefault();
      
      $.ajax({
          url: $(this).attr('action'),
          method: $(this).attr('method'),
          data: $(this).serialize(),
          success: function (response) {
              $('#editCostModal').modal('hide');
              $('#editCostModal form')[0].reset();
              location.reload();
          },
          error: function (xhr) {
              if (xhr.status === 422) {
                  var errors = xhr.responseJSON.errors;
                  $('.alert-danger').remove();
                  $.each(errors, function (key, value) {
                    if (key == "unit" || key == "custom_unit"){
                        value = "Izvēlies vērtību no saraksta vai ieraksti savu"
                    }
                    $("#edit_" + key).after('<div class="alert alert-danger">' + value + '</div>');
                  });
              }
          }
      });
  });
});
