$(function() {
    $(document).on("click", function(e) {
        target_ele = e.target;
        if ($(target_ele).closest("#searched-prod").length) {
            $("#suggestions").removeClass("d-none");
        } else {
            $("#suggestions").addClass("d-none");
        }
    });

    $("#inpt-search-product").on("input", function() {
        let val = this.value;
        if (val.length >= 3) {
            $.ajax({
                type: "get",
                url: base_url("/products/autosuggest"),
                beforeSend: function() {
                    $("#suggestions ul").html('<span class="p-2">Loading...</span>');
                },
                data: {
                    text: val,
                },
                dataType: "json",
                success: function(res) {
                    let list = "";
                    if (res.keywords.length) {
                        res.keywords.map((item) => {
                            search = item.keyword.split(" ").join("+");
                            url = base_url(`/products?search=${search}`);
                            list += `<a href='${url}' class='m-0'>
                                        <li class="media p-0">
                                            <div class='d-flex align-items-center m-0'>
                                                <i class="ti ti-search"></i>
                                                <span class='ps-2'>${item.keyword}</span>
                                            </div>
                                        </li>
                                    </a>`;
                        });
                        $("#suggestions ul").html(list);
                    } else {
                        $("#suggestions ul").html(
                            '<span class="p-2 text-faded">No result found</span>'
                        );
                    }
                },
            });
        } else {
            $("#suggestions ul").html(
                '<span class="p-2 text-faded">Enter 3 or More Charcters</span>'
            );
        }
    });

    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() {
        Pace.restart()
    })
});

function add_to_cart(prod_id, _this) {
    $.ajax({
        type: "get",
        url: base_url("/products/add_to_cart"),
        data: {
            prod_id: prod_id,
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                show_toaster('Cart Updated', res.msg, "success");
                $(_this).hide();
                $(_this).parent("div").find(".btn-go-to-cart").show();
                $("#hdr-icn-crt-cnt").html(res.data.count);
            } else if (res.status == 2) {
                show_toaster('Cart Updated', res.msg, "error");
            } else {
                window.location = base_url(
                    "/products/update_cart_with_login?prod_id=" + prod_id
                );
            }
        },
        error: function(err) {
            console.log(err);
        },
    });
}

function add_to_wishlist(prod_id, _this) {
    $.ajax({
        url: base_url("/products/update_wishlist"),
        data: {
            prod_id: prod_id,
        },
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                $(_this)
                    .find(".mdi")
                    .addClass("mdi-heart")
                    .removeClass("mdi-heart-outline");
                show_toaster('Wishlist Updated', res.msg, "success");
            } else if (res.status == 2) {
                $(_this)
                    .find(".mdi")
                    .removeClass("mdi-heart")
                    .addClass("mdi-heart-outline");
                show_toaster('Wishlist Updated', res.msg, "error");
            } else {
                window.location = base_url(
                    "/products/update_wishlist_with_login?prod_id=" + prod_id
                );
            }
        },
    });
}

function show_toaster(heading, msg, icon = "success", position = "top-right") {
    $.toast({
        html: true,
        heading: heading,
        text: msg,
        position: position,
        icon: icon,
        loader: false,
        showHideTransition: "fade",
    });

}

function redirect() {
    window.location = base_url("/customer")
}