@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Devises - Nouvelle
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
            <h1 class="m-0 text-dark">Devises</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.currency.home')}}">Devises</a></li>
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
                <h3 class="card-title">Créer une nouvelle devise</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Intitulé</label>
                    <input name="intitule" value="{{old('intitule')}}" maxlength="50" type="text"
                    class="form-control" id="exampleInputEmail1" placeholder="Intitulé de la devise">
                    @if ($errors->has('intitule'))
                      <div class="text-danger">{{ $errors->first('intitule') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="place">Symbole</label>
                    <input value="{{old('symbole')}}" name="symbole" maxlength="10" type="text" class="form-control"
                    id="place" placeholder="Symbole de la devise">
                    @error('symbole') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Abbréviation</label>
                    <input name="abbreviation" value="{{old('abbreviation')}}" type="text"
                    class="form-control" id="v" placeholder="Abbréviation">
                    @if ($errors->has('abbreviation'))
                      <div class="text-danger">{{ $errors->first('abbreviation') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="vt">Taux en F CFA (XOF)</label>
                    <input name="rate" value="{{old('rate')}}" type="text"
                      class="form-control" id="vt" 
                      placeholder="Valeur en F CFA (XOF)">
                    @if ($errors->has('rate'))
                      <div class="text-danger">{{ $errors->first('rate') }}</div>
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
