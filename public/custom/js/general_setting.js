$(function() {
    // favicon 
    $("#cho_favicon").click(function() {
        $("#user_favicon").trigger('click')
    })

    $("#user_favicon").change(function() {
        var file = this.files[0];
        let path =
            console.log(file);
        if (file) {
            $("#favicon").attr('src',
                URL.createObjectURL(file)
            );
        }
    })

    // end of favicon......
    // start of logo img
    $("#cho_img").click(function() {
        $("#user_img").trigger('click')
    })

    $("#user_img").change(function() {
        var file = this.files[0];
        let path =
            console.log(file);
        if (file) {
            $("#logo").attr('src',
                URL.createObjectURL(file)
            );
        }
    })

    // end of logo img.....

    $("#edit_general_settings").validate({
        submitHandler: function(form, event) {
            event.preventDefault();
            var formData = new FormData(form);
            $.ajax({
                url: base_url("/admin/settings/generalsetting/edit_general_setting"),
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
                        window.location = base_url("/admin/settings/generalsetting");
                    }
                }
            })
        },
    });
    $("#edit_email_settings").validate({
        submitHandler: function(form, event) {
            event.preventDefault();
            $.ajax({
                url: base_url("/admin/settings/generalsetting/edit_email_setting"),
                method: "post",
                data: $(form).serialize(),
                dataType: "json",
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
                        window.location = base_url("/admin/settings/generalsetting");
                    }
                }
            })
        }
    })

})