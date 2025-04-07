<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/register-main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin Registration - Task-365</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Task 365 - Admin Registration</h1>
      </div>
      <div class="login-box">
        <form method="POST" class="login-form" action="{{ route('signup') }}">
         @csrf
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Register</h3>
          <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" autofocus class="form-control" placeholder="Name">
            @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input type="text" name="password" class="form-control" placeholder="Password">
            @error('password')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group btn-container">            
			<button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <div class="form-group text-center">
          <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
        </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>