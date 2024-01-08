$(document).ready(function () {
    $('#createCostModal form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response.success);
                $('#createCostModal').modal('hide');
                $('#createCostModal form')[0].reset();
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
                        $("#create_" + key).after('<div class="alert alert-danger">' + value + '</div>');
                    });
                }
            }
        });
    });
});
