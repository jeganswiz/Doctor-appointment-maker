<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chosenstore | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{URL::to('/')}}"><b>{{ $settings->sitename }}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      
      @if(Session::has('login_message'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('login_message') }}
        </div>
      @endif
      <form action="{{URL::to('/')}}/authenticate_admin" onsubmit="return login_validation();" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" id="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p class="text-danger" id="email_err"></p>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p class="text-danger" id="password_err"></p>
        <div class="row">
          <div class="col-4">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-4">
            
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
  function login_validation() {
    var email = $('#email').val();
    var password = $('#password').val();
    var pattern = /\S+@\S+\.\S+/;
    var err = 0;
    // alert(pattern.test(email));
    if (email.trim() == '') {
      $('#email_err').html('Email is required!');
      err++;
    }
    else if (!pattern.test(email)) {
      $('#email_err').html('Email is invalid!');
      err++;
    }
    else {
      $('#email_err').html('');
    }

    if (password.trim() == '') {
      $('#password_err').html('Password is required!');
      err++;
    }
    else {
      $('#password_err').html('');
    }
    if (err > 0) { return false; }else { return true; }
  }
</script>
<!-- jQuery -->
<script src="{{URL::to('/')}}/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{URL::to('/')}}/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('/')}}/public/dist/js/adminlte.min.js"></script>
</body>
</html>
