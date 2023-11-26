<header class="header04">
      <div class="container d-flex align-items-center">
          <a class="logo" href="{{ route('home') }}">
            <img src="{{asset('template/images/logo.png')}}" title="Accueil Transfert Union" alt="Logo">
          </a>
          <nav class="primary-menu m-auto">
            <a id="mobile-menu-toggler" href="#"><i class="fas fa-bars"></i></a>                            
            <ul>                
              <li class="current-menu-item">
                  <a href="{{route('home')}}">Accueil</a></li>
              <li><a href="{{route('send.online')}}">Envoyez de l'argent</a></li>
              <li><a href="{{route('how.work')}}">Comment ça marche?</a></li>
              <li><a href="{{route('faq')}}">Aides</a></li>
              <!-- <li></li> -->
              @auth
                <li><a href="{{ route('u.dashboard') }}">
                    <i class="fas fa-user-circle"></i> <span>{{Auth()->user()->pseudo}}</span> </a>
                </li>
                <li><a href="{{route('logout')}}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Déconnexion
                </a></li>
                <form class="d-none" id="logout-form" action="{{ route('logout') }}" 
                method="POST"> <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
              </form>
                @else
                <li><a href="{{route('login')}}">Connexion</a></li>
                <li><a href="{{route('register.personnel')}}" 
                class="login btn btn-outline btn-round"><span class="bh"></span> <span>Inscription</span></a> </li>
                @endauth
                @include ('_lang')
            </ul>
          </nav>
      </div>
    </header>