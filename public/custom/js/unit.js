function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";

    $("#unit_table").DataTable({
        ajax: {
            url: base_url("/admin/product/unit/unitList"),
            dataSrc: 'details',
        },
        "columnDefs": [
            { "width": "10%", "targets": 0 },
            {
                'targets': [4],
                'orderable': false,
                'class': 'text-end'
            }
        ]
    })


    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('unit_id');
        console.log(id);
        let unit = {
            url: base_url("/admin/product/unit/get_unit_id"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    console.log(res.data.title);
                    $('#e_unit_id').val(res.data.id);
                    $('#e_title').val(res.data.title);
                    $('#e_base_unit').val(res.data.base_unit);
                    $('#e_con_rate').val(res.data.conversion_rate);
                    $('#mdl_edit_unit').modal('show');
                }
            }
        }
        $.ajax(unit);
    })

    $("#edit_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let unit = {
            url: base_url("/admin/product/unit/edit"),
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
                    $('#mdl_edit_unit').modal('hide');
                    $("#unit_table").DataTable().ajax.reload();

                }
            }
        }
        $.ajax(unit);
    })
    $("#unit_detail").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let unit = {
            url: base_url("/admin/product/unit/add"),
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
                    $('#title').val('');
                    $('#base_unit').val('');
                    $('#con_rate').val('');
                    $("#unit_table").DataTable().ajax.reload();
                }
            }
        }
        $.ajax(unit);
    })

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('uid');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this unit.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/product/unit/deleted"),
                    method: "post",
                    data: {
                        id: id,
                        csrf_test_name: $('input[name=csrf_test_name]').val(),
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
                            $("#unit_table").DataTable().ajax.reload();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });
})