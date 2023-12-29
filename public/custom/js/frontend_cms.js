$(function() {
    $(".frontend-frm").submit(function(e) {
        e.preventDefault();
        $('textarea.ckeditor').each(function() {
            var $textarea = $(this);
            $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
        });
        _this = $(this);
        let form_data = new FormData(_this[0]);
        form_data.append('content', _this.find('.ckeditor').val() || '');
        // console.log(form_data);
        $.ajax({
            url: base_url("/admin/FrontendCMS/edit"),
            method: "post",
            dataType: "json",
            contentType: false,
            processData: false,
            data: form_data,
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
                    window.scroll(0, 0)
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
        })
    })

    // $("#about-frontend-cms").submit(function(e) {
    //     e.preventDefault();
    //     let id = $("#about-submit-btn").attr('fcms')
    //     console.log(id)
    //     $.ajax({
    //         url: base_url("/admin/FrontendCMS/edit/" + id),
    //         method: "post",
    //         dataType: "json",
    //         data: $("#about-frontend-cms").serialize(),
    //         success: function(res) {
    //             if (res.status == 1) {
    //                 $.toast({
    //                     // heading: 'Welcome to my Deposito Admin',
    //                     text: res.msg,
    //                     position: 'top-right',
    //                     loaderBg: '#ff6849',
    //                     icon: 'success',
    //                     hideAfter: 3500,
    //                     stack: 6
    //                 });
    //                 window.location = base_url("/admin/FrontendCMS");
    //             }
    //         }
    //     })
    // })

    // $("#contact-frontend-cms").submit(function(e) {
    //     e.preventDefault();
    //     let id = $("#contact-submit-btn").attr('fcms')
    //     $.ajax({
    //         url: base_url("/admin/FrontendCMS/edit/" + id),
    //         method: "post",
    //         dataType: "json",
    //         data: $("#contact-frontend-cms").serialize(),
    //         success: function(res) {
    //             if (res.status == 1) {
    //                 $.toast({
    //                     // heading: 'Welcome to my Deposito Admin',
    //                     text: res.msg,
    //                     position: 'top-right',
    //                     loaderBg: '#ff6849',
    //                     icon: 'success',
    //                     hideAfter: 3500,
    //                     stack: 6
    //                 });
    //                 window.location = base_url("/admin/FrontendCMS");
    //             }
    //         }
    //     })
    // })
})