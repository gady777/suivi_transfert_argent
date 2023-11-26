@extends('adminView.layout.layout')

@section('title')
  {{config ('info.app_name')}} - Liste des administrateurs
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
            <h1 class="m-0 text-dark">Tous les administrateurs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Liste des administrateurs</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tous les administrateurs <span class="badge badge-dark">{{count($users)}}</span> </h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Pseudo</th>
                      <th>Statut compte</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($users as $user)
                      <tr>
                        <td>{{$user->pseudo}} {{$user->id == Auth()->user()->id ? '(VOUS)' : ''}} </td>
                        <td>
                            @if( $user->email_verified_at )
                                <span class="badge badge-success">Vérifié</span>
                            @else
                                <span class="badge badge-danger">Non vérifié</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.user.profile',['id'=>$user->id]) }}" title="Profil de l'utilisateur"
                            class="btn btn-info"> <span class="fas fa-eye"></span> </a>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="text-danger">Aucun administrateur</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
