<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Transfert Union">
    @include('public.css')

    <title>Connectez-vous | Transfert Union</title>
    @include('_whatsapp_widget')
  </head>
  <body class="login-page">

    <div class="signup-login">
      <div class="sl-slider-caro owl-carousel">
        <div class="single-sl-slide">
          <img src="{{asset('template/images/login.png')}}" alt="">
          <div class="content-box">
            <h2>Connectez-vous à votre profil Transfert Union</h2>
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
          <h2>Connectez-vous</h2>
         </div>
        <div>
         @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif
          @if (session('status'))
            <div class="mb-4 font-medium alert alert-success" role="alert">
              {{ session('status') }}
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
        <form method="POST" action="{{ route('login') }}" class="sl-form">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="type_actor" value="user" >
          <div class="form-group">
            <label>Identifiant</label>
            <input type="email" value="{{old('email')}}" name="email" placeholder="example@gmail.com" required>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Mot de passe</label>
            <input name="password" type="password" placeholder="Password"
            required>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-check">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input">
            <label class="form-check-label">Se souvenir de moi</label>
          </div>
          <button type="submit" class="btn btn-filled btn-round">
            <span class="bh"></span> <span>Connexion</span>
          </button>
          <p class="notice text-center"> <a href="{{ route('password.request') }}">Mot de passe oublié ?</a> </p>
          <p class="notice">Pas encore membre?
            <a href="{{route('register.personnel')}}">Créer un compte</a>
          </p>
        </form>

      </div>
    </div>
    <div style="display: none;">@include ("_lang")</div>
    <!-- JS -->
    @include('public.js')
  </body>
</html>
