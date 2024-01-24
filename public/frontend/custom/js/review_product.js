$(function () {
  "use strict";

  // pagination
  if (page_count > 1) {
    $("#pagination").twbsPagination({
      totalPages: page_count,
      startPage: 1,
      visiblePages: 5,
      cssStyle: "font-size:100px",
      next: "Next",
      prev: "Prev",
      pageClass:
        "page-item d-flex justify-content-center align-items-center waves-effect waves-circle me-1",
      anchorClass: "page-link p-0 m-0 border-0",
      onPageClick: function (event, page) {
        reviews_product_details(page);
      },
    });
  } else {
    reviews_product_details(1);
  }
});

function reviews_product_details(page) {
  if (pro_id) {
    $.ajax({
      url: base_url("/products/get_all_review_product_details"),
      type: "post",
      data: {
        pid: pro_id,
        page: page,
      },
      dataType: "json",
      success: function (res) {
        if (res.status == 1) {
          details = res.data;
          $("#review_product").html("");
          details.map(function (key) {
            css = "";
            if (key.rating_rate == 1 || key.rating_rate == 2) {
              css = "badge-danger";
            } else {
              css = "badge-success";
            }

            $("#review_product").append(`<hr>
                        <div class="row g-0">
                            <div class="col-md-12 col-12">
                                <div class="box-body">
                                    <div class="list-inline">
                                        <div class="row">
                                            <div class='' style='width:7%;'>
                                                <span class="badge badge-pill ${css}">
                                                ${Number(key.rating_rate).toFixed(1)}
                                                     <i class='mdi mdi-star'></i>
                                                </span>
                                            </div>
                                            <div class='' style='width: 90%;'>
                                                <span style='color: #878787;'>
                                                    <h4>${key.title}</h4>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-10">
                                        <div class="me-10">
                                            <i class="fa fa-user me-5"></i> ${key.full_name}
                                        </div>
                                        <div>
                                            <i class="fa fa-calendar me-5"></i> 
                                            ${key.created_at}
                                        </div>
                                    </div>
                                    <p>${key.description}</p>
                                </div>
                            </div>
                        </div>`);
          });
        }
      },
    });
  }
}
