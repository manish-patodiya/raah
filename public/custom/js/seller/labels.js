function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";

    $('#label').select2({
        tags: true,
    })

    $("#add_label").click(function() {
        let new_label = $("#new_label").val()
        if (new_label != "") {
            let label = {
                url: base_url("/admin/product/attributes/add"),
                data: {
                    "label": new_label,
                    "csrf_test_name": $('input[name=csrf_test_name]').val(),
                },
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
                        $("#new_label").val("")
                        window.location = base_url("/admin/product/attributes")
                    }
                }
            }
            $.ajax(label);
        }
    });

    $(document).on("click", "#add_label_value", function() {
        let new_value = $("#new_value").val()
        let cat_id = $(this).attr('cid')
        let label_id = $(this).attr('label_id')
        if (new_value != "") {
            let label = {
                url: base_url("/admin/product/attributes/values"),
                data: {
                    "cat_id": cat_id,
                    "label_id": label_id,
                    "value": new_value,
                    'csrf_test_name': $('input[name=csrf_test_name]').val(),
                },
                method: "post",
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        $.toast({
                            heading: 'Category new value was inserted successfully',
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        $("#new_value").val("")
                        $("#value_box").load(location.href + " #value_box");
                        // $("cat_id").trigger("click")
                    }
                }
            }
            $.ajax(label);
        }
    });
    $(document).on("click", ".labels", function() {
        let lid = $(this).attr("lid");
        $(".cat_id").attr('label_id', lid)
            // console.log();

    })
    $(document).on("click", ".labels", function() {
        $(".values").html(`<a class="media media-single px-2" href="#">
        <span class="title">Now select any category</span>
        </a>`)
    })
    var values = () => {
        $(document).on("click", ".cat_id", function() {
            let cat_id = $(this).attr('cid')
            let label_id = $(this).attr('label_id')
            console.log(label_id)
            $.ajax({
                url: base_url("/admin/product/attributes/values"),
                method: "post",
                data: {
                    "cat_id": cat_id,
                    "label_id": label_id,
                    "csrf_test_name": $('input[name=csrf_test_name]').val(),
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        $(".values").html("")
                        if (res.values == "") {
                            $(".values").append(`<a class="media media-single" href="#">
                                  <span class="title">No result found</span>
                            </a>`)
                        } else {
                            $('.value_box').html(`
                            <div class="media-list media-list-hover media-list-divided form-group mb-0">
                                <div class="row">
                                    <div class="input-group ps-3">
                                        <input type="text" name="new_value" class="form-control border-0 border-bottom" id="new_value" placeholder="Type to add new value" data-validation-required-message="This field is required">
                                        <button type="button" class="btn btn-sm btn-info rounded-0" id="add_label_value" cid="${cat_id}"
                                        label_id="${label_id}">
                                        Create Value
                                    </button>
                                    </div>
                                </div>
                            </div>
                            <div class="media-list media-list-hover media-list-divided values"></div>`)

                            res.values.map(function(key) {
                                $(".values").append(`<a class="media media-single val_id" vid="${key.id}" href="#">
                                    ${key.value}
                                </a>`)
                            })
                        }
                    }
                }

            })
        })
    }
    values()
        // var labels = () => {
        //         $.ajax({
        //             url: base_url("/admin/product/attributes/labels"),
        //             dataType: "json",
        //             success: function(res) {
        //                 if (res.status == 1) {
        //                     $(".lid").html("")
        //                     res.labels.map(function(key) {
        //                         $(".lid").append(`<a class="media media-single labels" lid="${key.id}" href="#">
        //         ${key.label}
        //     </a>`)
        //                     })
        //                 }
        //             }
        //         })
        //     }
        // labels()

    $(".labels").hover(function() {
        // $(this).find(".arrow").display("show")
        $(this).children(".arrow").show();
    })
    $(".labels").mouseleave(function() {
        $(this).children(".arrow").hide();
    });
})