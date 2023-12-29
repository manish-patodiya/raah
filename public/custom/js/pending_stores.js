function base_url(uri) {
    return BASE_URL + uri;
}
$(function() {
    "use strict";

    $("#tbl-pending-store").DataTable()
    $(document).on("click", ".sup_view", function() {
        $(".store_details").html("")
        let id = $(this).attr('store_id')
        $.ajax({
            url: base_url("/admin/pendingstores/get_store_detail_by_store_id/" + id),
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    let list = '';
                    for (const key in res.detail) {
                        if (key != "id" && key != "Name") {
                            list += `<li class="nav-item"><a href="#" class="nav-link">` + key + `<span
    class="pull-right badge bg-info-light">` + res.detail[key] + `</span></a></li>`
                        } else if (key == "Name") {
                            $("#store_name").html(res.detail[key])
                        } else if (key == "status") {
                            if (res.detail[key] == 1) {
                                $("#btn-create").html("Ok")
                            }
                        }
                    }
                    $(".store_details").append(list)
                    console.log(list)
                    $("#btn-create").attr("store_id", id)
                    $("#store_details").modal("show")
                }
            }
        })
    })
    $(document).on("click", "#btn-create", function() {
        let id = $(this).attr('store_id')
        $.ajax({
            url: base_url("/admin/pendingstores/change_store_status/" + id),
            dataType: "json",
            success: function(res) {
                if (res.status == 1) {
                    $("#store_details").modal("hide")
                    $.toast({
                        text: res.msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    window.location.reload()
                }
            }
        })
    })
})