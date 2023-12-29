function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";

    $("#cities_table").DataTable({
        ajax: {
            url: base_url("/admin/settings/city/cities_list"),
            dataSrc: 'details',
        },
        "columnDefs": [{
            'targets': [3],
            'orderable': false,
            'class': 'text-end'
        }]
    })

    $("#city_details").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let city = {
            url: base_url("/admin/settings/city/add"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    $('#city_name').val('');
                    $('#state').val('');
                    $("#cities_table").DataTable().ajax.reload();

                }
            }
        }
        $.ajax(city);
    })

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('city_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this city",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/settings/city/delete"),
                    method: "post",
                    data: {
                        id: id,
                        "csrf_test_name": $('input[name=csrf_test_name]').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 1) {
                            $.toast({
                                // heading: 'Welcome to my Deposito Admin',
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                stack: 6
                            });
                            $("#cities_table").DataTable().ajax.reload();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });

    $("#edit_city").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let company = {
            url: base_url("/admin/settings/city/edit"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#mdl_edit_cities').modal('hide');
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    $("#cities_table").DataTable().ajax.reload();

                }
            }
        }
        $.ajax(company);
    })

    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('cities_id');
        let city = {
            url: base_url("/admin/settings/city/get_cities_id"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    console.log(res.data);
                    $('#e_city_id').val(res.data.city_id);
                    $('#e_city').val(res.data.city_name);
                    $('#e_state').val(res.data.state_id);
                    $('#mdl_edit_cities').modal('show');
                }
            }
        }
        $.ajax(city);
    })

})