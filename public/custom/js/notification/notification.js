function redirect(url) {
    if (url) {
        window.location = url;
    } else {
        window.location.reload();
    }
}

// Notification delete
//remove(Delete Functionaliy) Ajax request notification functionality by admin 
function delete_notification_by_admin(ele, event) {
    event.stopPropagation();
    id = $(ele).attr('noti_id');
    $.ajax({
        type: 'post',
        url: base_url('/admin/notifications/notification/delete'),
        data: {
            id: id,
            csrf_test_name: $('input[name="csrf_test_name"]').val(),
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                window.location.reload();
            } else {
                $.toast({
                    text: res.msg,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                })
            }
        }
    });

}


// Notification delete
//remove Ajax request notification functionality by seller 
function delete_notification_by_seller(ele, event) {
    event.stopPropagation();
    id = $(ele).attr('noti_id');
    $.ajax({
        type: 'post',
        url: base_url('/seller/notifications/notification/delete'),
        data: {
            id: id,
            csrf_test_name: $('input[name="csrf_test_name"]').val(),
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                window.location.reload();
            } else {
                $.toast({
                    text: res.msg,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                })
            }
        }
    });
}


function delete_notification_by_customer(ele, event) {
    event.stopPropagation();
    id = $(ele).attr('noti_id');
    $.ajax({
        type: 'post',
        url: base_url('/customer/notifications/delete'),
        data: {
            id: id,
            csrf_test_name: $('input[name="csrf_test_name"]').val(),
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                window.location.reload();
            } else {
                $.toast({
                    text: res.msg,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                })
            }
        }
    });
}