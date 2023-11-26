@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Devise
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
            <h1 class="m-0 text-dark">Banque en ligne</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Banques</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a class="btn btn-primary" href="{{route('admin.bank.new')}}">Ajouter
              une banque</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes les banques enregistrées</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Banque</th>
                      <th>Intitulé compte</th>
                      <th>Numéro de compte</th>
                      <th>Statut</th>
                      <th>Créé le</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($banks as $c)
                      <tr>
                        <td>{{$c->bank_name}}</td>
                        <td>{{$c->account_name}}</td>
                        <td>{{$c->number}}</td>
                        <td>{{ $c->is_active == true ? 'Actif': 'Non actif' }}</td>
                        <td> {{$c->created_at}} </td>
                        <td>
                            <a title="Modifier" href="{{route('admin.bank.edit',['id'=>$c->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.bank.delete',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucune banque</td>
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
