
<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Login | Kalife</title>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="x-ua-compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta content="yes" name="apple-mobile-web-app-capable">
  <meta content="yes" name="apple-touch-fullscreen">

  @include('partials.backend.css')

</head>

<body>
  <div id="page-container2">
  <div class="page-helper">
    <div class="form-container">
      <div class="logo mb-3">
        <img src="{{url('backend/images/logo/logo.jpg')}}" style="height: 100px;" alt="">
      </div>

      <div class="login-box">

        <p class="mb-4">Welcome, Don't have an account? <a href="#">Register</a></p>

        {!! Form::open(['route' => 'backend-post-login']) !!}

          <div class="form-group">
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email Address']) !!}
          </div>
          <div class="form-group">
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
          </div>
          <button type="button" class="btn btn-block btn-alt-primary" name="sign_in" id="sign_in">Sign in</button>
          <br>
          <div class="row">
            <div class="col-md-12">
              <a class="pull-right" href="#">Forgot Password?</a>
            </div>
          </div>

        {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>

  @include('partials.backend.javascript')
<script type="text/javascript" src="{{asset('backend/js/login.js')}}">

</script>
</body>
</html>