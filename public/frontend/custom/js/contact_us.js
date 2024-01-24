$(function () {
  $("#frm-contact-us").validate({
    rules: {
      first_name: {
        required: true,
        minlength: 2,
      },
      last_name: {
        required: true,
        minlength: 2,
      },
      email: {
        required: true,
      },
      phone: {
        required: true,
      },
      subject: {
        required: true,
        minlength: 2,
      },
      message: {
        required: true,
        minlength: 2,
      },
    },
    messages: {
      first_name: {
        minlength: "First name must be greater than 2 characters",
      },
      last_name: {
        minlength: "Last name must be greater than 2 characters",
      },
      subject: {
        minlength: "Subject must be greater than 2 characters",
      },
      message: {
        minlength: "Message must be greater than 2 characters",
      },
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.parents(".controls"));
    },
    submitHandler: function (form, e) {
      e.preventDefault();
      $.ajax({
        url: base_url("/frontend/contact_form_enquiry"),
        data: $("#contact_form").serialize(),
        dataType: "json",
        success: function (res) {
          if (res.status == 1) {
            $.toast({
              text: res.msg,
              position: "bottom-right",
              loaderBg: "#ff6849",
              icon: "success",
              hideAfter: 3500,
              stack: 6,
            });
            window.location.reload();
          }
        },
      });
    },
  });
});
