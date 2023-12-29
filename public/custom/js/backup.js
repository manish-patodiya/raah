$(function() {
    "use strict";
    $("#tbl-bckup").DataTable({
        "bPaginate": false,
        ajax: {
            url: base_url("/admin/backup/get_history"),
        },
        "columnDefs": [{
            'targets': [2],
            'orderable': false,
            'class': 'text-end'
        }],
        'order': []
    });

    $(document).on('click', '.sup_delete', function() {
        let id = $(this).attr('bckp_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url("/admin/backup/delete"),
                    method: "post",
                    data: {
                        bid: id,
                        csrf_test_name: $('input[name=csrf_test_name]').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 1) {
                            reloadTable();
                            $.toast({
                                text: res.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                stack: 6
                            });
                        } else {
                            swal("Deletion Failed!", res.msg, "error");
                        }
                    }
                })
            }
        });
    });
})

function reloadTable() {
    $("#tbl-bckup").DataTable().ajax.reload();
}

function getBackup(ele) {
    let btn_backup = $(ele).html();
    $.ajax({
        type: "get",
        url: base_url('/admin/backup/backup'),
        dataType: "json",
        beforeSend: function() {
            $(ele).html('<i class="fa fa-spinner fa-spin">').attr('disabled', true);
        },
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
                download(res.data.filename, res.data.url);
                reloadTable();
            } else {
                $.toast({
                    // heading: 'Welcome to my Deposito Admin',
                    text: res.msg,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                });
            }
        },
        complete: function() {
            $(ele).html(btn_backup).attr('disabled', false);
        },
        error: function() {

        }
    });
}

function download(filename, url) {
    var link = document.createElement("a");
    link.id = "lnkDwnldLnk";
    link.href = url;
    link.download = filename;
    document.body.appendChild(link);
    $("#lnkDwnldLnk")[0].click();
}