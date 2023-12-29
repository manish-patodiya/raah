function base_url(uri) {
    return BASE_URL + uri;
}
$(function () {
    "use strict";


    let reload_datatable = () => {

        $("#shipping-rates-table").DataTable().ajax.reload();
    }
    let btn_create;

    $('#frm-order-setting-detail').validate({
        rules: {
            shipping_rates: {
                required: true,
            }
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            let frmdata = new FormData(form);
            let register = {
                beforeSend: function () {
                    $("#validation-err").html(``).hide();;
                    $("#btn-order-create").attr("disabled", true);
                    btn_create = $("#btn-order-create").html();
                    $("#btn-order-create").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/shipping/shippingrates/add"),
                data: frmdata,
                method: "post",
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (res) {
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
                            keys.map(function (key) {
                                $("#validation-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                            });;
                            $("#validation-err").show();
                        }
                    }
                },
                complete: function () {
                    $("#btn-order-create").attr("disabled", false).html(btn_create);
                },
            };
            $.ajax(register);
        },
    })

    $("#shipping-rates-table").DataTable({
        ajax: {
            url: base_url("/admin/shipping/shippingrates/shippingrates_list"),
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


    $(document).on('click', '.sup_update', function () {
        let id = $(this).attr('uid');
        $.ajax({
            url: base_url("/admin/shipping/shippingrates/getOrderSettings"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "GET",
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    $('#edit-shipping-rates-id').val(res.data.id);
                    $('#edit-shippingrates').val(res.data.shippingrates);

                    $('#mdl_edit_shippingrates').modal('show');
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

    $('#frm-edit-shipping-rates').validate({
        rules: {
            cencel_reason: {
                required: true,
            }
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            let frmdata = new FormData(form);
            let update = {
                beforeSend: function () {
                    $("#validation-err").html(``).hide();;
                    $("#btn-shipping-rates").attr("disabled", true);
                    btn_update = $("#btn-shipping-rates").html();
                    $("#btn-shipping-rates").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/shipping/shippingrates/edit"),
                data: frmdata,
                method: "post",
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (res) {
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
                        $('#mdl_edit_shippingrates').modal('hide');
                        $('#frm-edit-shipping-rates').trigger('reset');
                    } else {
                        console.log(res);
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function (key) {
                                $("#validation-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                            });;
                            $("#validation-err").show();
                        }
                    }
                },
                complete: function () {
                    $("#btn-shipping-rates").attr("disabled", false).html(btn_update);
                },
            };
            $.ajax(update);
        },
    })

    $(document).on('click', '.sup_delete', function () {
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
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/shipping/shippingrates/delete"),
                    method: "POST",
                    data: {
                        id: id,
                        "csrf_test_name": $('input[name=csrf_test_name]').val(),
                    },
                    dataType: "json",
                    success: function (res) {
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