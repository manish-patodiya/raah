function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {


    let support_table = () => {
        $("#support_table").DataTable({
            ajax: {
                url: base_url("/seller/support/supporttickets/support_list"),
                dataSrc: 'details',
            },
            "columnDefs": [
                { "width": "12%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                {
                    'targets': [3, 4, 5],
                    'orderable': false,
                },
                { "width": "8%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "12%", "targets": 5, 'class': 'text-end' },
            ]
        })
    }
    support_table()


    $(document).on('click', '.add', function() {
        $('#mdl_add_suppot').modal('show');
    })

    //compalete.............
    $("#support_detail").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let support = {
            url: base_url("/seller/support/supporttickets/add"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#mdl_add_suppot').modal('hide');
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    setTimeout(function() {
                        reload_support_tickets();
                    }, 100)
                    $('#descriptions').val('');
                    $('#subject').val('');

                }
            }
        }
        $.ajax(support);
    })



    $(document).on('click', '.sup_delete', function() {
        let ticket_id = $(this).attr('support_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this ticket.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/seller/support/supporttickets/delete"),
                    method: "post",
                    data: {
                        ticket_id: ticket_id,
                        "csrf_test_name": $('input[name=csrf_test_name]').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 1) {
                            $.toast({
                                // heading: 'Welcome to my Deposito Admin',
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                stack: 6
                            });
                            setTimeout(function() {
                                reload_support_tickets();
                            }, 100)
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });


    $("#edit_support_detail").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let states = {
            url: base_url("/seller/support/supporttickets/edit"),
            data: formData,
            contentType: false,
            processData: false,
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#mdl_edit_suppot').modal('hide');
                    $.toast({
                        // heading: 'Welcome to my Deposito Admin',
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    setTimeout(function() {
                        reload_support_tickets();
                    }, 100)

                }
            }
        }
        $.ajax(states);
    })

    //compalete
    $(document).on('click', '.sup_update', function() {
        let id = $(this).attr('support_id');
        let states = {
            url: base_url("/seller/support/supporttickets/get_support_id"),
            data: {
                'ticket_id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            method: "post",
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $('#supprot_id').val(res.data.ticket_id);
                    $('#e_subject').val(res.data.subject);
                    $('#e_descriptions').val(res.data.description);
                    $('#mdl_edit_suppot').modal('show');
                }
            }
        }
        $.ajax(states);
    })

    //compalete
    $(document).on("click", ".description", function() {
        let id = $(this).attr('support_id')

        let support = {
            url: base_url("/seller/support/supporttickets/get_support"),
            method: "post",
            data: {
                'ticket_id': id,
                "csrf_test_name": $('input[name=csrf_test_name]').val(),
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $(".subject").html(res.data.subject);
                    $("#description").html(res.data.description);
                    $("#date").html(res.data.newdate);
                    $("#branch_name").html(res.data.full_name);
                    $("#branch_email").html(res.data.email);
                    let status = res.data.status_id;
                    if (status == 1) {
                        $("#status").html(`<label class='badge badge-danger'> Pending</lable>`);
                    } else if (status == 2) {
                        $("#status").html(`<label class='badge badge-success'> Complete</lable>`);
                    } else if (status == 3) {
                        $("#status").html(`<label class='badge badge-warning'> On Hold</lable>`);
                    } else if (status == 4) {
                        $("#status").html(`<label class='badge badge-danger bg-orange'> Retecte</lable>`);
                    }
                    $("#support_tickets_view").modal("show")
                }
            }
        }
        $.ajax(support)
    })


    function reload_support_tickets() {
        $("#support_table").DataTable().ajax.reload();
    }
})