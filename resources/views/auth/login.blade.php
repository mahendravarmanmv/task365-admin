<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Task 365</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="{{ asset('assets/css/signup/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/font-awesome.min.css') }}">
</head>
<body class="bg-teal d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #009688, #00796b);">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="text-center text-white mb-4">
          <h1 class="fw-bold fst-italic">Task 365 - Admin Login</h1>
        </div>

        <div class="card shadow-lg rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4"><i class="fa fa-user me-2"></i>Login</h3>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
              @csrf

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email" autofocus>
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                @error('password')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="text-end mb-3">
                <a href="#" class="text-decoration-none text-primary small" data-bs-toggle="collapse" data-bs-target="#forgotForm">Forgot Password?</a>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn text-white" style="background-color: #009688;">Sign In</button>
              </div>

              <div class="text-center mt-3">
                <small>Don't have an account? <a href="{{ route('signup') }}" class="text-decoration-none text-primary">Sign Up</a></small>
              </div>
            </form>

            <!-- Forgot Password Form -->
            <div class="collapse mt-4" id="forgotForm">
              <hr>
              <h5 class="text-center"><i class="fa fa-lock me-2"></i>Forgot Password</h5>
              <form method="POST" action="#">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-secondary">Reset Password</button>
                </div>
                <div class="text-center mt-3">
                  <a href="#" class="text-decoration-none text-primary small" data-bs-toggle="collapse" data-bs-target="#forgotForm">← Back to Login</a>
                </div>
              </form>
            </div>
            <!-- End Forgot Form -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- jQuery Validate plugin -->
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/validations/login.js') }}?v=0.1"></script>
</body>
</html>
