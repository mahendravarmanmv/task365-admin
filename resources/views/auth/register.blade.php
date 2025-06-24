<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Registration - Task 365</title>

  <!-- Bootstrap 5 CSS CDN -->
  <link href="{{ asset('assets/css/signup/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/font-awesome.min.css') }}">
</head>
<body class="bg-teal d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #009688, #00796b);">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="text-center text-white mb-4">
          <h1 class="fw-bold fst-italic">Task 365 - Admin Registration</h1>
        </div>
        <div class="card shadow-lg rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4"><i class="fa fa-user me-2"></i>Register</h3>
            <form method="POST" action="{{ route('signup') }}" id="registerForm">
              @csrf

              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter your name" autofocus>
                @error('name')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email">
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Choose a password">
                @error('password')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-teal text-white" style="background-color: #009688;">Register</button>
              </div>

              <div class="text-center mt-3">
                <small>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Sign In</a></small>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- jQuery Validate plugin -->
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/validations/registration.js') }}"></script>

</body>
</html>
