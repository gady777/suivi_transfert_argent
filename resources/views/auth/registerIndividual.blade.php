<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Transfert Union">
    @include('public.css')

    <title>S'inscrire | Transfert Union</title>
    @include('_whatsapp_widget')
  </head>
  <body class="login-page">

    <div class="signup-login">
      <div class="sl-slider-caro owl-carousel">
        <div class="single-sl-slide">
          <img src="{{asset('template/images/register.png')}}" alt="">
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
          <input type="hidden" name="typeCompte" value="individuel">
          <div class="form-group">
              <input type="text" name="pseudo" value="{{@old('pseudo')}}"
              placeholder="Pseudo">
              @if($errors->has('pseudo'))
                <div class="text-danger">{{$errors->first('pseudo')}}</div>
              @endif
          </div>
          <div class="form-group">
          <input type="date" name="dateAnnif" value="{{@old('dateAnnif')}}">
               @if($errors->has('dateAnnif'))
                  <span style="color:red;">Veuillez entrer une date valide</span>
               @endif
          </div>
          <div class="form-group">
            <input type="email" value="{{ old('email') }}" name="email"
               placeholder="Adresse email" required>
                @if($errors->has('email') )
              <div class="text-danger">
                {{ $errors->first('email') }}
              </div>
             @endif
          </div>
          <div class="form-group">
            <input id="password" placeholder="Mot de passe" type="password"
                name="password" autocomplete="new-password">
                <span class="text-muted">Au moins 8 caractères</span>
                @if($errors->has('password') )
                    <span style="color:red;">
                      {{ $errors->first('password') }}
                    </span>
                @enderror
          </div>

          <div class="form-group">
              <input id="password-confirm"
                type="password" name="password_confirmation"
                autocomplete="new-password" placeholder="Récrire mot de passe">
          </div>

          <button type="submit" class="btn btn-filled btn-round">
            <span class="bh"></span> <span>Inscription</span>
          </button>
          <p class="notice">
            <a href="{{route('login')}}">Connexion</a>
          </p>
        </form>

      </div>
    </div>
    <div style="display: none;">@include ("_lang")</div>
    <!-- JS -->
    @include('public.js')
  </body>
</html>
