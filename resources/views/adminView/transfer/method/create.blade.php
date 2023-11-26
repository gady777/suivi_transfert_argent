@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Méthodes de dépôt
@endsection

@section('body_class','hold-transition sidebar-mini layout-fixed')

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
            <h1 class="m-0 text-dark">Méthodes de dépôt</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.depot.method.home')}}">Méthodes de dépôt</a></li>
              <li class="breadcrumb-item active">Ajouter</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Créer une nouvelle méthode</h3>
              </div>

              <form method="post" action="{{ route('admin.depot.method.new') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Intitulé</label>
                    <input name="name" value="{{old('name')}}" maxlength="50" type="text"
                    class="form-control" id="exampleInputEmail1" placeholder="Nom de la méthode">
                    @if ($errors->has('name'))
                      <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="place">Slug</label>
                    <input value="{{old('slug')}}" name="slug" maxlength="10" type="text" 
                    class="form-control"
                    id="place" placeholder="Slug">
                    @error('slug') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Pourcentage prélevé comme frais de traitement</label>
                    <input name="fee" value="{{old('fee')}}" type="text"
                    class="form-control" id="v" placeholder="Frais de traitement">
                    @if ($errors->has('fee'))
                      <div class="text-danger">{{ $errors->first('fee') }}</div>
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Ajouter</button>
                </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
