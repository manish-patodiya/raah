function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";

    $("#languages_table").DataTable({
        ajax: {
            url: base_url("/admin/settings/language/languages_list"),
            dataSrc: 'details',
        },
        "columnDefs": [{
            'targets': [4],
            'orderable': false,
            'class': 'text-end'
        }]
    })

    $("#language_details").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let language = {
            url: base_url("/admin/settings/language/add"),
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
                    $('#short_name').val('');
                    $('#status').val('');
                    $('#language_name').val('');
                    $("#languages_table").DataTable().ajax.reload();
                }
            }
        }
        $.ajax(language);
    })

    //Warning Message
    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('lang_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this language",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/settings/language/delete"),
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
                            $("#languages_table").DataTable().ajax.reload();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });

    $("#edit_language").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let language = {
            url: base_url("/admin/settings/language/edit"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#mdl_edit_lang').modal('hide');
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    $("#languages_table").DataTable().ajax.reload();

                }
            }
        }
        $.ajax(language);
    })

    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('lang_id');
        console.log(id);
        let language = {
            url: base_url("/admin/settings/language/get_language_id"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#e_language_id').val(res.data.id);
                    $('#e_language_name').val(res.data.name);
                    $('#e_short_name').val(res.data.short_name);
                    $('#e_status').val(res.data.status);
                    $('#mdl_edit_lang').modal('show');
                }
            }
        }
        $.ajax(language);
    })
})