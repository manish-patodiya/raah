function base_url(uri) {
    return BASE_URL + uri;
}

function change_status(btn_name) {
    let data;
    btn_name = btn_name.split('-')
    console.log(btn_name)
    if (btn_name[0] == "#cancel") {
        data = 2;
        $("#order_id").val(btn_name[2])
        $("#product_id").val(btn_name[3])
        $("#add_order_setting_mdl").modal("show")
    } else {
        data = 1;
        pid = btn_name[3]
        $.ajax({
            url: base_url("/seller/orders/myorders/change_order_status/" + btn_name[2]),
            dataType: "json",
            data: {
                'data': data,
                'pid': pid
            },
            success: function (res) {
                if (res.status == 1) {
                    $.toast({
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    window.location = base_url("/seller/orders/myorders")
                }
            }
        })
    }
}

$(function () {
    "use strict";

    let btn_create;
    $("#frm-add-order-setting").validate({
        rules: {
            cancel_reason: {
                required: true
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parents('.controls'));
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            $.ajax({
                beforeSend: function () {
                    $("#add-order-setting").attr("disabled", true);
                    btn_create = $("#add-order-setting").html();
                    $("#add-order-setting").html(`<span class="fa-lg"><i class="fas fa-circle-notch fa-spin"></i></span>`);
                },
                url: base_url("/seller/orders/ordersettings/add"),
                data: $("#frm-add-order-setting").serialize(),
                method: "post",
                dataType: "json",
                success: function (res) {
                    if (res.status == 1) {
                        $.toast({
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                    }
                },
                complete: function () {
                    $("#add-order-setting").attr("disabled", false).html(btn_create);
                    $("#add_order_setting_mdl").modal('hide')
                    window.location.reload()
                },
            })
        }
    })

    $("#print2").click(function () {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $(".printableArea").printArea(options);
    });

})

const query_string = getUrlVars();
$(function () {
    $('.btn-download-inv').click(function () {
        pid = $(this).attr('pid');
        oid = $(this).attr('oid');
        window.open(base_url(`/seller/orders/myorders/order_invoice/${oid}?pid=${pid}`), "Print PDF")
    });

    let start = query_string.from ? moment(query_string.from) : moment().subtract(29, 'days');
    let end = query_string.to ? moment(query_string.to) : moment();

    let cb = (start, end) => {
        if (!query_string.search) {
            $('#daterange-fltr span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                'MMMM D, YYYY'));
        } else {
            $('#daterange-fltr span').html("Select Date");
        }
    }

    $('#daterange-fltr').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
        },
        startDate: start,
        endDate: end
    },
        cb
    );

    cb(start, end);

    $('#daterange-fltr').on('apply.daterangepicker', function (ev, picker) {
        fltr_data();
    });

    $('#status-fltr').on('change', function () {
        fltr_data();
    })

    $('#btn-search').click(function () {
        let search = $('#prod-odr-id-fltr').val();
        if (search && (search.charAt(0) != '#')) {
            fltr_data(1);
        }
    })
});

function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function fltr_data(flag = 0) {
    if (flag) {
        search_val = $('#prod-odr-id-fltr').val();
        window.location = base_url(`/seller/orders/myorders?search=${search_val}`);
    } else {
        start_date = $('#daterange-fltr').data('daterangepicker').startDate.format('YYYY-MM-DD');
        end_date = $('#daterange-fltr').data('daterangepicker').endDate.format('YYYY-MM-DD');
        slct_status = $('#status-fltr').val();
        if (slct_status) {
            window.location = base_url(`/seller/orders/myorders?from=${start_date}&to=${end_date}&status=${slct_status}`)
        } else {
            window.location = base_url(`/seller/orders/myorders?from=${start_date}&to=${end_date}`)
        }
    }
}