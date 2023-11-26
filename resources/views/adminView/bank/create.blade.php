@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Banques - Nouvelle
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
            <h1 class="m-0 text-dark">Banque en ligne</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.bank.home')}}">Banques</a></li>
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
                <h3 class="card-title">Ajouter une nouvelle banque</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nom de la banque</label>
                    <input name="bank_name" value="{{old('bank_name')}}" maxlength="50" type="text"
                    class="form-control" id="exampleInputEmail1" placeholder="Nom de la banque">
                    @if ($errors->has('bank_name'))
                      <div class="text-danger">{{ $errors->first('bank_name') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="place">Intitulé du compte</label>
                    <input maxlength="50" value="{{old('account_name')}}" name="account_name" type="text" class="form-control"
                    id="place" placeholder="Intitulé du compte">
                    @error('account_name') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Numéro du compte</label>
                    <input name="number" value="{{old('number')}}" type="text"
                    class="form-control" maxlength="100" id="v" placeholder="Numéro du compte">
                    @if ($errors->has('number'))
                      <div class="text-danger">{{ $errors->first('number') }}</div>
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
