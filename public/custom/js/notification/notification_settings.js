$(function() {
    let btn_save;
    $('#frm-notification-settings').validate({
        rules: {
            'per_page': {
                required: true,
                min: 0,
            },
            'email_limit': {
                required: true,
                min: 0,
            },
            'notification_text_limit': {
                required: true,
                min: 0,
            },
        },
        messages: {},
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.form-group'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            // let form_data = new FormData(form);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url('/admin/notifications/notificationsettings/save_settings'),
                data: $(form).serialize(),
                beforeSend: function() {
                    $('#noti-set-err').html('').hide();
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
                                $('#noti-set-err').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#noti-set-err').show();
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
                    console.log(err.responseText);
                }
            });
        }
    });
})