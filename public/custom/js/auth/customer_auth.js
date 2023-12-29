function base_url(uri) {
  return BASE_URL + "/" + uri;
}

$(function () {
  $("form").trigger("reset");
  $("input").keyup(function () {
    let i = 0;
    $("#frm-register input").map(function (ele) {
      if (this.value == "") {
        i++;
      }
    });

    $(this).closest(".controls").find(".err").html("");
    if (i == 0 && $("#frm-register").valid()) {
      $("#btn-register")
        .addClass("btn-info")
        .removeClass("btn-secondary")
        .attr("disabled", false);
    } else {
      $("#btn-register")
        .removeClass("btn-info")
        .addClass("btn-secondary")
        .attr("disabled", true);
    }
  });

  $("#inpt-phone").keyup(function () {
    $("#inpt-otp").val("");
    $("#inpt-row-id").val("");
    $("#verification-err").html("");
    $("#btn-send-otp").html("Send OTP");
    disable_otp_inpt(false);
    $(this).val().length == 10 ? enable_otp_btn(true) : enable_otp_btn(false);
  });

  $("#inpt-otp").keyup(function () {
    $("#otp-send-msg").html("");
    if ($("#inpt-phone").val().length == 10) {
      if ($(this).val().length == 6) {
        if (previous_otp != $(this).val() && rid) {
          verify_otp();
        } else {
          $("#verification-err").html(
            "Please enter the correct OTP sent to your mobile number."
          );
        }
      }
    } else {
      $("#verification-err").html("Please enter your phone no. first");
    }
  });
});

function enable_otp_btn(action) {
  if (action) {
    $("#btn-send-otp").addClass("btn-info").attr("disabled", false);
  } else {
    $("#btn-send-otp").removeClass("btn-info").attr("disabled", true);
  }
}

function disable_otp_inpt(action) {
  $("#inpt-otp").attr("disabled", action).attr("readonly", action);
}

let rid = "";

function request_otp(ele) {
  enable_otp_btn(false);
  var _this = $(ele);
  disable_otp_inpt(false);
  $.ajax({
    type: "post",
    url: base_url("/auth/request_otp"),
    beforeSend: function () {
      enable_otp_btn(false);
      $("#inpt-otp").val("");
      $("#verification-err").html("");
    },
    data: {
      phone: $("#inpt-phone").val(),
      rid: rid,
      csrf_test_name: $("input[name=csrf_test_name]").val(),
    },
    dataType: "json",
    success: function (res) {
      if (res.status == 1) {
        $("#otp-send-msg").html(`<small>${res.msg}</small>`);
        rid = res.data.row_no;
        let otp_time = res.data.otp_resend_time;
        start_resent_timer(_this, Number(otp_time) || 59);
      } else {
        enable_otp_btn(true);
        if (res.errors) {
          $("#inpt-phone").addClass("border-danger");
          $("#mobile-err").html(res.errors.phone);
        }
      }
    },
  });
}

function start_resent_timer(_this, otp_time) {
  _this.html(`Resend in ${otp_time}s`);
  let otp_interval = setInterval(() => {
    _this.html(`Resend in ${--otp_time}s`);
    if (otp_time == 0) {
      clearInterval(otp_interval);
      enable_otp_btn(true);
      _this.html("Resend OTP");
    }
  }, 1000);
}

let previous_otp = "";

function verify_otp() {
  $.ajax({
    beforeSend: function () {
      previous_otp = $("#inpt-otp").val();
    },
    url: base_url("auth/verify_otp"),
    data: {
      row_id: rid,
      otp: $("#inpt-otp").val(),
      phone: $("#inpt-phone").val(),
      csrf_test_name: $("input[name=csrf_test_name]").val(),
    },
    method: "post",
    dataType: "json",
    success: function (res) {
      if (res.status == 1) {
        $("#verification-err").html("");
        $("#inpt-row-id").val(rid);
        disable_otp_inpt(true);
      } else {
        $("#inpt-otp").addClass("border-danger");
        $("#verification-err").html(res.msg);
      }
    },
    complete: function () {},
  });
}

var btn_register;

function register_user() {
  $.ajax({
    beforeSend: function () {
      $("#registration-err").html(``).hide();
      $("#btn-register").attr("disabled", true);
      btn_register = $("#btn-register").html();
      $("#btn-register").html(
        `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
      );
    },
    url: base_url("/auth/customerRegistration"),
    data: $("#frm-register").serialize(),
    method: "post",
    dataType: "json",
    success: function (res) {
      if (res.status == 1) {
        swal(
          {
            html: true,
            title: "Success!",
            text: `<h4>Your account has been created successfully.</h4>`,
            type: "success",
          },
          function () {
            window.location = base_url("/customer");
          }
        );
      } else {
        if (res.errors) {
          show_errors_on_registraion_form(res.errors);
        }
      }
    },
    complete: function () {
      $("#btn-register").attr("disabled", false).html(btn_register);
    },
  });
}

function show_errors_on_registraion_form(errors) {
  $("#mobile-err").html(errors.phone || "");
  $("#name-err").html(errors.full_name || "");
  $("#email-err").html(errors.email || "");
  $("#pass-err").html(errors.password || "");
  $("#cpass-err").html(errors.cpassword || "");
}

function show_hide_pass(_this, inptid) {
  let show = $(_this).data("show");
  $(_this).html(
    `<i class="mdi mdi-eye${show ? "" : "-off"}"></i> ${show ? "Show" : "Hide"}`
  );
  $(_this).data("show", show ? 0 : 1);
  $(`#${inptid}`).attr("type", show ? "password" : "text");
}

$(function () {
  $(document).ajaxStart(function () {
    Pace.restart();
  });

  $("#frm-register").validate({
    rules: {
      full_name: {
        required: true,
        minlength: 2,
      },
      otp: {
        required: true,
        minlength: 6,
      },
      email: {
        required: true,
        email: true,
      },
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10,
      },
      password: {
        required: true,
        password_format: true,
      },
      cpassword: {
        required: true,
        equalTo: $("#inpt-password"),
      },
    },
    messages: {
      cpassword: {
        equalTo: "Password does not match.",
      },
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.parents(".controls"));
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      register_user();
    },
  });
});

$(function () {
  var btn_login;
  $("#frm-login").validate({
    rules: {
      phone: {
        required: true,
      },
      password: {
        required: true,
      },
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.parents(".controls"));
    },
    submitHandler: function (form, event) {
      let login = {
        url: base_url("auth/customerlogin"),
        beforeSend: function () {
          $("#login-err").html(`&nbsp;`);
          $("#login-err").css("visibility", "hidden");
          $("#btn-login").attr("disabled", true);
          btn_login = $("#btn-login").html();
          $("#btn-login").html(
            `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
          );
        },
        data: $("#frm-login").serialize(),
        method: "post",
        dataType: "json",
        success: function (res) {
          if (res.status == 1) {
            window.location = redirect_url || base_url("customer/profile");
          } else {
            if (res.errors) {
              let keys = Object.keys(res.errors);
              keys.map(function (key) {
                $("#login-err").append(`${res.errors[key]}`);
              });
              $("#login-err").css("visibility", "visible");
            } else {
              $("#login-err").html(res.message);
              $("#login-err").css("visibility", "visible");
              $("#user-id").val(res.user_id);
            }
          }
          if (res.phone) {
            $("#otp-phone").html("+91 " + res.phone);
          }
        },
        complete: function () {
          $("#btn-login").attr("disabled", false).html(btn_login);
        },
      };
      $.ajax(login);
    },
  });
});
