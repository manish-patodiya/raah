$(function() {
    $('select[name=type]').trigger('change');
    $('.div-variable').slimScroll({
        height: '590px'
    });

    $("#tbl-notification-temp").DataTable({
        // serverSide: true,
        ajax: {
            url: base_url("/admin/notifications/notificationtemplate/data_list"),
            dataSrc: 'list'
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            if (start > total && total != 0) {
                $('#hsn_details_table').DataTable().page('previous').draw('page');
            }
        },
        pageLength: 10,
        order: [
            [0, 'asc']
        ],
        "columnDefs": [{
            'targets': [0],
            'width': '5%',
        }, {
            'targets': [1],
            'width': '15%',
        }, {
            'targets': [3],
            'orderable': false,
            'class': 'text-end'
        }],
        searchDelay: 1000,
    });


    let create_btn;
    $('#frm-add-template').validate({
        rules: {
            title: {
                required: true,
                minlength: 4,
            },
            subject: {
                required: true,
                minlength: 4,
            },
            type: {
                required: true,
            },
            text_content: {
                required: true,
                minlength: 10,
            },
            editor_content: {
                required: true,
            }
        },
        messages: {},

        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.form-group'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                type: "post",
                url: base_url("/admin/notifications/notificationtemplate/add"),
                data: $(form).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#add-temp-err').html('').hide();
                    create_btn = $('#btn-create-temp').html();
                    $('#btn-create-temp').html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`).attr('disabled', true);
                },
                success: function(res) {
                    if (res.status == 1) {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 1500,
                            stack: 6
                        });
                        setTimeout(() => {
                            window.location = base_url("/admin/notifications/notificationtemplate");
                        }, 500);
                    } else {
                        if (res.errors) {
                            for (const key in res.errors) {
                                $('#add-temp-err').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#add-temp-err').show();
                        } else {
                            $.toast({
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 3500,
                                stack: 6
                            });
                        }
                    }
                },
                complete: function() {
                    $('#btn-create-temp').html(create_btn).attr('disabled', false);
                },
            });
        }
    })

    let update_btn;
    $('#frm-edit-template').validate({
        rules: {
            title: {
                required: true,
                minlength: 4,
            },
            subject: {
                required: true,
                minlength: 4,
            },
            type: {
                required: true,
            },
            text_content: {
                required: true,
                minlength: 10,
            },
            editor_content: {
                required: true,
            }
        },
        messages: {},

        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.form-group'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $.ajax({
                type: "post",
                url: base_url("/admin/notifications/notificationtemplate/edit"),
                data: $(form).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#edit-temp-err').html('').hide();
                    update_btn = $('#btn-update-temp').html();
                    $('#btn-update-temp').html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`).attr('disabled', true);
                },
                success: function(res) {
                    if (res.status == 1) {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 1500,
                            stack: 6
                        });
                        setTimeout(() => {
                            window.location = base_url("/admin/notifications/notificationtemplate");
                        }, 500);
                    } else {
                        if (res.errors) {
                            for (const key in res.errors) {
                                $('#edit-temp-err').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#edit-temp-err').show();
                        } else {
                            $.toast({
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 3500,
                                stack: 6
                            });
                        }
                    }
                },
                complete: function() {
                    $('#btn-update-temp').html(update_btn).attr('disabled', false);
                },
            });
        }
    })

    $(document).on('click', '.sup_delete', function() {
        temp_id = $(this).attr('temp_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/notifications/notificationtemplate/delete"),
                    method: "post",
                    data: {
                        temp_id: temp_id,
                        csrf_test_name: $('input[name=csrf_test_name]').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 1) {
                            $("#tbl-notification-temp").DataTable().ajax.reload();
                            $.toast({
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                stack: 6
                            });
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    })
});

function add_variable(name) {
    val = $('select[name=type]').val();
    if (val) {
        if (Number(val) == 2) {
            let data = CKEDITOR.instances['ckeditor'].getData()
            CKEDITOR.instances['ckeditor'].setData(data.trim() + ' ' + name);
        } else {
            let data = $('textarea[name=text_content]').val();
            $('textarea[name=text_content]').val(data.trim() + ' ' + name);
        }
    }
}

function copy_variable(name) {
    navigator.clipboard.writeText(name);
    $.toast({
        text: 'Variable copied',
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'info',
        hideAfter: 1500,
        stack: 6
    });
}

function set_text_area(val) {
    if (val) {
        var validator = $("form").validate();
        validator.resetForm();
        if (Number(val) == 2) {
            if (!$('#text-area').hasClass('d-none')) {
                $('#text-area').addClass('d-none');
            }
            if ($('#editor-area').hasClass('d-none')) {
                $('#editor-area').removeClass('d-none');
            }
        } else {
            if ($('#text-area').hasClass('d-none')) {
                $('#text-area').removeClass('d-none');
            }
            if (!$('#editor-area').hasClass('d-none')) {
                $('#editor-area').addClass('d-none');
            }
        }
    }
}