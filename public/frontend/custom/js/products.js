var products;
$(function () {
  $(document).on("mouseenter", ".wishlist_btn", function () {
    $(this).attr(
      "data-bs-original-title",
      $(this).find("i").hasClass("mdi-heart")
        ? "Remove from wishlist"
        : "Add to wishlist"
    );

    if (!bootstrap.Tooltip.getInstance(this)) {
      tooltip = new bootstrap.Tooltip(this, {
        placement: "top",
      }).show();
    } else {
      bootstrap.Tooltip.getInstance(this).show();
    }
  });

  var render = () => {
    products.getProductData("products").map((prod) => {
      $exist_in_cart =
        $.inArray(prod.id, products.getProductData("cart_products")) != -1;
      $exist_in_wishlist =
        $.inArray(prod.id, products.getProductData("wishlist_products")) != -1;
      $rating = Number(prod.rating);
      $("#products").append(`<div class="col-xl-3 col-md-4 col-12">
            <div class="blog-post border">
                    <a href='${base_url(
        `/products/detail/${prod.slug}`
      )}'><div class="d-flex justify-content-center p-3 align-items-center" style="height: 200px;">
                    <img src="${prod.product_image ||
        base_url("public/images/product/product-1.png")
        }"
                        alt="${prod.title
        }" class="" style="max-height:100%;" onerror="products.onImageError(this);">
                </div></a>
                <div class="blog-detail p-4">
                    <div class="entry-title mb-10">
                        <a class='text-warning' href="${base_url(
          `/products/product_detail/${prod.slug}`
        )}">${prod.title.length < 18 ? prod.title : prod.title.slice(0, 18) + "..."
        }</a>
                    </div>
                    <div class='d-flex justify-content-between align-items-center mb-2'>
                        <div class='d-flex align-items-center'>
                            <h3 class='mb-0 mt-0 me-2'>₹${prod.sale_price}</h3> 
                            ${Number(prod.discount)
          ? `<strike class='me-2'>₹${prod.mrp}</strike><h6 class='m-0 text-success'>${prod.discount}%</h6>`
          : ""
        }
                        </div>
                        <span href="#" title="" class='text-danger wishlist_btn pointer' onclick='add_to_wishlist(${prod.id
        },this)'><i class='mdi ${$exist_in_wishlist ? "mdi-heart" : "mdi-heart-outline"
        } fa-2x'></i></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class='fs-12 badge badge-pill ${$rating ? "badge-success" : "badge-light"
        }'>${$rating
          ? $rating.toFixed(1) + "<i class='mdi mdi-star'></i>"
          : "No Reviews"
        }</span>
    
                        <button class="btn btn-sm btn-warning" onclick="add_to_cart(${prod.id
        },this)"
                            style='display:${$exist_in_cart ? "none" : ""
        }'><i class="mdi mdi-cart"></i> Add to cart</button><a
                            href="${base_url(
          " /cart"
        )}" class="btn btn-sm btn-warning btn-go-to-cart"
                            style='display:${$exist_in_cart ? "" : "none"
        }'><i class="mdi mdi-cart"></i> Go To Cart</a>
                    </div>
                </div>
            </div>
        </div>`);
    });
  };

  products = {
    _data: {
      product_data: {},
      filter_data: {},
    },
    setProductData(data) {
      this._data.product_data = data;
    },
    setFilterData(data) {
      this._data.filter_data = data;
    },
    getProductData(key) {
      return key ? this._data.product_data[key] : this._data.product_data;
    },
    getFilterData(key) {
      return key ? this._data.filter_data[key] : this._data.filter_data;
    },

    // filters selected by the users
    filters: {
      _values: {},
      set(key, value) {
        this._values[key] = value;
        products.update_form();
      },
      setAttr(key, val) {
        if (this._values.attr[key]) {
          this.deleteAttr(key);
        } else {
          this._values.attr[key] = val;
        }
        products.update_form();
      },
      replace(obj) {
        if (!("attr" in obj)) {
          this._values.attr = {};
        } else {
          this._values = obj;
        }
      },
      get(key) {
        return key ? this._values[key] : this._values;
      },
      getAttr(key) {
        return key ? this._values.attr[key] : this._values.attr;
      },
      delete(key) {
        delete this._values[key];
        products.update_form();
      },
      deleteAttr(key) {
        delete this._values.attr[key];
        products.update_form();
      },
    },

    update_form() {
      $("#inpt-filters").val(JSON.stringify(this.filters.get()));
    },

    xhr: null,

    // search product
    search() {
      this.update_url();
      if (this.xhr) {
        this.xhr.abort();
      }
      frm_data = $("#frm-filters").serializeArray();
      frm_data.push({ name: "sort_order", value: $("#slct-sort").val() });
      this.xhr = $.ajax({
        type: "get",
        url: base_url("/products/search"),
        beforeSend: function () {
          window.scrollTo(0, 0);
        },
        data: $.param(frm_data),
        dataType: "json",
        success: function (res) {
          if (res.status == 1) {
            $("#ttl-prod-cnt")
              .html(
                `${Number(res.data.total_product_count || 0) || "No"
                } products found`
              )
              .trigger("change");
            products.setProductData(res.data);
            products.render_products();
          } else {
            show_toaster('Error', res.msg, "error");
          }
        },
        complete: function () { },
      });
    },

    // search filter
    search_filter() {
      frm_data = $("#frm-filters").serializeArray();
      frm_data.push({ name: "request_filters", value: true });
      $.ajax({
        type: "get",
        url: base_url("/products/search_filter"),
        beforeSend: function () {
          window.scrollTo(0, 0);
        },
        data: $.param(frm_data),
        dataType: "json",
        success: function (res) {
          if (res.status == 1) {
            products.setFilterData(res.data);
            products.render_filters();
            products.chips.refresh();
          } else {
            show_toaster("Error", res.msg, "error");
          }
        },
      });
    },

    // run every function for rendering products
    render_products() {
      products.render_product_card();
      products.pagination();
    },

    // render cards of products coming from response
    render_product_card() {
      $("#products").html("");
      render();
    },

    // render filters
    render_filters() {
      let i = 0;
      let attr_div = "";
      let fixed_filters = products.getFilterData("fixed_filters");

      // set price slider range
      if (fixed_filters.price) {
        let slcted_price = products.filters.get("price")
          ? this.filters.get("price")
          : {};
        initialize_price_slider(
          Number(fixed_filters.price.min),
          Number(fixed_filters.price.max),
          slcted_price.min,
          slcted_price.max
        );
      }

      // set discount slider range
      if (fixed_filters.disc) {
        let slcted_dis = products.filters.get("discount")
          ? this.filters.get("discount")
          : {};
        initialize_discount_slider(
          Number(fixed_filters.disc.min),
          Number(fixed_filters.disc.max),
          slcted_dis.min,
          slcted_dis.max
        );
      }

      // set discount slider range
      if (fixed_filters.disc) {
        let slcted_rating = products.filters.get("rating")
          ? this.filters.get("rating")
          : -1;
        min_val = Number(fixed_filters.rating.min || 0);
        max_val = Number(fixed_filters.rating.max || 0);
        attr_div += `<div>
                                <span class="px-0 py-2 media  pointer collapse-btn" data-bs-toggle="collapse"
                                    data-bs-target="#div-rating-fltr" aria-controls='div-rating-fltr'>
                                    <span class="title ms-0">Rating</span>
                                    <i class="fa fa-angle-down"></i>
                                </span>
                                <div class='my-1 collapse ${products.filters.get("rating") ? "show" : ""
          }' id='div-rating-fltr'>`;
        for (let max = max_val; max >= min_val; max--) {
          max = Math.floor(max);
          attr_div += `<span class='badge badge-secondary-light ${slcted_rating == max
            ? "badge-success-light"
            : ""
            } my-2 me-2 pointer btn-fltr-rating' data-value='${max}'><i class='mdi mdi-star'></i> ${max ? `${max.toFixed(1)} and above` : "No Review"
            }</span>`;
        }
        attr_div += `</div></div>`;
      }

      let filters = products.getFilterData("attributes");
      for (attr in filters) {
        // check for expanding filter div
        let has_filter = 0;
        for (value in filters[attr]) {
          if (products.filters.getAttr(value)) {
            has_filter = 1;
            break;
          }
        }
        attr_div += `<div><span class="px-0 py-2 media  pointer collapse-btn" data-bs-toggle="collapse"       
                                data-bs-target="#attr_values${++i}" aria-controls='attr_values${i}'>
                                <span class="title ms-0"> ${attr}</span>
                                <i class="fa ${has_filter ? "fa-angle-up" : "fa-angle-down"
          }"></i>
                            </span>
                            <div class='my-1 collapse ${has_filter ? "show" : ""
          }' id='attr_values${i}'>`;
        for (value in filters[attr]) {
          attr_div += `<span style='text-transform: capitalize;' class='badge ${products.filters.getAttr(value)
            ? "badge-success-light"
            : "badge-secondary-light"
            } btn-attr-filter my-2 me-2 pointer' data-id="${filters[attr][value]
            }">${value.toLowerCase()}</span>`;
        }
        attr_div += "</div></div>";
      }
      $("#attr-filter").html(attr_div);
    },

    // set pagination for product list
    pagination() {
      var $pagination = $("#pagination");
      var totalPages = products.getProductData("page_count");
      var currentPage = Number($("#inpt-page").val()) || 1;
      let pagination_obj = {
        totalPages: totalPages || 1,
        startPage: currentPage,
        visiblePages: 5,
        cssStyle: "font-size:100px",
        next: "Next",
        prev: "Prev",
        pageClass:
          "page-item d-flex justify-content-center align-items-center waves-effect waves-circle me-1",
        anchorClass: "page-link p-0 m-0 border-0",
        onPageClick: function (event, page) {
          $("#inpt-page").val(page);
          if (page != currentPage) {
            products.search();
          }
        },
      };
      $pagination.twbsPagination("destroy");
      $pagination.twbsPagination(pagination_obj);
    },

    // add filters chips on top
    chips: {
      refresh() {
        all_filters = $("#frm-filters").serializeArray();
        let chips = "";
        all_filters.map((ele) => {
          switch (ele.name) {
            case "wishlist":
              if (ele.value) {
                chips += `<div class="chip badge-chip badge badge-pill fs-14 me-2 mb-2 chip-wishlist">
                                <i class="fa fa-heart"></i> Wishlist
                                <a href="#"><i class="fa fa-times-circle"></i></a>
                                </div>`;
              }
              break;
            case "sort_order":
              let sort_obj = {
                1: "Most Popular",
                2: "Price (Low to Hight)",
                3: "Price (High to Low)",
                4: "Newest First",
              };
              if (sort_obj[ele.value]) {
                chips += `<div class="chip badge-chip badge badge-pill fs-14 me-2 mb-2 chip-sort">
                                        <i class="fa fa-filter"></i> Sort: ${sort_obj[ele.value]
                  }
                                        <a href="#"><i class="fa fa-times-circle"></i></a>
                                    </div>`;
              }
              break;
            case "filters":
              let filters = products.filters.getAttr();
              let all_attributes = products.getFilterData("attributes");
              for (const value in filters) {
                for (const label in all_attributes) {
                  if (all_attributes[label][value]) {
                    chips += `<div class="chip badge-chip badge badge-pill fs-14 me-2 mb-2 chip-filter" data-value="${value}" style='text-transform: capitalize;'>
                                                <i class="fa fa-filter"></i> ${label +
                      ": " +
                      value.toLowerCase()
                      }
                                                <a href="#"><i class="fa fa-times-circle fa-lg"></i></a>
                                            </div>`;
                  }
                }
              }
              break;
          }
          $("#filters-chips").html(chips);
        });
      },
    },

    // change url without refreshing the page
    update_url() {
      var newurl =
        window.location.protocol +
        "//" +
        window.location.host +
        window.location.pathname +
        "?" +
        $("#frm-filters").serialize();
      window.history.pushState(
        {
          path: newurl,
        },
        "",
        newurl
      );
    },
    onImageError(ths) {
      ths.src = base_url("/public/images/product/product-1.png");
    },
  };

  $(document).on("change", "#slct-sort", function (e) {
    e.preventDefault();
    // $('#inpt-sort-order').val($(this).val());
    products.search();
  });

  $(document).on("click", ".btn-attr-filter", function () {
    let _this = this;
    $(this).toggleClass("badge-success-light badge-secondary-light");
    $(this).trigger("blur");
    let id = $(this).attr("data-id");
    attributes = products.getFilterData("attributes");
    for (label in attributes) {
      for (value in attributes[label]) {
        if (attributes[label][value] == id)
          products.filters.setAttr(value, attributes[label][value], _this);
      }
    }
    $("#inpt-page").val(1);
    products.search();
  });

  $(document).on("click", ".btn-fltr-rating", function () {
    let val = $(this).attr("data-value");
    $(".btn-fltr-rating").not(this).removeClass("badge-success-light").addClass("badge-secondary-light");
    $(this).toggleClass("badge-success-light");

    if ($(this).hasClass("badge-success-light")) {
      products.filters.set("rating", val);
    } else {
      products.filters.delete("rating");
    }
    $("#inpt-page").val(1);
    // products.render_filters();
    products.search();
  });

  $(document).on("click", ".chip", function () {
    if ($(this).hasClass("chip-wishlist")) {
      $("input[name=wishlist]").remove();
      products.search_filter();
    } else if ($(this).hasClass("chip-sort")) {
      $("#inpt-sort-order").val("");
    } else if ($(this).hasClass("chip-filter")) {
      let value = $(this).attr("data-value");
      products.filters.deleteAttr(value);
    }
    products.search();
    products.render_filters();
  });

  $(document).on("click", ".collapse-btn", function () {
    $(this).find("i").toggleClass("fa-angle-down fa-angle-up");
  });

  products.filters.replace(JSON.parse($("#inpt-filters").val()));
  products.search();
  products.search_filter();
});

function initialize_price_slider(min, max, from = 0, to = 0) {
  from = from || min;
  to = to || max;
  $instance = $("#price-slider").ionRangeSlider({
    type: "double",
    grid: false,
    skin: "round", //big, round,flat,modern,square,sharp
    min: min,
    max: max,
    from: from,
    to: to,
    prefix: "₹",
    force_edges: true, // force UI in the box
    hide_min_max: true, // show/hide MIN and MAX labels
    // onStart: function (data) {
    //     products.filters.set('price', {
    //         min: data.from,
    //         max: data.to
    //     });
    // },
    onFinish: function (data) {
      products.filters.set("price", {
        min: data.from,
        max: data.to,
      });
      products.search();
    },
  });
}

function initialize_discount_slider(min, max, from = 0, to = 0) {
  from = from || min;
  to = to || max;
  $instance = $("#dis-slider").ionRangeSlider({
    type: "double",
    skin: "round", //big, round,flat,modern,square,sharp
    min: min,
    max: max,
    from: from,
    to: to,
    postfix: "%",
    force_edges: true, // force UI in the box
    hide_min_max: true, // show/hide MIN and MAX labels
    // onStart: function (data) {
    //     products.filters.set('discount', {
    //         min: data.from,
    //         max: data.to
    //     });
    // },
    onFinish: function (data) {
      products.filters.set("discount", {
        min: data.from,
        max: data.to,
      });
      products.search();
    },
  });
}
