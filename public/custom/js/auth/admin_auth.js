function base_url(uri) {
    return BASE_URL + '/' + uri;
}
$(function() {
    "use strict";
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() {
        Pace.restart()
    })

    var btn_login;
    $("#frm-login").validate({
        rules: {
            phone: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            let login = {
                url: base_url("auth/adminlogin"),
                beforeSend: function() {
                    $("#login-err").html(``).hide();
                    $("#btn-login").attr("disabled", true);
                    btn_login = $("#btn-login").html();
                    $("#btn-login").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                data: $("#frm-login").serialize(),
                method: "post",
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        if (res.roles) {
                            window.location = base_url("auth/loginAs");
                        } else {
                            window.location = base_url("admin/dashboard");
                        }
                    } else {
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function(key) {
                                $("#login-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                            });
                            $("#login-err").show();
                        } else {
                            $("#login-err").html(res.message);
                            $("#login-err").show();
                            $('#user-id').val(res.user_id);
                        }
                    }
                    if (res.phone) {
                        $('#otp-phone').html("+91 " + res.phone);
                    }
                },
                complete: function() {
                    $("#btn-login").attr("disabled", false).html(btn_login);
                },
                error: function(err) {
                    console.log(err);
                },
            };
            $.ajax(login);
        },
    });

});