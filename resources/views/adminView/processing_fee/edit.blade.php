@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Devise - edit
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
                <h3 class="card-title">Modifier devise</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="int">Intitulé</label>
                    <input name="intitule" value="{{old('intitule') ? old('intitule') : $currency->intitule}}"
                    maxlength="50" type="text" class="form-control" id="int">
                    @if ($errors->has('intitule'))
                      <div class="text-danger">{{ $errors->first('intitule') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="sym">Symbole</label>
                    <input value="{{old('symbole') ? old('symbole') : $currency->symbole}}" name="symbole"
                    maxlength="10"
                    type="text" class="form-control" id="sym">
                    @error('symbole') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Abbreviation</label>
                    <input value="{{old('abbreviation') ? old('abbreviation') : $currency->abbreviation}}"
                    name="abbreviation"
                    maxlength="10"
                    type="text" class="form-control" id="v">
                    @error('abbreviation') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-edit"></i> Modifier la devise</button>
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
