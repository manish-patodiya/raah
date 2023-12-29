function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";
    const ajax_get_list = () => $.ajax({
        type: "get",
        url: base_url('/admin/product/categories/get_categories'),
        dataType: "json",
        success: function(response) {
            $('#cat-list').html(response.html);
            let options = '<option value="0" selected>Select parent category from table</option>';
            response.list.map((ele) => {
                options += `<option value="${ele.id}">${ele.category_name}</option>`;
            });
            $('.slct-prnt-cat').html(options);
        }
    });
    ajax_get_list();

    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('cate_id');
        let unit = {
            url: base_url("/admin/product/categories/get_categories_id"),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $("#edit_form").trigger('reset');
                    $('#e_category_id').val(res.data.id);
                    $('#e-slct-prnt-cat').val(res.data.pid).trigger('change');
                    $('#e_ctegory').val(res.data.category_name);
                    $('#div-add-cat').addClass('d-none');
                    $('#div-edit-cat').removeClass('d-none');
                }
            }
        }
        $.ajax(unit);
    });


    $("#edit_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let unit = {
            url: base_url("/admin/product/categories/edit"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('.modal').modal('hide');
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    ajax_get_list();
                }
            }
        }
        if ($('#e_category_id').val() != $('#e-slct-prnt-cat').val()) {
            $.ajax(unit);
        } else {
            $.toast({
                text: 'A category is not parent of itself.',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3500,
                stack: 6
            });
        }
    })

    $("#categories_detail").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let unit = {
            url: base_url("/admin/product/categories/add"),
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
                    $("#categories_detail").trigger('reset');
                    ajax_get_list();
                }
            }
        }
        $.ajax(unit);
    })

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('uid');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this cateogry.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/product/categories/deleted"),
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
                            ajax_get_list();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });

    // csv 
    $("#btn-add-csv").click(function() {
        $("#mdl-add-csv").modal("show");
    });


    $('#frm-add-csv').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var upload = {
            url: base_url("/admin/product/categories/uploadCSV"),
            data: formData,
            dataType: "json",
            method: "post",
            processData: false,
            contentType: false,
            success: function(res) {
                if ((res.status = 1)) {
                    $("#mdl-add-csv").modal("hide");
                    $(".modal-backdrop").remove();
                    $("#success-msg").html(res.msg);
                    $("#success-msg").show();
                    ajax_get_list();
                    $('#csv_upload_file').val('');
                    setTimeout(function() {
                        $("#success-msg").hide();
                    }, 1000);
                }
            },
        };
        $.ajax(upload);
    })

    $(document).on('click', '.row-cat', function() {
        $(this).find('i').toggleClass('mdi-plus-box mdi-minus-box');
    })

    $(document).on('click', '.slct-cat', function() {
        let cat_id = $(this).attr('cat_id');
        $('.slct-prnt-cat').val(cat_id).trigger('change');
    })

    $('#toggle-card').click(function() {
        $("#categories_detail").trigger('reset');
        $("#edit_form").trigger('reset');
        $('#div-edit-cat').addClass('d-none');
        $('#div-add-cat').removeClass('d-none');
    })

    $(document).on('mouseenter', '.cat-row', function() {
        $(this).find('.div-cat-actions').show();
    }).on('mouseleave', '.cat-row', function() {
        $(this).find('.div-cat-actions').hide();
    });
})