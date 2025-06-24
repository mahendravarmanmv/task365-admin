$(document).ready(function () {
  $('#loginForm').validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      }
    },
    messages: {
      email: {
        required: "Please enter your email",
        email: "Enter a valid email address"
      },
      password: {
        required: "Please enter your password",
        minlength: "Password must be at least 6 characters"
      }
    },
    errorElement: 'div',
    errorClass: 'text-danger small mt-1',
    highlight: function (element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
      $(element).removeClass('is-invalid');
    }
  });
});