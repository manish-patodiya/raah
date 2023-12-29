$(function() {
    $('#frm-razorpay').validate({
        rules: {
            razorpay_keyid: {
                required: true,
            },
            razorpay_secretkey: {
                required: true,
            }
        },
        messages: {},
        errorReplacement: function(err, ele) {
            err.appendTo(ele.parent('form-control'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            save_payment_details(form, base_url(
                    '/admin/settings/paymentsetting/save_razorpay_creds'),
                '#btn-save-razorpay');
        }

    });

    $('#frm-paytm').validate({
        rules: {
            paytm_merchantid: {
                required: true,
            },
            paytm_merchantkey: {
                required: true,
            },
            paytm_website: {
                required: true,
            },
            paytm_industrytype: {
                required: true,
            },
        },
        messages: {},
        errorReplacement: function(err, ele) {
            err.appendTo(ele.parent('form-control'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            save_payment_details(form, base_url('/admin/settings/paymentsetting/save_paytm_creds'),
                '#btn-save-paytm');
        }
    })

    $('#frm-update-gateway').submit(function(e) {
        e.preventDefault();
        let btn_save;
        let btn_id = '#btn-update-geteway'
        let form = this;
        $.ajax({
            type: "get",
            url: base_url('/admin/settings/paymentsetting/update_gateway'),
            data: $(form).serialize(),
            dataType: "json",
            beforeSend: function() {
                $(btn_id).attr("disabled", true);
                btn_save = $(btn_id).html();
                $(btn_id).html(
                    `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
                );
            },
            success: function(res) {
                if (res.status == 1) {
                    show_toast('', res.msg, 'top-right', 'success');
                } else {
                    show_toast('Details are missing.', res.msg, 'top-right', 'error', 5000);
                }
            },
            complete: function() {
                $(btn_id).html(btn_save).attr('disabled', false);
            }
        });
    })
})

function save_payment_details(form, url, btn_id) {
    let btn_save;
    $.ajax({
        type: "post",
        url: url,
        data: $(form).serialize(),
        dataType: "json",
        beforeSend: function() {
            $(btn_id).attr("disabled", true);
            btn_save = $(btn_id).html();
            $(btn_id).html(
                `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
            );
        },
        success: function(res) {
            if (res.status == 1) {
                show_toast('', res.msg, 'top-right', 'success');
            } else {
                show_toast('', res.msg, 'top-right', 'error');
            }
        },
        complete: function() {
            $(btn_id).html(btn_save).attr('disabled', false);
        }
    });
}

function removeDetails(pay_type) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover these details",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: true,
        showLoaderOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: base_url('/admin/settings/paymentsetting/remove_details'),
                method: "get",
                data: {
                    payment_type: pay_type,
                },
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        window.location.reload();
                    }
                }
            })
        }
    });
}