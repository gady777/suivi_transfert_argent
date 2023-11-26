<nav class="primary-menu ml-auto">
    <a id="mobile-menu-toggler" href="#"><i class="fas fa-bars"></i></a>
    <ul>
        <li class="has-menu-child pro-menu-drop">
            <a href="#">
                <div class="header-pro-thumb">
                    @if(Auth::user()->photo == null)
                    <img class="rounded-circle" src="{{asset('assets/images/avatar-b.svg')}}" alt="profil">
                    @else
                    <img class="rounded-circle img-fluid" src="{{ asset(Auth::user()->photo) }}" alt="profil">
                    @endif
                </div>
                @if (Auth::user()->firstname == null and Auth::user()->lastname ==null)
                {{Auth::user()->pseudo}}
                @else
                {{Auth::user()->lastname. " ".Auth::user()->firstname}}
                @endif
                <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu-md sub-menu profile-drop">
                <li class="dropdown-header">
                    <div>
                        <h5 class="hidden-xs m-b-0 text-primary text-ellipsis">
                            @if (Auth::user()->firstname == null and Auth::user()->lastname ==null)
                            {{Auth::user()->pseudo}}
                            @else
                            {{Auth::user()->firstname. " ".Auth::user()->lastname}}
                            @endif
                        </h5>
                        <div class="small text-muted">
                            @if (Auth::user()->type_compte == 2 )
                            <span>Compte Personnel</span>
                            @elseif( Auth::user()->type_compte == 3)
                            <span>Compte Business</span>
                            @endif
                        </div>
                    </div>
                </li>
                <li>
                    <hr class="mx-n3 mt-0">
                </li>
                <li class="nav__create-new-profile-link">
                    <a href="{{route('u.profil')}}">
                        <span>Profil</span>
                    </a>
                </li>
                <li class="divider"></li>
                <li class="nav__dropdown-menu-items">
                    <a href="{{route('u.update.profil')}}">
                        <i class="icon icon-setting"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
                <li class="nav__dropdown-menu-items">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon icon-logout"></i><span>Déconnexion</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
