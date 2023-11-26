<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Transfert Union">
    @include('public.css')

    <title>Devenir Agent | Transfert Union</title>
  </head>
  <body class="login-page">

    <div class="signup-login">
      <div class="sl-slider-caro owl-carousel">
        <div class="single-sl-slide">
          <img src="{{asset('template/images/login.png')}}" alt="">
          <div class="content-box">
            <h2>Envoyez votre argent en ligne en toute sécurité</h2>
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
          <h2>Inscrivez-vous gratuitement</h2>
        </div>
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
        </div>

        <form method="POST" action="{{ route('register')  }}" 
        class="sl-form">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="typeCompte" value="pro">
          <div class="form-group">
              <input type="text" name="nomSociete" value="{{@old('nomSociete')}}" 
              placeholder="nomSociete">
              @if($errors->has('nomSociete'))
                <div class="text-danger">{{$errors->first('nomSociete')}}</div>
              @endif
          </div>
          <div class="form-group">
            <input type="text" placeholder="Vos services" name="service" 
            value="{{@old('service')}}">
                @if($errors->has('service'))
                    <span style="color:red;">{{ $errors->first('service') }}</span>
                @endif
          </div>
          <div class="form-group">
            <input type="email" value="{{ old('email') }}" name="email" 
               placeholder="Adresse email" required>
                @if($errors->has('email') )
              <span  style="color:red;">
                {{ $errors->first('email') }}
              </span>
             @endif
          </div>
          <div class="form-group">
            <input id="password" placeholder="Mot de passe" type="password"
                name="password" autocomplete="new-password">
                @if($errors->has('password') )
                    <span style="color:red;">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @enderror
          </div>

          <div class="form-group">
              <input id="password-confirm" 
                type="password" name="password_confirmation" 
                autocomplete="new-password" placeholder="Réécrire mot de passe">
          </div>

          <button type="submit" class="btn btn-filled btn-round">
            <span class="bh"></span> <span>S'inscrire</span>
          </button>
          <p class="notice">
            <a href="{{ route('register.personnel') }}">Créez un compte personnel</a> | 
            <a href="{{route('login')}}">Se connecter</a>
          </p>
        </form>
        
      </div>
    </div>

    <!-- JS -->
    @include('public.js')
  </body>
</html>
