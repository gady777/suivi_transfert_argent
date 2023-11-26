<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Transfert Union | Admin | Se connecter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" description='noindex,nofollow'>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset('assets/images/logo.png')}}" alt="Logo Transfert Union">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Connectez-vous pour commencer</p>

      <form action="{{route('login')}}" method="post">
      @csrf() 
      <input type="hidden" name="type_actor" value="admin" >
        <div class="input-group mb-3">
          <input type="email" 
          class="form-control @error('email') is-invalid @enderror" 
          placeholder="Email"
          value="{{ old('email') }}" name="email"
          >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert"> 
            Veillez verifier vos informations
        </span>
        @enderror
        <div class="input-group mb-3">
          <input type="password"
           class="form-control @error('email') is-invalid @enderror" 
           placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password') 
        <span class="invalid-feedback" role="alert">  
            {{ $message }}</span>
        @enderror
        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        <p class="mb-1 mt-2 text-center">
          <a href="{{route('password.request')}}">Mot de passe oublié ?</a>
        </p>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
