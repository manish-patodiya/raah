function base_url(uri) {
    return BASE_URL + uri;
}
$(function () {
    "use strict";

    //Enable editor
    if (typeof wysihtml5 !== "undefined" && $(".wysihtml5").length)
        $(".wysihtml5").wysihtml5();

    $(document).on("click", "#div-upload-img", function () {
        $("#product_img").trigger("click");
    });

    let mProduct_table = () => {
        $("#manage_product").DataTable({
            ajax: {
                url: base_url("/seller/product/product/manage_product_list"),
                dataSrc: "details",
                data: function (data) {
                    data.cid = $("#get_categ_id").val();
                    data.sid = $("#status-shown-in-tbl").val();
                    data.stock = $("#stock").val();
                },
            },
            columnDefs: [
                { width: "10%", targets: 0 },
                {
                    targets: [0, 4, 5, 6],
                    orderable: false,
                },
                {
                    width: "10%",
                    targets: 6,
                    class: "text-end",
                },
            ],
        });
    };
    mProduct_table();

    $(document).on("change", "#get_categ_id", function () {
        $("#manage_product").DataTable().ajax.reload();
    });

    $(document).on("click", ".box-inverse", function () {
        let sid = $(this).attr("sid");
        // console.log(sid)
        $("#status-shown-in-tbl").val(sid);
        $("#manage_product").DataTable().ajax.reload();
    });
    $(document).on("click", "#out_of_stock", function () {
        $("#stock").val(0);
        $("#manage_product").DataTable().ajax.reload();
    });

    $(document).on('click', ".btn-submit-product", function () {
        let status = $(this).data("status");
        $("#inpt-product-status").val(status);
        $("#frm-add-product").submit();
    });

    $(document).on('click', ".btn-update-product", function () {
        let status = $(this).data("status");
        $("#inpt-product-status").val(status);
        $('#product_updated_detail').submit();
    });

    $("#frm-add-product").submit(function (e) {
        e.preventDefault();
        // CKEDITOR.instances.editor1.updateElement();
        var formData = new FormData(this);
        let product = {
            url: base_url("/seller/product/product/add"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    $("#dropzone_active").attr("href", "#dz-add-product");
                    $('.nav-tabs li a[href="#dz-add-product"]').tab("show");
                    $("#product_id").val(res.data.product_id);
                    show_toaster(res.msg, "top-right", "success");
                } else {
                    show_toaster(res.msg, "top-right", "error");
                }
            },
        };
        $.ajax(product);
    });

    $("#product_updated_detail").submit(function (e) {
        e.preventDefault();
        let id = $("#pro_id").val();
        var formData = new FormData(this);

        let product = {
            url: base_url("/seller/product/product/edit/" + id),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    show_toaster(res.msg, "top-right", "success");
                    window.location.reload()
                }
            },
        };
        $.ajax(product);
    });

    // upload product image on selecting any image
    $("#product_img").change(function () {
        let form_data = new FormData($("#frm-upload-img")[0]);
        $.ajax({
            type: "post",
            url: base_url("/seller/product/product/save_image"),
            data: form_data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    show_toaster(res.msg, "top-right", "success");
                    refresh_images();
                } else {
                    show_toaster(res.msg, "top-right", "error");
                }
            },
        });
    });

    // remove a image
    $(document).on("click", ".remove-image", function () {
        let _this = this;
        if (
            $(_this).closest(".div-pro-img").find("input[type=radio]").is(":checked")
        ) {
            swal({
                title: "You can not delete a default image.",
                text: "",
                type: "error",
            });
        } else {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Delete",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            },
                function (isConfirm) {
                    if (isConfirm) {
                        let img_id = $(_this).attr("data-value");
                        $.ajax({
                            url: base_url("/seller/product/product/remove_product_image"),
                            dataType: "json",
                            data: {
                                img_id: img_id,
                            },
                            success: function (res) {
                                if (res.status == 1) {
                                    show_toaster(res.msg, "top-right", "success");
                                    refresh_images();
                                } else {
                                    show_toaster(res.msg, "top-right", "error");
                                }
                            },
                        });
                    }
                }
            );
        }
    });

    // make a default image
    $(document).on("click", ".make-default", function () {
        if ($(this).is(":checked")) {
            let img_id = $(this).attr("data-value");
            let prod_id = $("#product_id").val();
            $.ajax({
                url: base_url("/seller/product/product/make_default_image"),
                dataType: "json",
                data: {
                    img_id: img_id,
                    prod_id: prod_id,
                },
                success: function (res) {
                    if (res.status == 1) {
                        show_toaster(res.msg, "top-right", "success");
                    } else {
                        show_toaster(res.msg, "top-right", "error");
                    }
                },
            });
        }
    });

    // function is used to make image
    function refresh_images() {
        let prod_id = $("#product_id").val();
        if (!prod_id) {
            return 0;
        }
        $.ajax({
            type: "get",
            url: base_url("/seller/product/product/get_product_images"),
            data: {
                prod_id: prod_id,
            },
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    $("#all_pr_img").html("");
                    res.data.all_images.map(function (ele) {
                        $("#all_pr_img").append(
                            `<div class='col-md-3 d-flex flex-column align-items-center div-pro-img' style='height:250px'>
                                <div class="d-flex justify-content-center align-items-center position-relative h-200 border"
                                    style='width:100%;'>
                                    <img src="${ele.product_image}" alt="">
                                    <i class="mdi mdi-close-circle fa-lg position-absolute remove-image pointer"
                                        style="top:-7px;right:-10px"
                                        title="Click to remove this image"
                                        data-value="${ele.pid || ele.id}"></i>
                                </div>
                                <input type="radio" name='is_default' ${Number(ele.is_default) ? "checked" : ""
                            } id='radio-default-${ele.id}' data-value='${ele.pid || ele.id
                            }' class='make-default'/>
                                <label for="radio-default-${ele.id
                            }">Default</label>
                            </div>`
                        );
                    });
                }
            },
        });
    }

    refresh_images();

    function show_toaster(msg, position, type) {
        $.toast({
            text: msg,
            position: position,
            loaderBg: "#ff6849",
            icon: type,
            hideAfter: 3500,
            stack: 6,
        });
    }

    $(document).on("click", ".sup_delete", function () {
        let id = $(this).attr("uid");
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this product.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
        },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: base_url("/seller/product/product/delete"),
                        method: "get",
                        data: {
                            id: id,
                            csrf_test_name: $("input[name=csrf_test_name]").val(),
                        },
                        dataType: "json",
                        success: function (res) {
                            if (res.status == 1) {
                                show_toaster(res.msg, "top-right", "success");
                                $("#manage_product").DataTable().ajax.reload();
                            } else {
                                swal("Deletion Failed!", res.msg, "error");
                            }
                        },
                    });
                }
            }
        );
    });

    $(document).on("click", ".select_hsn", function () {
        let details = $(this).attr("details");
        let hsn_code = $(this).attr("hsn_code");
        let gst_rate = $(this).attr("gst_rate");
        $("#hsn_detail").val(details);
        $("#hsn_code").val(hsn_code);
        $("#gst-rate").val(gst_rate).trigger("change");
        $(".bs-example-modal-lg").modal("hide");
    });

    $("#hsn_code_table").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/seller/product/product/datatable_json"),
            dataSrc: "details",
        },
        infoCallback: function (settings, start, end, max, total, pre) {
            if (start > total && total != 0) {
                $("#hsn_code_table").DataTable().page("previous").draw("page");
            }
        },
        columnDefs: [{
            targets: [1, 3],
            orderable: false,
        },
        {
            width: "10%",
            targets: 3,
            class: "text-end",
        },
        ],
        pageLength: 10,
        order: [
            [0, "asc"]
        ],
        searchDelay: 1000,
    });
});

// add columns along with category
$(function () {
    if (typeof properties != "undefined") {
        let cat_id = $('#category').val();
        get_properties(cat_id);
    }
    $('#category').on("change", function () {
        let cat_id = this.value;
        if (cat_id) {
            get_properties(cat_id)
        }
    });

    function get_properties(cat_id) {
        $.ajax({
            type: "get",
            url: base_url("/seller/product/product/get_properties"),
            data: {
                cat_id: cat_id,
            },
            beforeSend: function () {
                // $('.form-group,form').removeClass('error');
                // $('.help-block').remove();
                // $("input,select,textarea").not("[type=submit]").jqBootstrapValidation('destroy');
            },
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    if (res.data.properties.length) {
                        let properties = res.data.properties;
                        let div = '';
                        for (const key in properties) {
                            let label_id = properties[key].label_id;
                            let label = properties[key].label;
                            let values = properties[key].values;
                            div += make_property_fields(label_id, label, values);
                        }
                        $('#prod-prprty').html(div);
                    } else {
                        $('#prod-prprty').html("<h4 class='text-light'>No properties found with this category.</h4>");
                    }
                }
                $(".slct-lbl-cat-vals").jqBootstrapValidation();
            },
            error: function (err) {
                console.log(err);
            },
        });
    }

    function make_property_fields(label_id, label, values) {
        let options = '';
        for (const value_id in values) {
            options += `<option ${typeof properties != 'undefined' && (properties[label_id] == value_id) ? 'selected' : ''} value='${value_id}'>${values[value_id]}</option>`;
        }
        return `<div class="col-md-4">
                  <div class="form-group">
                      <label class="control-label">${label}<span
                              class="required"> *</span></label>
                      <input type="hidden" name='label[]'
                          value="${label_id}" />
                      <div class="controls">
                          <select name="value[]"
                              class="form-select bg-white slct-lbl-cat-vals"
                              data-validation-required-message="This field is required">
                              <option value="" selected>Select ${label}</option>
                              ${options}
                          </select>
                      </div>
                  </div>
              </div>`;
    }
})
