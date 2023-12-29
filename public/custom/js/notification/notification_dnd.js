function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    $("#frm-unsubscription").validate({
        rules: {
            email: {
                required: true,
            },
            reason: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Email is required"
            },
            reason: {
                required: "Reason is required"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function(event) {
            // event.preventDefault()
            $.ajax({
                url: base_url("/notifications/unsubscribe_user"),
                beforeSend: function() {
                    // $("#login-err").html(``).hide();
                    $("#btn-unsubscription").attr("disabled", true);
                    btn_unsubscribe = $("#btn-unsubscription").html();
                    $("#btn-unsubscription").html(`<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                method: 'post',
                dataType: "json",
                data: $("#frm-unsubscription").serialize(),
                success: function(res) {
                    if (res.status == "1") {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                        window.location.reload()
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
                        }
                    }
                },
                complete: function() {
                    $("#btn-unsubscription").attr("disabled", false).html(btn_unsubscribe);
                },
            })
        }
    })
    $(document).on("change", "#reasons", function() {
        $("#other-reason").css({ "opacity": "0" })
        value = $("#reasons").val()
        if (value == "other") {
            console.log(value);
            $("#other-reason").css({ "opacity": '' })
            $("#rsn-txtarea").text("")

        } else {
            value = $("select#reasons option:selected").text();
            console.log(value);
            $("#rsn-txtarea").text(value)
        }
    })
    $("#notification_dnd_table").DataTable({
        ajax: {
            url: base_url("/admin/notifications/notificationDND/datatable_json"),
            dataSrc: 'details',
        },
        "columnDefs": [
            { "width": "10%", "targets": 0 },
            {
                'targets': [2],
                'orderable': false,
                'class': 'text-end'
            }
        ],
        'order': []
    })
})