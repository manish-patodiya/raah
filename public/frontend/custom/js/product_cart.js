$(function () {
  getProductCartDetails();
});

const amtformatter = (amt) => {
  return amt.toString().split(".")[0].length > 3 ?
    amt
      .toString()
      .substring(0, amt.toString().split(".")[0].length - 3)
      .replace(/\B(?=(\d{2})+(?!\d))/g, ",") +
    "," +
    amt.toString().substring(amt.toString().split(".")[0].length - 3) :
    amt.toString();
};

function getProductCartDetails() {
  $.ajax({
    type: "get",
    url: base_url("/products/get_cart_details"),
    data: {},
    dataType: "json",
    complete: function () { },
    success: function (res) {
      if (res.status == 1) {
        let pro_cart = res.product_cart_details;
        let sale_price = 0;
        let Total_price = 0;
        let total_discount_amt = 0;
        let pro_cart_details = "";
        if (pro_cart.length) {
          $("#div-cart-items").show();
          $("#div-empty-cart").hide();
          pro_cart.map(function (item) {
            sale_price += Number(item.sale_price_amt);
            Total_price += Number(item.total_amt);
            total_discount_amt += Number(item.total_dis);
            pro_cart_details += make_product_div(item);
          });
          $("#product-cart-details").html(
            pro_cart_details +
            `<div class='d-flex justify-content-end'>
                            <button class="btn btn-danger rounded-0 col-md-3" id="btn-plc-order"><span>Place
                                    Order</span></button>
                        </div>`
          );
        } else {
          $("#div-cart-items").hide();
          $("#div-empty-cart")
            .html(
              `<div class='d-flex align-items-center justify-content-center flex-column'>
                            <img src='${base_url(
                "/public/images/empty-cart.png"
              )}' height='200'/>
                            <div class='mt-3 ms-40 d-flex flex-column align-items-center'>
                            <h4>Your cart is empty!.</h4>
                            <p>Add item to it now.</p>
                            <a href='${base_url(
                "/products"
              )}' class='btn btn-sm btn-success'>Shop Now</a>
                        </div></div>`
            )
            .show();
        }
        $("#sale-price").html("₹" + amtformatter(sale_price));
        $("#Total-price").html("₹" + amtformatter(Total_price));
        $("#discount").html("- " + "₹" + amtformatter(total_discount_amt));
        $("#save-amt").html(
          "You will save " +
          "₹" +
          amtformatter(total_discount_amt) +
          " on this order"
        );
      }
    },
  });
}

function make_product_div(item) {
  return `<div class="row mb-3">
        <div class="col-md-2 sty1 d-flex align-items-center justify-content-center border">
            <a href="${base_url("/products/detail/" + item.slug)}"><img src="${item.product_image
    }"alt="" style='max-height:100%;'></a>
        </div>
        <div class="col-md-5">
            <div class="sty2">
                <a href="#" class='product_name'>${item.title}</a>
            </div>
            <div class="comsty sty3">
            </div>
            <div class="">
                <span class='badge badge-success-light'>Seller: ${item.store_name
    }</span>
            </div>
            ${Number(item.discount)
      ? `<span class="sty5 comsty2 _2xc6hH">${amtformatter(
        item.sale_price_amt
      )}</span>`
      : ""
    }
            <span class="comsty2"
                style='font-size: 18px; font-weight: 500;  color: #212121;'>${amtformatter(
      item.total_amt
    )}</span>
            <span class="dML6Ak" style='font-size: 14px; margin-right: 10px;font-weight: 500;  color: #388e3c;'>${Number(item.discount) ? Number(item.discount) + "% Off" : ""
    } </span>
        </div>
        <div class="col-md-5" style='vertical-align: top;  -webkit-flex: 0 0 300px;  -ms-flex: 0 0 242px;
        flex: -1 0 300px;    margin-left: auto;'>
            <ul style=' margin-bottom: 5px'>
                <li style='margin-bottom: 10px; margin-top:15px'>
                    <div style='    font-size: 14px;    color: #212121;
                    line-height: 1.4'>{delivery expected date}|
                        <span style='margin-right: 5px;'><span
                                style='color: #388e3c;'>{delivery_charge}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class='row mt-2'>
            <div class='col-md-2 ms-3'>
                <div class="plus-minus2">
                    <button class="plus-minus2 plus-minus3 minus-btn btn-secondary text-dark" ${item.quantity == 1 ? "disabled" : ""
    } onclick='minus(this)'>
                    – </button>
                    <div class="plus-minus4 text-center">
                        <span type="text" class="plus-minus5 quantity">${item.quantity
    }</span>
                        <input type='hidden' class='product-cart-details' pro_cart_id='${item.pro_cart_id
    }' product_id='${item.product_id}'  product_name='${item.title
    }'>
                    </div>
                    <button class="plus-minus2 plus-minus3 plus-btn btn-secondary text-dark" onclick='plus(this)'> +
                    </button>
                </div>
            </div>
            <div class='col-md-5 px-2'>
                <div class="remov-seve remove_product_cart text-danger" pro_cart_id='${item.pro_cart_id
    }' product_id='${item.product_id}'>
                    Remove
                </div>
            </div>
        </div>
    </div>`;
}

$(document).on("click", ".remove_product_cart", function () {
  let pro_cart_id = $(this).attr("pro_cart_id");
  let pro_id = $(this).attr("product_id");
  swal(
    {
      title: "Remove Item",
      text: "Are you sure you want to remove this item?",
      // type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Remove",
      closeOnConfirm: true,
      showLoaderOnConfirm: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          url: base_url("/products/remove_product_cart"),
          data: {
            pro_cart_id: pro_cart_id,
            pro_id: pro_id,
          },
          dataType: "json",
          success: function (res) {
            if (res.status == 1) {
              show_toaster("Cart Updated", res.msg);
              $("#hdr-icn-crt-cnt").html(res.data.count);
              getProductCartDetails();
            }
          },
        });
      }
    }
  );
});

function minus(_this) {
  $(".minus-btn,.plus-btn").attr("disabled", true);
  var valueCount = $(_this).parent("div").find(".quantity").html();
  --valueCount;
  // find to  product id and product cart details .....
  pro_cart_id = $(_this)
    .parent("div")
    .find(".product-cart-details")
    .attr("pro_cart_id");
  pid = $(_this).parent("div").find(".product-cart-details").attr("product_id");
  product_name = $(_this)
    .parent("div")
    .find(".product-cart-details")
    .attr("product_name");

  change_Quantity_product(valueCount, pro_cart_id, pid, product_name);
}

function plus(_this) {
  $(".minus-btn,.plus-btn").attr("disabled", true);
  var valueCount = $(_this).parent("div").find(".quantity").html();
  ++valueCount;

  // find to  product id and product cart details .....
  pro_cart_id = $(_this)
    .parent("div")
    .find(".product-cart-details")
    .attr("pro_cart_id");
  pid = $(_this).parent("div").find(".product-cart-details").attr("product_id");
  product_name = $(_this)
    .parent("div")
    .find(".product-cart-details")
    .attr("product_name");

  change_Quantity_product(valueCount, pro_cart_id, pid, product_name);
}

function change_Quantity_product(valueCount, pro_cart_id, pid, product_name) {
  let pcid = pro_cart_id;
  let pro_id = pid;
  let quantity = valueCount;
  let pro_name = product_name;

  $.ajax({
    url: base_url("/products/update_cart"),
    data: {
      pro_cart_id: pcid,
      product_id: pro_id,
      quantity: quantity,
    },
    dataType: "json",
    success: function (res) {
      if (res.status == 1) {
        $.toast({
          html: true,
          heading: "Cart Updated",
          text: `1 item in cart has been updated`,
          position: "top-right",
          icon: "success",
          loader: false,
          showHideTransition: "fade",
        });
        getProductCartDetails();
      }
    },
  });
}

$(function () {
  // make a order
  let btn_place_order;
  $(document).on("click", "#btn-plc-order", function () {
    let _this = $(this);
    $.ajax({
      type: "POST",
      url: base_url("/products/create_order"),
      dataType: "json",
      data: $("#frm-plc-ordr").serialize(),
      beforeSend: function () {
        btn_place_order = _this.html();
        _this
          .html('<i class="fa fa-spinner fa-spin"></i>')
          .attr("disabled", true);
      },
      success: function (res) {
        if (res.status == 1) {
          window.location = base_url(
            `/products/make_payment?order_id=${res.data.order_id}`
          );
        } else {
          show_toaster('Error', res.msg, "error");
        }
      },
      complete: function () {
        _this.html(btn_place_order).attr("disabled", false);
      },
    });
  });
});