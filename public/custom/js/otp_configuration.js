$(function() {
    let btn_save;
    $("#frm-otp-config").validate({
        rules: {
            'otp_limit': {
                required: true,
                min: 0,
            },
            'time_limit': {
                required: true,
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.form-group'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            $.ajax({
                type: "post",
                url: base_url('/admin/settings/OTPConfiguration/save_settings'),
                data: $(form).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#config-err').html('').hide();
                    btn_save = $('#btn-save-config').html();
                    $('#btn-save-config').html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`).attr('disabled', true);
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
                                $('#config-err').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#config-err').show();
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
                    $('#btn-save-config').html(btn_save).attr('disabled', false);
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        }
    })
})