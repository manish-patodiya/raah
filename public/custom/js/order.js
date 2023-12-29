function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";



    $("#tbl-orders").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/admin/orders/myorders/orders_list"),
            dataSrc: 'details',
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            // console.log(start)
            if (start > total && total != 0) {
                $('#tbl-orders').DataTable().page('previous').draw('page');
            }
        },
        pageLength: 10,
        columns: [
            { data: 0, "orderData": 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
        ],
        order: [
            [0, 'asc']
        ],
        "columnDefs": [{
            'targets': [4],
            'orderable': false,
            'class': 'text-end'
        }, {
            'targets': [2, 3],
            'orderable': false,

        }, {
            'targets': [1],
            'orderable': false,
            'width': '50%',
        }],
        searchDelay: 1000,
    });






    // Order Setting  js  function  .........................
    let reload_datatable = () => {

        $("#order_setting_table").DataTable().ajax.reload();
    }
    let btn_create;

    $('#frm-order-setting-detail').validate({
        rules: {
            cancel_reason: {
                required: true,
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let frmdata = new FormData(form);
            let register = {
                beforeSend: function() {
                    $("#validation-err").html(``).hide();;
                    $("#btn-order-create").attr("disabled", true);
                    btn_create = $("#btn-order-create").html();
                    $("#btn-order-create").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/orders/ordersettings/add"),
                data: frmdata,
                method: "post",
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        reload_datatable();
                        $('#frm-order-setting-detail').trigger('reset');
                    } else {
                        console.log(res);
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function(key) {
                                $("#validation-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                            });;
                            $("#validation-err").show();
                        }
                    }
                },
                complete: function() {
                    $("#btn-order-create").attr("disabled", false).html(btn_create);
                },
            };
            $.ajax(register);
        },
    })

    $("#order_setting_table").DataTable({
        ajax: {
            url: base_url("/admin/orders/ordersettings/ordersetting_list"),
            dataSrc: 'details',
        },
        "columnDefs": [
            { "width": "10%", "targets": 0 },
            {
                'targets': [2],
                'orderable': false,
                'class': 'text-end'
            }
        ],
        'order': []
    })


    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('uid');
        $.ajax({
            url: base_url("/admin/orders/ordersettings/getOrderSettings"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#edit-order-setting').val(res.data.id);
                    $('#edit-cancel-reason').val(res.data.cancel_reason);
                    $('#mdl_edit_order_setting').modal('show');
                } else {
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 6
                    });
                }
            }
        })
    })


    let btn_update;

    $('#frm-edit-order-setting').validate({
        rules: {
            cencel_reason: {
                required: true,
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let frmdata = new FormData(form);
            let update = {
                beforeSend: function() {
                    $("#validation-err").html(``).hide();
                    // $("#btn-order-seeting").attr("disabled", true);
                    // btn_update = $("#btn-order-setting").html();
                    // $("#btn-order-create").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/orders/ordersettings/edit"),
                data: frmdata,
                method: "post",
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        reload_datatable();
                        $('#mdl_edit_order_setting').modal('hide');
                        $('#frm-edit-order-setting').trigger('reset');
                    } else {
                        console.log(res);
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function(key) {
                                $("#validation-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                            });;
                            $("#validation-err").show();
                        }
                    }
                },
                complete: function() {
                    // $("#btn-order-setting").attr("disabled", false).html(btn_create);
                },
            };
            $.ajax(update);
        },
    })

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('uid');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this order setting ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/orders/ordersettings/delete"),
                    method: "POST",
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
                            reload_datatable();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });


})