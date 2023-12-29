function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";
    $("#tbl-member").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/admin/customers/members_list"),
            dataSrc: 'details',
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            if (start > total && total != 0) {
                $('#tbl-member').DataTable().page('previous').draw('page');
            }
        },
        pageLength: 10,
        order: [
            [0, 'asc']
        ],
        "columnDefs": [{
            'targets': [4],
            'orderable': false,
            'class': 'text-end'
        }, {
            'targets': [2, 3, 4],
            'orderable': false,
        }],
        searchDelay: 1000,
    });
    let reload_datatable = () => {
        $("#tbl-member").DataTable().ajax.reload();
    }
    $(document).on('click', '#add-customer', function() {
        $('#mdl_customer_user').modal('show');
    })
    let btn_create;
    $("#frm-add-custm").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            pincode: {
                required: true,
                minlength: 4,
                maxlength: 10,
            },
            password: {
                required: true,
                minlength: 4,
                maxlength: 20,
            },
            cpassword: {
                required: true,
                equalTo: "#password",
            },
            address: {
                required: true,
            },
            citie_id: {
                required: true,
            },
            state_id: {
                required: true,
            },
            gst: {
                required: true,
            },
        },
        messages: {
            cpassword: {
                equalTo: "Password does not match",
            },
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
                    $("#btn-create").attr("disabled", true);
                    btn_create = $("#btn-create").html();
                    $("#btn-create").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/customers/add"),
                data: frmdata,
                method: "post",
                contentType: false,
                processData: false,
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
                        $('#mdl_customer_user').modal('hide');
                        $('#frm-add-custm').trigger('reset');
                        reload_datatable();
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
                    $("#btn-create").attr("disabled", false).html(btn_create);
                },
            };
            $.ajax(register);
        },
    });


    $(document).on('click', '.sup_update', function() {
        $('#frm-edit-user').trigger('reset');
        let id = $(this).attr('uid');
        console.log(id);
        $.ajax({
            url: base_url("/admin/customers/getCustomer"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    let customer = res.data.customer;
                    $('#edit-full-name').val(customer.full_name);
                    $('#edit-email').val(customer.email);
                    $('#edit-phone').val(customer.phone);
                    $('#edit-user-id').val(customer.user_id);
                    $('#edit-users-profile-id').val(customer.id);
                    $('#edit-address').val(customer.address);
                    $('#edit-pincode').val(customer.pincode);
                    $('#edit-state').val(customer.state_id);
                    let city_id = customer.city_id;
                    let city = res.data.city;
                    let option = '';
                    city.map(function(key) {
                        option += `<option value="${key.city_id}"${key.city_id == city_id ? 'selected' : false}>${key.city_name}</option>`;

                    })
                    console.log(option);
                    $('#edit-city').append(option);
                    $('#mdl_customers_user').modal('show');
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
        });
    })


    let btn_update;

    $("#frm-customer-user").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            citie_id: {
                required: true,
            },
            state_id: {
                required: true,
            },
        },
        messages: {
            cpassword: {
                equalTo: "Password does not match",
            },
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
                    $("#btn-updata-customer").attr("disabled", true);
                    btn_update = $("#btn-updata-customer").html();
                    $("#btn-updata-customer").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/customers/edit"),
                data: frmdata,
                method: "post",
                contentType: false,
                processData: false,
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
                        $('#mdl_customers_user').modal('hide');
                        $('#frm-customer-user').trigger('reset');
                        reload_datatable();
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
                    $("#btn-updata-customer").attr("disabled", false).html(btn_update);
                },
            };
            $.ajax(register);
        },
    });


    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('uid');
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
                    url: base_url("/admin/customers/delete"),
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

    $(document).on('click', '.sup_view', function() {
        let id = $(this).attr('uid');
        $.ajax({
            url: base_url("/admin/customers/getViewcustomer"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#span-full-name').html(':' + ' ' + res.data.full_name);
                    let profile = res.data.profile_photo || base_url("/public/images/avatar/avatar-1.png");
                    $('#profile').attr('src', profile);
                    $('#span-email').html(':' + ' ' + res.data.email);
                    $('#span-phone').html(':' + ' +91 ' + res.data.phone);
                    $('#span-gst').html(':' + ' ' + res.data.gst);
                    let address = res.data.address + ', ' + res.data.city_name + ', ' + res.data.state_name + ', ' + res.data.pincode;
                    $('#span-address').html(':' + '  ' + address);
                    $('#mdl_view_customer').modal('show');
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
        });
    });

})