@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Retirer de l'argent
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
            <h1 class="m-0 text-dark">Retrait</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.user.home')}}">Les utilisateurs</a></li>
              <li class="breadcrumb-item active">Retrait</li>
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
                <h3 class="card-title">Retrait du compte de {{$user->type_compte == 3 ? $user->pseudo : $user->nameSociete}}</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Solde actuel du compte</label>
                    <input type="text" class="form-control" readonly value="{{$user->solde}}">
                  </div>
                  <div class="form-group">
                    <label for="1">Montant à retirer</label>
                    <input name="amount" value="{{old('amount')}}" type="number"
                    class="form-control" id="1" placeholder="Montant">
                    @if ($errors->has('amount'))
                      <div class="text-danger">{{ $errors->first('amount') }}</div>
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-minus"></i> Retirer</button>
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
