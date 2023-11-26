<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('admin.home')}}" class="brand-link">
    <img src="{{asset('assets/images/favicon.png')}}" alt="gdc logo"
    class="brand-image img-circle elevation-3"
         style="opacity: .8;height:25px;width:25px;">
    <span class="brand-text font-weight-light">{{config('info.app_name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset( Auth::user()->photo ?? 'assets/images/avatar-b.png' )}}" class="img-circle elevation-2"
         alt="User Image">
      </div>
      <div class="info">
        <a href="{{route('admin.profile.home')}}" class="d-block">{{Auth::user()->pseudo}}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('admin.home')}}" class="nav-link {{$page == 'home' ? 'active' : ''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Accueil
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview {{ ($page == 'user' or $page == 'user_admin') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Utilisateurs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul style="margin-left: 15px;" class="border-left nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.user.home')}}" class="nav-link {{$page == 'user' ? 'active' : ''}}">
                  <i class="nav-icon fas fa-id-card-alt"></i>
                  <p>
                    Clients
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.user.home.admin')}}" class="nav-link {{$page == 'user_admin' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admins</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview {{ ( $page == 'tranche' or $page == 'transfer' or $page == 'transfer_method' or $page == 'receive_pay_method') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Transfert
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul style="margin-left: 15px;" class="border-left nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.transfer.home')}}" class="nav-link {{$page == 'transfer' ? 'active' : ''}}">
                  <i class="nav-icon fas fa-id-card-alt"></i>
                  <p>
                  Transfert d'argent
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.transfer.tranche.home')}}" class="nav-link {{$page == 'tranche' ? 'active' : ''}}">
                  <i class="nav-icon fas fa-random"></i>
                  <p>
                  Transfert par tranche
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.transfer.method.home')}}" class="nav-link {{$page == 'transfer_method' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Méthodes & Frais</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.receive_pay_method.home')}}"
                 class="nav-link {{$page == 'receive_pay_method' ? 'active' : ''}}">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Données récep.</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview {{ ( $page == 'archive' or $page == 'archive_trans' or $page == 'archive_trans_tranche') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Archives
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul style="margin-left: 15px;" class="border-left nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.archive.transfer.home')}}" class="nav-link {{$page == 'archive_trans' ? 'active' : ''}}">
                  <i class="nav-icon fas fa-id-card-alt"></i>
                  <p>
                  Transfert d'argent
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.archive.transfer.tranche.home')}}" class="nav-link {{$page == 'archive_trans_tranche' ? 'active' : ''}}">
                  <i class="nav-icon fas fa-random"></i>
                  <p>
                  Transfert par tranche
                  </p>
                </a>
              </li>
              
            </ul>
          </li>

        {{--<li class="nav-item">
          <a href="{{route('admin.bank.home')}}" class="nav-link {{$page == 'online-bank' ? 'active' : ''}}">
            <i class="nav-icon fas fa-money-check"></i>
            <p>
              Banque en ligne
            </p>
          </a>
        </li>--}}
        <li class="nav-item">
          <a href="{{route('admin.country.home')}}" class="nav-link {{$page == 'country' ? 'active' : ''}}">
            <i class="nav-icon fas fa-flag"></i>
            <p>
              Pays
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.currency.home')}}" class="nav-link {{$page == 'currency' ? 'active' : ''}}">
            <i class="nav-icon fas fa-coins"></i>
            <p>
              Devises
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.news.home')}}" class="nav-link {{$page == 'news' ? 'active' : ''}}">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              Actualités
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{($page == 'cms' or $page == 'faq') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{($page == 'cms' or $page == 'faq') ? 'active' : ''}}">
              <i class="nav-icon fas fa-code"></i>
              <p>
                CMS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul style="margin-left: 15px;" class="border-left nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.cms.home')}}" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                  Tous
                  </p>
                </a>
              </li>
              @php $cucms = \App\Models\Cms::all(); @endphp
              @foreach($cucms as $cmm)
              <li class="nav-item">
                <a href="{{route('admin.cms.show',['id'=>$cmm])}}" 
                class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{$cmm->name}}</p>
                </a>
              </li>
              @endforeach
              <li class="nav-item">
                <a href="{{route('admin.cms.faq.home')}}" 
                class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.cms.create')}}" 
                class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Ajouter</p>
                </a>
              </li>
            </ul>
          </li>

        <li class="nav-item">
          <a href="{{route('admin.profile.home')}}" class="nav-link {{$page == 'profile' ? 'active' : ''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profil Admin
            </p>
          </a>
        </li>
        <hr>

        <li class="nav-item">
          <form class="nav-link" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
          action="{{route('logout')}}" method="post">
            <button type="submit" class="btn btn-outline-danger"> <i class="fas fa-power"></i> Se déconnecter</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
