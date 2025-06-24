$(document).ready(function () {
  $('#registerForm').validate({
    rules: {
      name: {
        required: true,
        minlength: 2
      },
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
      name: {
        required: "Please enter your name",
        minlength: "Name must be at least 2 characters"
      },
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please enter a password",
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