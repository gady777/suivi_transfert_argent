@extends('adminView.layout.layout')

@section('title')
  {{config ('info.app_name')}} - Profil admin
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
            <h1 class="m-0 text-dark">Profil admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Mon profil</li>
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
                  @if($user->photo)  

                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset($user->photo)}}"
                       alt="Profil">
                  @else  
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset("admin/dist/img/user4-128x128.jpg")}}"
                       alt="Profil">
                  
                  @endif
                  
                </div>

                <h3 class="profile-username text-center">{{$user->pseudo}}</h3>

                <p class="text-muted text-center">{{$user->email}}
                </p>
                
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
                      Modifier vos infos
                    </a>
                  </li>
                 
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <h4>Photo de profil</h4>
                  @if (session('photo_error'))
                      <div class="alert alert-danger">
                          {{ session('photo_error') }}
                      </div>
                  @endif
                  <form enctype="multipart/form-data" action="{{route('admin.profile.update_photo')}}" method="post">
                    @csrf()
                    <div class="form-group">
                      <input type="file" name="photo" class="form-control">
                      @error('photo')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                      @if(Auth()->user()->photo)
                      <div> <a class="text-danger" href="{{route('admin.profile.delete_photo')}}">Supprimer la photo de profil</a> </div>
                      @endif
                  </div>
                    <button class="btn btn-primary">Modifier photo de profil</button>
                  </form>
                  <br> <hr>
                  <h4>Pseudo & Nom</h4>
                  @if (session('name_error'))
                      <div class="alert alert-danger">
                          {{ session('name_error') }}
                      </div>
                  @endif
                    <form action="{{route('admin.profile.update_name')}}" method="post">
                    @csrf()
                      <div class="form-group">
                        <input placeholder="Pseudo" type="text" class="form-control form-control-lg" name="pseudo" 
                        value="{{ old('pseudo') ?? $user->pseudo }}">
                        @error('pseudo')
                          <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <input placeholder="Votre nom" type="text" class="form-control form-control-lg" name="lastname" 
                        value="{{ old('lastname') ?? $user->lastname }}">
                        @error('lastname')
                          <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <input type="text" placeholder="Votre prénom" class="form-control form-control-lg" name="firstname" 
                        value="{{ old('firstname') ?? $user->firstname }}">
                        @error('firstname')
                          <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                      <button class="btn btn-primary">Modifier Pseudo & Nom</button>
                    </form>

                    <hr>
                  <h4>Modifier adresse de connexion email</h4>
                  @if (session('mail_error'))
                      <div class="alert alert-danger">
                          {{ session('mail_error') }}
                      </div>
                  @endif
                    <form action="{{route('admin.profile.update_login')}}" method="post">
                      <div class="form-group">
                        <input type="email" required class="form-control form-control-lg" name="email" 
                        value="{{ old('email') ?? $user->email }}">
                      </div>
                      <button class="btn btn-primary">Modifier email de connexion</button>
                      @csrf()
                    </form>
                    <hr>
                    <h4>Modifier mot de passe</h4>
                    @if (session('password_error'))
                      <div class="alert alert-danger">
                          {{ session('password_error') }}
                      </div>
                  @endif
                    <form action="{{route('admin.profile.update_password')}}" method="post">
                      @csrf()
                      <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="old_password"
                        placeholder="Ancien mot de passe">
                      </div>
                      <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" placeholder="Entrez votre nouveau mot de passe" name="password">
                        @error('password')
                          <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="password_confirmation"
                        placeholder="Confirmer le nouveau mot de passe">
                      </div>
                      <button class="btn btn-primary">Modifier mot de passe</button>
                    </form>
                  </div>
                  
                  <div class="tab-pane" id="profil">
                    <div>
                      <div>
                        
                      </div>
                    </div>
                  </div>
                 
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