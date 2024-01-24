function base_url(uri) {
    return BASE_URL + uri;
}

$(function() {
    console.log((new Date('Y/m/d')).toLocaleString())
    "use strict";
    $(document).on("click", "#upload-btn", function() {
        $("#product_img").trigger('click')
    })

    $(document).on("click", ".box-inverse", function() {
        let sid = $(this).attr("sid");
        $("#stock").val("");
        $("#status-shown-in-tbl").val(sid);
        $("#manage_product").DataTable().ajax.reload();
    });

    $(document).on("click", "#out_of_stock", function() {
        $("#status-shown-in-tbl").val("")
        $("#stock").val(0);
        $("#manage_product").DataTable().ajax.reload();
    });

    $(document).on("click", ".status_btn", function() {
        let sid = $(this).attr('sid')
        let data = '';
        if (sid == 3) {
            data = [{ "user_id": $(this).attr('uid'), "type": "1", "text": "Your product was accepted by admin", "fa_icon": "star" }];
        }
        if (sid == 4) {
            data = [{ "user_id": $(this).attr('uid'), "type": "1", "text": "Your product was rejected by admin", "fa_icon": "star" }];
        }
        if (sid == 5) {
            data = [{ "user_id": $(this).attr('uid'), "type": "1", "text": "Your product was disable by admin", "fa_icon": "star" }];
        }
        $.ajax({
            url: base_url("/admin/product/product/change_status"),
            data: {
                sid: $(this).attr('sid'),
                pid: $(this).attr('pid'),
                data: data,
            },
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
                    window.location.reload()
                }
            }
        })
    })
    let mProduct_table = () => {
        $("#manage_product").DataTable({
            ajax: {
                url: base_url("/admin/product/product/manage_product_list"),
                dataSrc: 'details',
                data: function(data) {
                    data.cid = $('#get_categ_id').val();
                    data.sid = $("#status-shown-in-tbl").val();
                    data.stock = $("#stock").val();
                }
            },
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                // { "width": "40%", "targets": 1 },
                // { "width": "15%", "targets": 5 },
                {
                    'targets': [0, 3, 4, 5],
                    'orderable': false,

                },
                {
                    "width": "10%",
                    "targets": 5,
                    'class': 'text-end'
                },

            ]
        })
    }
    mProduct_table()

    $(document).on('change', "#get_categ_id", function() {
        $("#manage_product").DataTable().ajax.reload();

    })

    $("#product_detail").validate({
        rules: {
            'title': {
                required: true,
                min: 2
            },
            'category_id': {
                required: true,
            },
            'unit_id': {
                required: true,
            },
            'hsn_code': {
                required: true,
            },
            'gst_rate': {
                required: true,
            }
        },
        messages: {
            'title': {
                min: "Product name must be greater than 2 characters"
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            CKEDITOR.instances.editor1.updateElement();
            var formData = new FormData(form);
            let product = {
                url: base_url("/admin/product/product/add"),
                data: formData,
                contentType: false,
                processData: false,
                method: "post",
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        $("#dropzone_active").attr('href', "#dz-add-product")
                        $('.nav-tabs li a[href="#dz-add-product"]').tab('show');
                        $("#product_id").val(res.product_id)
                        $("#success-alert").text(res.msg)
                        $("#success-alert").show()
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                    }
                }
            }
            $.ajax(product);
        }
    })

    $("#product_updated_detail").submit(function(e) {
        e.preventDefault();
        CKEDITOR.instances.editor1.updateElement();
        let id = $("#pro_id").val();
        var formData = new FormData(this);

        let product = {
            url: base_url("/admin/product/product/edit/" + id),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $("#dropzone_active").attr('href', "#dz-update-product")
                    $('.nav-tabs li a[href="#dz-update-product"]').tab('show');
                    $("#product_id").val(res.product_id)
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    // window.location = base_url("/admin/product/product/manage_products");
                }
            }
        }
        $.ajax(product);
    })
    $(document).on("change", "#product_img", function() {
        var file = this.files[0];
        if (file) {
            $(".img-div").html('<img src="' + URL.createObjectURL(file) + '" style="max-height:100%; max-width:100%;">')
        }
    })

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('uid');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this product.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/product/product/deleted"),
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
                            $("#manage_product").DataTable().ajax.reload();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });

    //Attach select2
    $('#hsn-code').select2({
        minimumInputLength: 1,
        ajax: {
            url: BASE_URL + '/Hsn/getHSNCodes',
            dataType: 'json',
            type: "GET",
            data: function(params) {
                var queryParameters = {
                    term: params.term
                }
                return queryParameters;
            },
            processResults: function(res) {
                let result = [];
                res.data.map(function(item) {
                    result.push({
                        id: item.hsn_code,
                        text: item.hsn_code,
                        subText: item.gst_rate
                    });
                })
                return {
                    results: result
                };
            },
            cache: true,
            delay: 250,
        },
        placeholder: 'Select HSN Code',
        escapeMarkup: function(markup) {
            return markup;
        },
        templateResult: function(d) {
            return '<span>' + d.text + '</span><span class="pull-right subtext text-secondary">' +
                (d.subText ? `[${d.subText}%]` : '') + '</span>';
        },
        templateSelection: function(d) {
            return d.text;
        }
    });

    $('#hsn-code').change(function() {
        let data = $(this).select2('data')[0];
        let gst = data.subText;
        $('#gst-rate').val(gst).trigger('change');
    })
    $(document).on("click", ".select_hsn", function() {
        let details = $(this).attr('details')
        let hsn_code = $(this).attr('hsn_code')
        let gst_rate = $(this).attr('gst_rate')
        $("#hsn_detail").val(details)
        $("#hsn_code").val(hsn_code)
        $('#gst-rate').val(gst_rate).trigger('change');
        $(".bs-example-modal-lg").modal('hide')
    })

    $("#hsn_code_table").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/admin/product/product/datatable_json"),
            dataSrc: 'details'
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            if (start > total && total != 0) {
                $('#hsn_code_table').DataTable().page('previous').draw('page');
            }
        },
        "columnDefs": [{
                'targets': [1, 3],
                'orderable': false,

            },
            {
                "width": "10%",
                "targets": 3,
                'class': 'text-end'
            },

        ],
        pageLength: 10,
        order: [
            [0, 'asc']
        ],
        searchDelay: 1000,
    });

})

// Properties rows crud
let next_prpty_row = 1;
$(function() {
    next_prpty_row = countPropertyRows() + 1;
    initializeSelect2();
})

function countPropertyRows() {
    let count = 0;
    $(document).find('.prpty-row').map(function() {
        count++;
    })
    return count;
}

function deleteRow(row_no) {
    let i = 0;
    $(document).find('.prpty-row').map(function() {
        i++;
    })
    if (i <= 1) {
        // swal("You can't delete it.", "There is only one row.", "error");
        $('#prpty-row-' + row_no).detach();
        next_prpty_row = 1;
        addRow()
    } else {
        $('#prpty-row-' + row_no).detach();
    }
}

function addRow() {
    let div = `<div class='form-group row prpty-row' id='prpty-row-${next_prpty_row}'>
                <div class='col-md-6'>
                    <select name="label[]" id='prpty-label-${next_prpty_row}' onchange='getValues(${next_prpty_row});' class='prpty-label form-control' style='width:100%'></select>
                </div>
                <div class='col-md-5'>
                    <select name="value[]" id="prpty-val-${next_prpty_row}" class='prpty-val form-control' style='width:100%'></select>
                    </div>
                    <div class='col-md-1'>
                    <a class='btn btn-danger btn-sm' onclick='deleteRow(${next_prpty_row})'><i class='fa fa-close'></i></a>
                </div>
            </div>`;
    $('#div-prpty').append(div);
    initializeSelect2ForOne(`prpty-val-${next_prpty_row}`, 'Select a value');
    initializeSelect2ForOne(`prpty-label-${next_prpty_row}`, "Select a property", select2_labels_options, 'nothing to shoe');
    next_prpty_row++;
}

function initializeSelect2() {
    $(document).find('.prpty-label').select2({
        tags: true,
        placeholder: "Select a property"
    });
    $(document).find('.prpty-val').select2({
        tags: true,
        placeholder: "Select a value",
    });
}

function initializeSelect2ForOne(id, placeholder = '', data = [], val = '') {
    $('#' + id).select2({
        tags: true,
        data: data,
        placeholder: placeholder,
    }).select2("val", val);
}

function getValues(RowNo) {
    let label_id = $('#prpty-label-' + RowNo).val();
    if (label_id) {
        $('select[name="label[]"]').each(function() {
            if ($(this).attr('id') != $('#prpty-label-' + RowNo).attr('id') && $(this).val() == label_id) {
                $('#prpty-label-' + RowNo).val('').trigger('change');
                $('#prpty-val-' + RowNo).empty();
                $.toast({
                    text: 'Duplicate entry',
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                });
                throw '';
            }
        });
        $.ajax({
            url: base_url("/admin/product/product/get_values"),
            method: "post",
            dataType: "json",
            data: {
                cat_id: $('#category').val(),
                label_id: label_id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            success: function(res) {
                if (res.status == 1) {
                    let options = [];
                    res.values.map((item) => {
                        options.push({
                            id: item.id,
                            text: item.value,
                        });
                    });
                    $('#prpty-val-' + RowNo).empty();
                    initializeSelect2ForOne(`prpty-val-${RowNo}`, 'Select a value', options);
                }
            }
        })
    }
}

function toggleProperties() {
    let cval = $('#category').val();
    if (!cval) {
        $('.prpty-label').attr('disabled', true)
        $('.prpty-val').attr('disabled', true)
    } else {
        $('.prpty-label').attr('disabled', false)
        $('.prpty-val').attr('disabled', false)
    }
}
toggleProperties();


$(function() {
    var previous;
    $("#category").on('focus', function() {
        previous = this.value;
    }).change(function() {
        if (previous != this.value) {
            $("#div-prpty").html("");
            addRow();
        }
    });
    $('#frm-bulk-upload').submit((e) => {
        e.preventDefault();
    })

    let btn_upld;
    $('#frm-bulk-upload').validate({
        rules: {
            'csv_content': {
                required: true,
                extension: "csv|xls"
            }
        },
        messages: {
            'csv_content': {
                extension: 'Only CSV file is allowed',
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let form_data = new FormData(form);
            $.ajax({
                type: "POST",
                contentType: false,
                processData: false,
                dataType: "json",
                url: base_url('/admin/product/product/upload_csv'),
                data: form_data,
                beforeSend: function() {
                    $('#bulk-upld-errors').html('Please do not refresh the page').addClass('alert-warning').show();
                    btn_upld = $('#btn-upld').html();
                    $('#btn-upld').html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`).attr('disabled', true);
                },
                success: function(res) {
                    $('#bulk-upld-errors').html('').hide();
                    if (res.status == 1) {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        $('#frm-bulk-upload').trigger('reset');
                    } else {
                        if (res.errors) {
                            for (const key in res.errors) {
                                $('#bulk-upld-errors').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#bulk-upld-errors').removeClass('alert-warning').show();
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
                    $('#btn-upld').html(btn_upld).attr('disabled', false);
                },
                error: function() {
                    $('#bulk-upld-errors').html('').hide();
                }
            });
        }
    });


    let btn_save;
    $('#frm-product-settings').validate({
        rules: {
            'per_page_web': {
                required: true,
                min: 0,
            },
            'per_page_mobile': {
                required: true,
                min: 0,
            },
            'max_product_limit': {
                required: true,
                min: 0,
            },
            'max_desription_text_limit': {
                required: true,
                min: 0,
            },
            'cron_url': {
                isUrlValid: true,
            }
        },
        messages: {},
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            // let form_data = new FormData(form);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url('/admin/product/productsettings/save_settings'),
                data: $(form).serialize(),
                beforeSend: function() {
                    $('#prdct-setting-err').html('').hide();
                    btn_save = $('#btn-save-settings').html();
                    $('#btn-save-settings').html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`).attr('disabled', true);
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
                    } else {
                        if (res.errors) {
                            for (const key in res.errors) {
                                $('#prdct-setting-err').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#prdct-setting-err').show();
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
                    $('#btn-save-settings').html(btn_save).attr('disabled', false);
                },
                error: function(err) {
                    ('#prdct-setting-err').html(err.responseText).show();
                }
            });
        }
    });

    // function htmlEncode(value) {
    //     return $('<div/>').text(value).html();
    // }

    $(function() {
        $("#generate").click(function() {

        });
    });
    $("#product_image").submit(function(e) {
        e.preventDefault();
        let qr_content;
        var formData = new FormData(this);
        let product = {
            url: base_url("/admin/product/product/product_images"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
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
                }
            },
            complete: function() {

            }
        }
        $.ajax(product);
    })
    
    $(document).on("click", ".image_id", function() {
        let image_id = $(".image_id").attr('img_id');
        let product_id = $("#product_id").val();
        // console.log(id);
        $.ajax({
            url: base_url("/admin/product/product/remove_product_image_by_id/" + image_id),
            datType: "json",
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
                }
                window.location = base_url("/admin/product/product/edit/" + product_id);
            }
        })
    })
    $(document).on('input', '.mrp', function(e) {
        e.target.value = (parseInt(e.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
    });
});