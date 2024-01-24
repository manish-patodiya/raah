$(function () {
  "use strict";

  $.fn.raty.defaults.path = base_url("/public/images/rating/");

  // Cancel Star
  $("#star").raty({
    space: false,
    score: 1,
  });

  $("#camera").click(function () {
    $("#img").click();
  });

  $("#img").change(function () {
    let file = this.files[0];

    var form_data = new FormData();
    form_data.append("image", file);

    $.ajax({
      url: base_url("/products/upload_rating_img"),
      data: form_data,
      method: "post",
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (res) {
        if (res.status == 1) {
          var img = res.rating_img;
          $("#img-preview").append(`<div class="wrapper-thumb">
                    <span class='remove-btn'>x</span>
                    <input type="hidden" name='rating_img[]' value='${img}'>
                    <img src="${base_url(
            `/public/uploads/product_images/${img}`
          )}" alt="" class='img-preview-thumb'>
                </div>`);

          $(".remove-btn").click(function () {
            $(this).parent(".wrapper-thumb").remove();
          });
        }
      },
    });
  });
}); // End of use strict

var btn_save;

$(function () {
  $("#review-img-product").validate({
    rules: {
      description: {
        required: true,
      },
    },
    messages: {
      description: {
        required: "Please write your review about product",
      },
    },
    errorPlacement: function (error, element) {
      $(error).addClass("text-danger");
      error.appendTo(element.parent(".form-group"));
    },
    submitHandler: function (form, event) {
      pid = $("#pid").val();
      var formData = new FormData(form);
      let branches = {
        url: base_url("/products/add_rate_and_review"),
        beforeSend: function () {
          $("#btn-save").attr("disabled", true);
          btn_save = $("#btn-save").html();
          $("#btn-save").html(
            `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
          );
        },
        data: formData,
        contentType: false,
        processData: false,
        method: "post",
        dataType: "json",
        success: function (res) {
          if (res.status == 1) {
            window.location = base_url("/products/product_detail/" + $('#slug').val());
          }
        },
        complete: function () {
          $("#btn-save").attr("disabled", false).html(btn_save);
        },
      };
      $.ajax(branches);
    },
  });
});
