function base_url(uri) {
    return BASE_URL + uri;
}
$(function () {
    "use strict";

    $("#user_img").change(function () {
        var file = this.files[0];
        let path =
            console.log(file);
        if (file) {
            $("#logo").attr('src',
                URL.createObjectURL(file)
            );
        }
    })
    $('#cho_img').click(function () {
        $("#user_img").click();
    })

    let btn_update;

    $("#user_profile_updete_detail").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2,
            },
            update_email: {
                required: true,
            },
            update_phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            update_addrress: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            var formData = new FormData(form);
            let register = {
                beforeSend: function () {
                    $("#validation-err").html(``).hide();;
                    $("#btn-update-profile").attr("disabled", true);
                    btn_update = $("#btn-update-profile").html();
                    $("#btn-update-profile").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                url: base_url("/seller/profile/updateUserProfile"),
                data: formData,
                contentType: false,
                processData: false,
                method: "post",
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        if (res.status == 1) {
                            $.toast({
                                // heading: 'Welcome to my Deposito Admin',
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 6
                            });
                            setTimeout(function () {
                                window.location = base_url("/seller/profile");
                            }, 2000);
                        }
                    } else {
                        console.log(res);
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function (key) {
                                $("#validation-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                            });;
                            $("#validation-err").show();
                        }
                    }
                },
                complete: function () {
                    $("#btn-update-profile").attr("disabled", false).html(btn_update);
                },
            };
            $.ajax(register);
        },
    });



    let btn_change_pass;
    $("#user_password").validate({
        rules: {
            old_password: {
                required: true,
                minlength: 4,
            },
            new_password: {
                required: true,
                minlength: 4,
            },
            confirm_password: {
                required: true,
                minlength: 4,
                equalTo: '#new_password'
            }
        },
        messages: {
            cpassword: {
                equalTo: "Password does not match",
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            let changePass = {
                url: base_url("/seller/profile/changePass"),
                beforeSend: function () {
                    $("#change-pass-err").html(``).hide();
                    $("#btn-update-pass").attr("disabled", true);
                    btn_change_pass = $("#btn-update-pass").html();
                    $("#btn-update-pass").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                method: "post",
                dataType: "json",
                data: $("#user_password").serialize(),
                success: function (res) {
                    if (res.status == 1) {
                        $.toast({
                            // heading: 'Welcome to my Deposito Admin',
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 6
                        });
                        setTimeout(function () {
                            // window.location = base_url("/auth");
                            $("#user_password").trigger("reset");
                        }, 2000);
                    } else {
                        if (res.errors) {
                            let keys = Object.keys(res.errors);
                            keys.map(function (key) {
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
                complete: function () {
                    $("#btn-update-pass").attr("disabled", false).html(btn_change_pass);
                },
            }
            $.ajax(changePass);
        }
    })


})