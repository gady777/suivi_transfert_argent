@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Pays - edit
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
              <li class="breadcrumb-item active">Modifier</li>
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
                <h3 class="card-title">Modifier pays</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="int">Nom</label>
                    <input name="name" 
                    value="{{old('name') ? old('name') : $country->name}}"
                    maxlength="50" type="text" class="form-control" 
                    id="int">
                    @if ($errors->has('name'))
                      <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="sym">Code</label>
                    <input value="{{old('code') ? old('code') : $country->code}}" 
                    name="code"
                    maxlength="7"
                    type="text" class="form-control" id="sym">
                    @error('code') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                  <label for="v">Devise (Monnaie)</label>
                    <select class="form-control" name="devise" id="v">
                      <option value="">Veuillez choisir une devise</option>
                      @foreach($devises as $d)
                      <option @if(old('devise')) {{ $d->id == old('devise') ? 'selected' : '' }} @else {{$country->devise_id == $d->id ? 'selected' : ''}} @endif value="{{$d->id}}">{{$d->symbole}} - {{$d->abbreviation}} </option>
                      @endforeach
                    </select>
                    @if ($errors->has('devise'))
                      <div class="text-danger">{{ $errors->first('devise') }}</div>
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> 
                    <i class="fa fa-edit"></i> Modifier le pays</button>
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
