@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Banque - edit
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
                <h3 class="card-title">Modifier une banque</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="int">Nom de la banque</label>
                    <input name="bank_name" value="{{old('bank_name') ? old('bank_name') : $bank->bank_name}}"
                    maxlength="50" type="text" class="form-control" id="int">
                    @if ($errors->has('bank_name'))
                      <div class="text-danger">{{ $errors->first('bank_name') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="sym">Intitulé du compte</label>
                    <input value="{{old('account_name') ? old('account_name') : $bank->account_name}}" name="account_name"
                    maxlength="50"
                    type="text" class="form-control" id="sym">
                    @error('account_name') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Numéro du compte</label>
                    <input value="{{old('number') ? old('number') : $bank->number}}"
                    name="number"
                    maxlength="100"
                    type="text" class="form-control" id="v">
                    @error('number') <div class="text-danger"> {{ $message }} </div> @enderror
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
