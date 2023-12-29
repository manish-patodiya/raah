function base_url(uri) {
    return BASE_URL + uri;
}

function change_status(btn_name) {
    let data;
    if (btn_name == "#reject-btn") {
        data = 2;
    } else {
        data = 1;
    }
    let id = $(btn_name).attr('store_id')
    $.ajax({
        url: base_url("/admin/sellers/change_store_status/" + id),
        dataType: "json",
        data: {
            'data': data
        },
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
                window.location = base_url("/admin/sellers")
            }
        }
    })
}

$(function() {
    "use strict";

    $("#tbl-seller").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/admin/sellers/sellers_list"),
            dataSrc: 'details',
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            // console.log(start)
            if (start > total && total != 0) {
                $('#tbl-seller').DataTable().page('previous').draw('page');
            }
        },
        pageLength: 10,
        columns: [
            { data: 0, "orderData": 0 },
            { data: 1 },
            { data: 2 },
        ],
        order: [
            [0, 'asc']
        ],
        "columnDefs": [{
            'targets': [2],
            'orderable': false,
            'class': 'text-end'
        }, {
            'targets': [1, 2],
            'orderable': false,
        }],
        searchDelay: 1000,
    });

    let reload_datatable = () => {
        $("#tbl-seller").DataTable().ajax.reload();
    }

    $(document).on('click', '#add-user', function() {
        $('#mdl_add_user').modal('show');
    })

    let btn_create;
    $("#frm-add-user").validate({
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
                required: false,
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
                url: base_url("/admin/sellers/add"),
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
                        $('#mdl_add_user').modal('hide');
                        $('#frm-add-user').trigger('reset');
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
        $.ajax({
            url: base_url("/admin/sellers/getSeller"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    let seller = res.data.seller;
                    $('#edit-full-name').val(seller.full_name);
                    $('#edit-email').val(seller.email);
                    $('#edit-phone').val(seller.phone);
                    $('#edit-user-id').val(seller.uid);
                    $('#edit-seller-id').val(seller.sid);
                    $('#edit-users-profile-id').val(seller.upid);
                    $('#edit-address').val(seller.address);
                    $('#edit-pincode').val(seller.pincode);
                    $('#edit-gst').val(seller.gstin);
                    $('#edit-state').val(seller.state_id);
                    let city_id = seller.city_id;
                    let city = res.data.city;
                    let option = '';
                    city.map(function(key) {
                        option += `<option value="${key.city_id}"${key.city_id == city_id ? 'selected' : false}>${key.city_name}</option>`;

                    })
                    console.log(option);
                    $('#edit-city').append(option);
                    $('#edit-logo').attr('src', seller.profile_photo);
                    $('#mdl_edit_user').modal('show');
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

    $("#frm-edit-user").validate({
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
            gst: {
                required: false,
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
            console.log(frmdata);
            let register = {
                beforeSend: function() {
                    $("#validation-err").html(``).hide();;
                    $("#btn-update").attr("disabled", true);
                    btn_update = $("#btn-update").html();
                    $("#btn-update").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/admin/sellers/edit"),
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
                        $('#mdl_edit_user').modal('hide');
                        $('#frm-edit-user').trigger('reset');
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
                    $("#btn-update").attr("disabled", false).html(btn_update);
                },
            };
            $.ajax(register);
        },
    });

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('uid');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this seller ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/sellers/delete"),
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
            url: base_url("/admin/sellers/getViewSeller"),
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
                    $('#mdl_view_user').modal('show');
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

    $("#user-profile").change(function() {
        var file = this.files[0];
        let path =
            console.log(file);
        if (file) {
            $("#logo").attr('src',
                URL.createObjectURL(file)
            );
        }
    })
    $('#user-cho-img').click(function() {
        $("#user-profile").click();
    })

    $("#edit-user-profile").change(function() {
        var file = this.files[0];
        let path =
            console.log(file);
        if (file) {
            $("#edit-logo").attr('src',
                URL.createObjectURL(file)
            );
        }
    })
    $('#edit-user-cho-img').click(function() {
        $("#edit-user-profile").click();
    })

    $(document).on("click", ".store_name", function() {
            // $("#btn-create").text("Ok")
            $(".store_details").html("")
            let id = $(this).attr('store_id')
            $.ajax({
                url: base_url("/admin/sellers/get_store_detail_by_store_id/" + id),
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let list = '';
                        for (const key in res.detail) {
                            switch (key) {
                                case "id":
                                    break;
                                case "Name":
                                    $("#store_name").html(res.detail[key])
                                    break;
                                case "status":
                                    $("#btn-create").html("Ok")
                                    break;
                                default:
                                    list += `<li class="nav-item"><a href="#" class="nav-link">` + key + `<span class="pull-right badge bg-info-light">` + res.detail[key] + `</span></a></li>`
                                    break;
                            }
                        }
                        $(".store_details").append(list)
                        $("#btn-create").attr("store_id", id)
                        $("#store_details").modal("show")
                    }
                }
            })
        })
        // $(document).on("click", "#btn-reject", function() {
        //     let id = $("#btn-create").attr('store_id')
        //     $.ajax({
        //         url: base_url("/admin/sellers/change_store_status/" + id),
        //         dataType: "json",
        //         success: function(res) {
        //             if (res.status == 1) {
        //                 $("#store_details").modal("hide")
        //                 $.toast({
        //                     text: res.msg,
        //                     position: 'top-right',
        //                     loaderBg: '#ff6849',
        //                     icon: 'success',
        //                     hideAfter: 3500,
        //                     stack: 6
        //                 });
        //                 window.location.reload()
        //             }
        //         }
        //     })
        // })

})