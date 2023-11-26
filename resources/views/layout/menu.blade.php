<nav class="uk-navbar-container" data-uk-sticky="show-on-up: true; animation: uk-animation-slide-top;">
    <div class="uk-container" data-uk-navbar>
        <div class="uk-navbar-left">
            <div class="uk-navbar-item">
                <!-- logo begin -->
                <a class="uk-logo" href="{{route('home')}}">
                    <img src="{{asset('assets/img/in-lazy.gif')}}" data-src="{{asset('assets/img/in-logo2.png')}}" 
                    alt="logo" width="160"
                        height="34" data-uk-img>
                </a>
                <!-- logo end -->
                <!-- navigation begin -->
                <ul class="uk-navbar-nav uk-visible@m">
                    <li><a href="{{route('home')}}">Accueil</a></li>
                    <li><a href="{{route('about')}}">Qui sommes-nous</a></li>
                    <li><a href="#">Envoyez de l'argent<i class="fas fa-chevron-down"></i></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="{{route('send.online')}}">En ligne</a></li>
                                <li><a href="{{route('send.agence')}}">Depuis une
                                        agence</a></li>
                                <li><a href="{{route('send.many')}}">Envoyez un gros 
                                    montant</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="{{route('receive.money')}}">Recevoir de l'argent</a></li>
                    <li><a href="{{route('faq')}}">Aides</a></li>
                </ul>
                <!-- navigation end -->
            </div>
        </div>
        <div class="uk-navbar-right">
            <div class="uk-navbar-item uk-visible@m in-optional-nav">
                @auth
                    <a href="{{route('logout')}}" class="uk-button uk-button-primary uk-border-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                    <a href="{{ route('u.dashboard') }}" class="uk-button uk-button-text"><i class="fas fa-user-circle"></i></a>
                @else
                    <a href="{{route('register.personnel')}}" class="uk-button uk-button-primary uk-border-rounded">Créer un compte</a>
                    <a href="{{route('login')}}" class="uk-button uk-button-text"><i class="fas fa-user-circle"></i></a>
                @endauth

                
            </div>
        </div>
    </div>
</nav>
