$(function() {
    $("#add_store").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            gst: {
                minlength: 15,
                maxlength: 15
            },
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            },
            pincode: {
                required: true,
            },
            account_no: {
                required: true,
            },
            ifsc_code: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your store name",
                minlength: "Store name have to be greater than 2 characters",
            },
            gst: {
                minlength: "Your gst no should not be less than 15 digits",
                maxlength: "Your gst no should not be greater than 15 digits"
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.form-group'));
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            $.ajax({
                url: base_url("/seller/store/create_store"),
                data: $(form).serialize(),
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
                    } else {
                        if (res.errors) {
                            for (const key in res.errors) {
                                $('#add-store-err').append(`<li>${res.errors[key]}</li>`);
                            }
                            $('#add-store-err').show();
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

                }
            })
        }
    })

    function show_pending_modal() {
        let status = $("status").val()
        if (status != "NULL") {
            swal("Wait 3-4 days for admin approval.", "", "info");
            // $(".confirm").attr('pending')
        }
    }
    show_pending_modal()
    $(document).on("change", "#country", function() {
        let id = $('#country').val();
        let state = {
            url: base_url('/seller/store/getStates'),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: 'post',
            dataType: 'json',
            success: function(res) {
                if (res.status == 1) {
                    let option = '';
                    res.data.map(function(key) {
                        option +=
                            `<option value='${key.state_id}'>${key.state_name}</option>`
                    });
                    $('#states').html(`<option value='' >Select your state</option>
                    ${option}
               </select>`);
                }
            }
        }
        $.ajax(state);
    })

    $(document).on("change", "#states", function() {
        let id = $('#states').val();
        let state = {
            url: base_url('/seller/store/getCities'),
            data: {
                'id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: 'post',
            dataType: 'json',
            success: function(res) {
                if (res.status == 1) {
                    let option = '';
                    res.data.map(function(key) {
                        option +=
                            `<option value='${key.city_id}'>${key.city_name}</option>`
                    });
                    $('#city').html(`<option value=''>Select your city</option>
                    ${option}
               </select>`);
                }
            }
        }
        $.ajax(state);
    })

    function sendVerificationEmail() {
        $.ajax({
            url: base_url("/auth/triggerVeificationEmail"),
            data: {
                utk: $('input[name=user_id]').val(),
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    create_toast(res.msg, 'success');
                    $('#error-msg').addClass('d-none');
                    $('#success-msg').html(
                        'We have sent a verification email to your registered email account. Please go and check.<br> (Note: Please refresh this page once you have verified your email)'
                    ).show();
                } else {
                    $.toast({
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'eror',
                        hideAfter: 3500,
                        stack: 6
                    });
                }
            }
        });
    }

    let toast;
    $('#frm-change-email').validate({
        onkeyup: false,
        rules: {
            'user_id': {
                required: true,
            },
            'email': {
                required: true,
                email: true,
            }
        },
        errorPlacement: function(error, element) {
            if (toast) toast.reset();
            create_toast($(error).html(), 'error');
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            $.ajax({
                type: "post",
                url: base_url('/auth/changeEmail'),
                data: $(form).serialize(),
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        create_toast(res.msg, 'success');
                        $('#error-msg').addClass('d-none');
                        $('#success-msg').html(
                            'We have sent a verification email to your registerd email account. Please go and check.<br> (Note: Please refresh this page once you have verified your email)'
                        ).show();
                    } else {
                        if (res.errors) {
                            msg = '';
                            for (i in res.errors) {
                                msg += res.errors[i] + '<br>';
                            }
                            create_toast(msg, 'error');
                        } else {
                            create_toast(res.msg, 'error');
                        }
                    }
                }
            });
        }
    });



    function create_toast(msg, type) {
        $.toast({
            text: msg,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: type,
            hideAfter: 3500,
            stack: 6
        });
    }
})