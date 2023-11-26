@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Pays - Nouveau
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
            <h1 class="m-0 text-dark">Pays</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.country.home')}}">Pays</a></li>
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
                <h3 class="card-title">Ajouter un pays</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nom</label>
                    <input name="name" 
                    value="{{old('name')}}" maxlength="50" type="text"
                    class="form-control" id="exampleInputEmail1" 
                    placeholder="Entrez le nom du pays">
                    @if ($errors->has('name'))
                      <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="place">Code</label>
                    <input value="{{old('code')}}" name="code" maxlength="7" type="text" class="form-control"
                    id="place" placeholder="Code pays. Ex BJ pour Bénin">
                    @error('code') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Devise (Monnaie)</label>
                    <select class="form-control" name="devise" id="v">
                      <option value="">Veuillez choisir une devise</option>
                      @foreach($devises as $d)
                      <option {{ $d->id == old('devise') ? 'selected' : '' }} value="{{$d->id}}">{{$d->symbole}} - {{$d->abbreviation}} </option>
                      @endforeach
                    </select>
                    @if ($errors->has('devise'))
                      <div class="text-danger">{{ $errors->first('devise') }}</div>
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> 
                    <i class="fa fa-plus"></i> Ajouter</button>
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
