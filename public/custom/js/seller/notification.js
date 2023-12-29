$(function () {
    setInterval(() => {
        $.ajax({
            url: base_url("/seller/notifications/notification/fetchNotifications"),
            success: function (res) {

            }
        })
    }, 600000)
})