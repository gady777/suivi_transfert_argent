<div class="widget admin-widget p-0">
    <div class="Profile-menu">
        <span class="text-center px-3" > <h5>Compte Business</h5> </span>
        <ul class="nav secondary-nav">
            <li class="{{ request()->routeIs('u.dashboard')  ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.dashboard')}}"><i class="fas fa-tachometer-alt"></i>Tableau de bord</a>
            </li>
            <li class=" {{ request()->routeIs('u.profil') ? 'nav-item active ' : 'nav-item'}} ">
                <a class="nav-link" href="{{route('u.profil')}}"><i class="fab fa-autoprefixer"></i>Mon entreprise</a>
            </li>
            <li class="{{ request()->routeIs('u.bank') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.bank')}}"><i class="fas fa-building"></i>Mes cartes bancaires</a>
            </li>
            
            <li class="{{ request()->routeIs('u.depot') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.depot')}}"><i class="fas fa-plus"></i>Faire un dépot</a>
            </li>
            <li class="{{ request()->routeIs('u.make.paiment') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.make.paiment')}}"><i class="fas fa-plus"></i>Faire un paiement</a>
            </li>
            <li class="{{ request()->routeIs('u.send') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.send')}}"><i class="far fa-paper-plane"></i>Envoyer de l'argent</a>
            </li>
            <li class="{{ request()->routeIs('u.request.starter') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.request.starter')}}"><i class="fas fa-wallet"></i>Demander d'argent</a>
            </li>
            {{--<li  class="{{ request()->routeIs('u.transaction') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.transaction')}}"><i class="fas fa-list-ul"></i>Mes transactions</a>
            </li>--}}
            <li class="{{ request()->routeIs('u.setting') ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.setting')}}"><i class="fas fa-cog"></i>Parametres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-cog"></i>Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            </li>
        </ul>
    </div>
</div>

<!--div class="widget admin-widget">
    <i class="fas fa-coins admin-overlay-icon"></i>
    <h2>Earn $25</h2>
    <p>Have questions or concerns regrading</p>
    <a href="#" class="btn btn-default btn-center"><span>Refer A friend</span></a>
</div>

<div class="widget admin-widget">
    <i class="fas fa-comments admin-overlay-icon"></i>
    <h2>Need Help?</h2>
    <p>Have questions or concerns regrading your account?<br>
        Our experts are here to help!.</p>
    <a href="#" class="btn btn-default btn-center"><span>Start Chat</span></a>
</div-->
