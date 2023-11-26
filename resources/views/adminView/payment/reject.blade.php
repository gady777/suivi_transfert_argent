@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Rejeter une demande de paiement
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
            <h1 class="m-0 text-dark">Paiement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.payment.home')}}">Paiement</a></li>
              <li class="breadcrumb-item active">Rejeter</li>
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
                <h3 class="card-title">Rejeter la demande de paiement</h3>
              </div>

              <form method="post" action="{{route('admin.payment.reject.post',['id'=>$payment->id])}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="r">Raison</label>
                    <textarea class="form-control" name="raison" id="r" rows="5" maxlength="255" placeholder="Indiquez les raisons du rejet">{{old("raison")}}</textarea>
                    @if ($errors->has('raison'))
                      <div class="text-danger">{{ $errors->first('raison') }}</div>
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Rejeter</button>
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
