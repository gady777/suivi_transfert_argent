<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Transfert Union">
    @include('public.css')

    <title>Mot de passe oublié | Transfert Union</title>
  </head>
  <body class="login-page">

    <div class="signup-login">
      <div class="sl-slider-caro owl-carousel">
        <div class="single-sl-slide">
          <img src="{{asset('template/images/login.png')}}" alt="">
          <div class="content-box">
            <h2>Réinitialisez votre mot de passe</h2>
           </div>
        </div>
      
      </div>
      <div class="sl-form-wrap">
        <header>
          <a href="{{route('home')}}" class="logo">
            <img src="{{asset('template/images/logo-2.png')}}" alt="">
          </a>
        </header>
        <div class="content-box">
          <h2>Définir un nouveau mot de passe</h2>
         
        <div>
         @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif
          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif
          @if (count($errors) > 0)
            <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
          @endif

        </div>
        <form method="POST" action="{{ route('password.update') }}" 
        class="sl-form">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="token" value="{{ $request->route('token') }}">
          <div class="form-group">
            <input type="email" readonly value="{{ $request->email }}" name="email" required>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <input id="password" placeholder="Mot de passe" type="password"
                name="password" autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div class="form-group">
              <input id="password-confirm" 
                type="password" name="password_confirmation" 
                autocomplete="new-password" placeholder="Récrire mot de passe">
          </div>

          <button type="submit" class="btn btn-filled btn-round">
            <span class="bh"></span> <span>Modifier mot de passe</span>
          </button>
          <p class="notice">
            <a href="{{route('login')}}">Se connecter</a>
          </p>
        </form>
        
      </div>
    </div>
    <div style="display: none;">@include ("_lang")</div>
    <!-- JS -->
    @include('public.js')
  </body>
</html>
