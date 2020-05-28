@extends('admin-lte::layouts.auth')

@section('content')
<!--
<div class="containe" id="sactive" :class="{'sign-up-active' : signUp }">
<div class="overlay-container hide-mobile show-desktop ">
  <div class="overlay">
  <div class="overlay-left">
    <h2>Welcome Back!</h2>
    <p>Please login with your credentials</p>
    <button class="invert" id="signIn" onclick="signUp = !signUp">Sign In</button>
  </div>
  <div class="overlay-right">
    <h2>Hello Friend!</h2>
    <p>Please login with your credentials</p>
    <button class="invert" id="signUp" onclick="signUp = !signUp">Sign Up</button>
  </div>
    
  </div>
</div>

  <form class="sign-up" action="#">
  <h2>Sign Up</h2>
  <div>User your email for registration</div>
  <input type="text" placeholder="Name">
  <input type="email" placeholder="email">
  <input type="password" placeholder="Password">
  
  <button>Sign Up</button>
    
  </form>
 
  <form class="sign-in" action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
   
  <p class="login-box-msg">Sign in to start your session</p>

    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('email'))
      <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @if ($errors->has('password'))
      <span class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1"> Remember Me
          </label>
        </div>
      </div>
     
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
    
    </div>
    <div class="social-auth-links text-center">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
    Facebook</a>
    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
    Google+</a>
  </div>
 

  <a href="{{ route('password.request') }}">I forgot my password</a><br>
  <a href="{{ route('register') }}" class="text-center">Register a new membership</a>



  </form>

  </div>
  -->
<script type="text/javascript">
  var sup = document.getElementById('signUp');
  sup = false;
  var sa = document.getElementById('sactive');
  sa = sup;
  function oned () {
    sup = !sup;
  }
</script>
<style type="text/css">

  
</style>


<div class="login-box-body">
  <p class="login-box-msg">Sign in to start your session</p>

  <form class="sign-in" action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('email'))
      <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @if ($errors->has('password'))
      <span class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1"> Remember Me
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In">
      </div>
      <!-- /.col -->
    </div>
  </form>

  <div class="social-auth-links text-center">
    <p>- OR -</p>
    <a href="{{route('fblogin',['facebook'])}}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
    Facebook</a>
    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
    Google+</a>
    <a href="#" class="btn btn-block btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i> Sign in using
    Twitter</a>
  </div>
  <!-- /.social-auth-links --> 

  <a href="{{ route('password.request') }}">I forgot my password</a><br>
  <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

</div>
@endsection
