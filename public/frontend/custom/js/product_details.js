$(function () {
    "use strict";

    $(".icolors li").on("click", function () {
        $(".icolors li").removeClass("active");
        $(this).addClass("active");
    });

    $(".photos-item").on("click", function () {
        var src = $(this).children().attr("src");
        $("#product-image").attr("src", src);
        $(".photos-item").removeClass("item-active");
        $(this).addClass("item-active");
    });

    $(document).on("click", ".wishlist", function () {
        $.ajax({
            url: base_url("/products/wishlist_products"),
            data: {
                product_id: $("#pro_id").val(),
            },
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    $.toast({
                        text: res.msg,
                        position: "top-right",
                        loaderBg: "#ff6849",
                        icon: "success",
                        hideAfter: 3500,
                        stack: 6,
                    });
                } else {
                    window.location = base_url("/customer");
                }
            },
        });
    });
});
