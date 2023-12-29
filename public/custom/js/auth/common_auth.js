function base_url(uri) {
    return BASE_URL + '/' + uri;
}
$(function() {
    "use strict";
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() {
        Pace.restart()
    })

    var btn_forget;
    $("#forgot-password").validate({
        rules: {
            text: {
                required: true,
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let emailExist = {
                url: base_url("auth/forget_password"),
                beforeSend: function() {
                    $("#forgot-err").html(``).hide();
                    $("#btn-forgot").attr("disabled", true);
                    btn_forget = $("#btn-forgot").html();
                    $("#btn-forgot").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                method: "post",
                dataType: "json",
                data: $("#forgot-password").serialize(),
                success: function(res) {
                    if (res.status == 1) {
                        $('#msg').html(res.msg);
                    } else {
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function(key) {
                                $("#forgot-err").append(`
                            <li>${res.errors[key]}</li>
                            `);
                            });
                        } else {
                            $("#forgot-err").html(`<li>${res.msg}</li>`);
                        }
                        $("#forgot-err").show();
                    }
                },
                complete: function() {
                    $("#btn-forgot").attr("disabled", false).html(btn_forget);
                },
            }
            $.ajax(emailExist);
        },
    });

    let btn_reset_pass;
    $("#reset-password").validate({
        rules: {
            password: {
                required: true,
                minlength: 4,
            },
            cpassword: {
                required: true,
                minlength: 4,
                equalTo: '#password'
            }
        },
        messages: {
            cpassword: {
                equalTo: "Password does not match",
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let resetPass = {
                url: base_url("auth/set_pass"),
                beforeSend: function() {
                    $("#change-pass-err").html(``).hide();
                    $("#btn-change-pass").attr("disabled", true);
                    btn_reset_pass = $("#btn-change-pass").html();
                    $("#btn-change-pass").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                method: "post",
                dataType: "json",
                data: $("#reset-password").serialize(),
                success: function(res) {
                    if (res.status == 1) {
                        if (res.role == 3) {
                            window.location = base_url('/customer');
                        } else if (res.role == 2) {
                            $(".container").hide();
                            swal({
                                html: true,
                                title: 'Congratulations!',
                                text: `<h4>You can now login as seller</h4>
                                <span class='text-danger'>Note: <i>We have sent a verification email on the registered email id. Please check you email.</i></span>`,
                                type: "success",
                            }, function() {
                                window.location = base_url('/seller');
                            });
                        } else {
                            swal({
                                html: true,
                                title: 'Successful!',
                                text: `<h4>You can now login.</h4>`,
                                type: "success",
                            }, function() {
                                window.location = base_url('');
                            });
                        }
                    } else {
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function(key) {
                                $("#change-pass-err").append(`
                            <li>${res.errors[key]}</li>
                            `);
                            });
                        } else {
                            $("#change-pass-err").html(`<li>${res.msg}</li>`);
                        }
                        $("#change-pass-err").show();
                    }
                },
                complete: function() {
                    $("#btn-change-pass").attr("disabled", false).html(btn_reset_pass);
                },
            }
            $.ajax(resetPass);
        }
    })

    let btn_change_pass;
    $("#change-password").validate({
        rules: {
            password: {
                required: true,
                minlength: 4,
            },
            cpassword: {
                required: true,
                minlength: 4,
                equalTo: '#password'
            }
        },
        messages: {
            cpassword: {
                equalTo: "Password does not match",
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            let changePass = {
                url: base_url("auth/change_pass"),
                beforeSend: function() {
                    $("#change-pass-err").html(``).hide();
                    $("#btn-change-pass").attr("disabled", true);
                    btn_change_pass = $("#btn-change-pass").html();
                    $("#btn-change-pass").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                method: "post",
                dataType: "json",
                data: $("#change-password").serialize(),
                success: function(res) {
                    if (res.status == 1) {
                        if (res.role == 3) {
                            window.location = base_url('/customer');
                        } else if (res.role == 2) {
                            $(".container").hide();
                            swal({
                                title: 'Successful!',
                                text: `Your password is changed successfully!`,
                                type: "success",
                            }, function() {
                                window.location = base_url('/seller');
                            });
                        }
                    } else {
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function(key) {
                                $("#change-pass-err").append(`
                            <li>${res.errors[key]}</li>
                            `);
                            });
                        } else {
                            $("#change-pass-err").html(`<li>${res.msg}</li>`);
                        }
                        $("#change-pass-err").show();
                    }
                },
                complete: function() {
                    $("#btn-change-pass").attr("disabled", false).html(btn_change_pass);
                },
            }
            $.ajax(changePass);
        }
    })
});