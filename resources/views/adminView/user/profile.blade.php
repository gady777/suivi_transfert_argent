@extends('adminView.layout.layout')

@section('title')
  {{config ('info.app_name')}} - Liste des utilisateurs
@endsection

@section('body_class','hold-transition sidebar-mini')

@section('layout_content')
<div class="wrapper">
  @include ("adminView.layout.top")
  @include ("adminView.layout.aside_left")
  <div class="content-wrapper">
    @include('flash::message')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tous les utilisateurs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Liste des utilisateurs</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                
                  <img class="profile-user-img img-fluid img-circle"
                       src=" @if($user->photo) {{asset($user->photo)}}  @else {{asset('assets/images/avatar-b.png')}} @endif"
                       alt="Profil">
                </div>

                <h3 class="profile-username text-center">{{$user->pseudo}}</h3>

                <p class="text-muted text-center">{{$user->email}}
                  @if($user->email_verified_at)
                   <span class="text-success font-weight-bolder"> <i class="fas fa-check"></i> </span>
                  @else
                   <span class="text-danger font-weight-bolder"> <i class="fas fa-ban"></i> </span>
                  @endif
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                 <li class="list-group-item">
                    <b>Nom & Prénom(s)</b> <a class="float-right">{{$user->lastname}} {{$user->firstname}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Type compte</b> 
                    <a class="float-right">
                      {{$user->type_compte == 2 ? "Particulier" : "Professionnel"}}
                      {{$user->role == 1 ? ", Compte Admin" : ''}}
                    </a>
                    
                  </li>
                  <li class="list-group-item">
                    <b>Transaction total</b> <a class="float-right">@php echo count($transactions) ; @endphp</a>
                  </li>
                  <li class="list-group-item">
                    <b>Adresse</b> <a class="float-right">{{$user->adresse}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone</b> <a class="float-right">{{$user->telephoneUser}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date annif</b> <a class="float-right">{{$user->dateAnnif}}</a>
                  </li>
                </ul>
                @if( $user->is_active )
                  <a href="{{route('admin.user.block',['id'=>$user->id])}}" onclick="return confirm('{{config('info.confirm_operation')}}');" class="btn btn-danger btn-block"><b>Bloquer</b></a>
                @else
                  @if($user->desactivated_by == "admin")
                    Compte bloqué par un admin le {{$user->desactivated_at}}.
                    <a href="{{route('admin.user.unblock',['id'=>$user->id])}}" onclick="return confirm('{{config('info.confirm_operation')}}');" class="btn btn-warning btn-block"><b>Débloquer ?</b></a>
                  @else
                    Compte bloqué par l'utilisateur lui-même le {{$user->desactivated_at}}.
                  @endif
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <a class="nav-link font-weight-bolder" href="#activity" data-toggle="tab">
                      Toutes les transactions
                    </a>
                  </li>
                  @if ($user->type_compte == 3)
                  <li class="nav-item">
                    <a class="nav-link font-weight-bolder" href="#profil" data-toggle="tab">
                      Profil professionnel
                    </a>
                  </li>
                  @endif
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    @if($user->role == 1)  
                      COMPTE ADMINISTRATEUR
                    @else   
                    {{--<p><strong>Solde</strong>: {{$user->solde}}</p>--}}
                    {{--<p>
                      <a title="Retirer de l'argent du compte" 
                      href="{{route('admin.user.withdraw',['id'=>$user->id])}}" class="btn btn-primary m-1">Retrait</a>
                      <a title="Déposer de l'argent dans le compte" href="{{route('admin.user.deposit',['id'=>$user->id])}}" class="btn btn-success m-1">Dépôt</a>
                    </p>--}}
                      <strong>ROLE</strong> 
                    <div class="row">
                      <div class="col-lg-6">
                      <form action="{{route('admin.user.role.admin',['id'=>$user->id])}}" method="post">
                        <select class="form-control" name="role">
                          <option value="">Aucun</option>
                          <option {{ $user->role_by_admin == "client" ? "selected" : "" }} value="client">Client</option>
                          <option {{ $user->role_by_admin == "controleur" ? "selected" : "" }} value="controleur">Contrôleur</option>
                          <option {{ $user->role_by_admin == "gestion" ? "selected" : "" }} value="gestion">Gestinnaire de compte</option>
                        </select>
                        @error('role')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <p><button class="btn btn-warning btn-sm mt-1">Attribuer</button></p>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                      </form>
                      </div>
                      <div class="col-lg-6 d-none d-lg-block">
                        <strong>Rôle actuel</strong> : 
                        @if($user->role_by_admin == "client")
                          CLIENT
                        @elseif( $user->role_by_admin == "controleur" )
                          CONTROLEUR
                        @elseif( $user->role_by_admin == "gestion" )
                          GESTIONNAIRE DE COMPTE
                        @else   
                          /
                        @endif
                      </div>
                    </div>
                    @endif

                    <hr>
                    <p>
                      @if($user->role != 1)
                        <a class="btn btn-warning btn-sm" 
                        onclick="return confirm('Etes-vous sûre de vouloir effectuer cette action ?')" 
                        href="{{route('admin.user.grant_admin',['id'=>$user->id])}}">Nommer administrateur ?</a>
                      @else    
                        @if ( Auth()->user()->id != $user->id ) 
                        <a class="btn btn-info btn-sm" 
                        onclick="return confirm('Etes-vous sûre de vouloir effectuer cette action ?')" 
                        href="{{route('admin.user.revoke_admin',['id'=>$user->id])}}">Retirer des admins ?</a>
                        @else    
                         <strong>( Vous )</strong>
                        @endif
                      @endif

                    </p>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Intitulé</th>
                          <th>Montant opération</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                          @forelse($transactions as $t)
                          <tr>
                            <td>
                              {{$t->content}}
                            </td>
                            <td class="text-center">{{$t->amount ?? '/'}} 
                              @if($t->countryFrom())   
                                {{$t->countryFrom()->devise()->abbreviation}}
                              @elseif($t->devise())
                                {{$t->devise()->abbreviation}}
                              @endif
                              
                            </td>
                            <td>{{date('d-m-Y H:i')}}</td>
                          </tr>
                          @empty  
                          <tr><td colspan="4" class="text-center"> Aucune donnée</td></tr>
                          @endforelse
                        
                      </tbody>
                    </table>
                  </div>
                  @if($user->type_compte == 3)
                  <div class="tab-pane" id="profil">
                    <div>
                      <div>
                        <p> <strong>Nom société</strong>: {{$user->nameSociete}} </p>
                        <p> <strong>adresse société</strong>: {{$user->adresseSociete}} </p>
                        <p> <strong>Téléphone société</strong>: {{$user->telephoneSociete}} </p>
                        <p> <strong>Service société</strong>: {{$user->serviceSociete}} </p>
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div>
</div>
@endsection
