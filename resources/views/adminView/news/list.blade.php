@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - News
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
            <h1 class="m-0 text-dark">Actualités</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Actualités</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a class="btn btn-primary" href="{{route('admin.news.new')}}">Créer
              une news</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes les actualités</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Description</th>
                      <th>Mots clés</th>
                      <th>Créé le</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($news as $new)
                      <tr>
                        <td>{{$new->title}}</td>
                        <td>{{$new->description}}</td>
                        <td>{{$new->keywords}}</td>
                        <td> {{$new->created_at}} {{config('app.timezone')}}</td>
                        <td>
                            <a title="Modifier" href="{{route('admin.news.edit',['id'=>$new->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.news.delete',['id'=>$new->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <a href="{{route('admin.news.show',['id'=>$new->id])}}" class="m-1 btn btn-dark" title="Détail"> <i class="fa fa-eye"></i> </a>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucune news</td>
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
