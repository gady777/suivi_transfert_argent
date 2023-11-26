<div class="widget admin-widget p-0">
    <div class="Profile-menu">
        <span class="text-center px-3" > <h5>Compte Personnel</h5> </span>
        <ul class="nav secondary-nav">
            <li class="{{ $page_name == 'dashboard'  ? 'nav-item active' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.dashboard')}}"><i class="fas fa-tachometer-alt"></i>Tableau de bord</a>
            </li>
            <li class=" {{ $page_name == 'profile' ? 'nav-item active ' : 'nav-item'}} ">
                <a class="nav-link" href="{{route('u.profil')}}"><i class="fab fa-autoprefixer"></i>Mon profil</a>
            </li>
            <li class=" {{ $page_name == 'recipient' ? 'nav-item active ' : 'nav-item'}} ">
                <a class="nav-link" href="{{route('u.recipient.home')}}"><i class="fas fa-plane"></i>Bénéficiaires</a>
            </li>
            <li class="{{ $page_name == "transfer" ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.transfer.state1')}}"><i class="far fa-paper-plane"></i>
                Transfert</a>
            </li>
            <li class="{{ $page_name == "transfer_tranche" ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.transfer.tranche.home')}}"><i class="fas fa-random"></i>
                Transfert par tranche</a>
            </li>
            {{--<li class="{{ $page_name == 'transaction' ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.transaction')}}"><i class="fas fa-list-ul"></i>Mes transactions</a>
            </li>--}}
            <li class="{{ $page_name == 'setting' ? 'nav-item active ' : 'nav-item'}}">
                <a class="nav-link" href="{{route('u.setting')}}"><i class="fas fa-cog"></i>Paramètres</a>
            </li>
            {{--<li class="nav-item">
                <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off"></i>Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            </li>--}}
        </ul>
    </div>
</div>
