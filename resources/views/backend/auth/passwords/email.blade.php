
<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Password Reset | Kalife</title>
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
        <div class="alert alert-info" role="alert">
          <i class="fa fa-info-circle"></i>
          <strong>Heads up!</strong> You will be sent an email containing a link
        </div>

        {!! Form::open(['route' => 'backend-password-reset-post']) !!}

        <div class="form-group">
          {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email Address']) !!}
        </div>

        <button type="button" class="btn btn-block btn-alt-primary" id="send_link">Send Password Reset Link</button>


        {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>

@include('partials.backend.javascript')
<script type="text/javascript" src="{{asset('backend/js/passwords.js')}}">

</script>
</body>
</html>