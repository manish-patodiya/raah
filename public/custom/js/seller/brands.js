function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";

    $("#brand_detail").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
            },
            logo: {
                extension: 'jpg|png|jpeg',
            },
            link: {
                isUrlValid: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your brand name",
                minlength: "Brand name cannot be less than 2 characters"
            },
            logo: {
                extension: 'Your extension msut be jpg, png, jpeg',
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            var formData = new FormData(form);
            $.ajax({
                url: base_url("/admin/product/brands/add"),
                method: "post",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == 1) {
                        console.log(res.msg);
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        window.location = base_url("/admin/product/brands");
                    }
                }
            })
        },
    });

    $("#edit_brand_detail").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
            },
            logo: {
                extension: 'jpg|png|jpeg',
            },
            link: {
                isUrlValid: true,
            }
        },
        messages: {
            name: {
                required: "Brand name cannot be empty",
                minlength: "Brand name cannot be less than 2 characters"
            },
            logo: {
                extension: 'Your extension msut be jpg, png, jpeg',
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault()
            var formData = new FormData(form);
            let id = $("#brand_id").val()
            $.ajax({
                url: base_url("/admin/product/brands/edit/" + id),
                method: "post",
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 1) {
                        console.log(res.msg)
                        $.toast({
                            // heading: 'Welcome to my Deposito Admin',
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        window.location = base_url("/admin/product/brands");
                    }
                }
            })
        },
    });

    $("#brand_details_table").DataTable({
        serverSide: true,
        ajax: {
            url: base_url("/admin/product/brands/datatable_json"),
            dataSrc: 'details'
        },
        "infoCallback": function(settings, start, end, max, total, pre) {
            // console.log(start)
            if (start > total && total != 0) {
                $('#hsn_details_table').DataTable().page('previous').draw('page');
            }
        },
        pageLength: 10,
        columns: [
            { data: 0, "orderData": 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            // { data: 4 },
            // { data: 5 },
            { data: 4 }
        ],
        order: [
            [0, 'asc']
        ],
        "columnDefs": [{
            'targets': [4],
            'orderable': false,
            'class': 'text-end'
        }],
        searchDelay: 1000,
    });

    $("#brand_logo").change(function() {
        var file = this.files[0];
        let path =
            console.log(file);
        if (file) {
            $("#logo").attr('src',
                URL.createObjectURL(file)
            );
        }
    })

    $(document).on('click', '.brand_delete', function() {
        let id = $(this).attr('brand_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this brand",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/product/brands/deleted"),
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
                            $("#brand_details_table").DataTable().ajax.reload();
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });
})