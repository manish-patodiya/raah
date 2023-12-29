function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";


    $("#hsn_details_table").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/admin/settings/hsn/datatable_json"),
            dataSrc: 'details'
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            // console.log(start)
            if (start > total && total != 0) {
                $('#hsn_details_table').DataTable().page('previous').draw('page');
            }
        },
        pageLength: 10,
        columns: [
            { data: 0, "orderData": 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
        ],
        order: [
            [0, 'asc']
        ],
        "columnDefs": [{
            'targets': [5],
            'orderable': false,
            'class': 'text-end'
        }],
        searchDelay: 1000,
    });

    $(document).on('click', '.add', function() {
        $('#mdl_add_hsn').modal('show');
    })

    $("#hsn_detail").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let hsn = {
            url: base_url("/admin/settings/hsn/add"),
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
                    $('#mdl_add_hsn').modal('hide');
                    $('#detail').val('');
                    $('#hsn_code').val('');
                    $('#hsn_code_4_digits').val('');
                    $('#gst_rate').val('');
                    $("#hsn_details_table").DataTable().ajax.reload();
                }
            }
        }
        $.ajax(hsn);
    });

    $("#edit_hsn_detail").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let hsn = {
            url: base_url("/admin/settings/hsn/edit"),
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
                        hideAfter: 3000,
                        stack: 6
                    });
                    $('#mdl_edit_hsn').modal('hide');
                    $("#hsn_details_table").DataTable().ajax.reload();

                }
            }
        }
        $.ajax(hsn);
    })

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('hsn_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/settings/hsn/delete_hsn"),
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
                                hideAfter: 3000,
                                stack: 6
                            });
                            $("#hsn_details_table").DataTable().ajax.reload();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });

    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('hsn_id');
        console.log(id);
        let hsn = {
            url: base_url("/admin/settings/hsn/get_hsn_id"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    console.log(res.data);
                    $('#e_hsn_id').val(res.data.id);
                    $('#e_detail').val(res.data.details);
                    $('#e_hsn_code').val(res.data.hsn_code);
                    $('#e_hsn_code_4_digits').val(res.data.hsn_code_4_digits);
                    $('#e_gst_rate').val(res.data.gst_rate);
                    $('#mdl_edit_hsn').modal('show');
                }
            }
        }
        $.ajax(hsn);
    })

})