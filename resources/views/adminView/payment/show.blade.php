@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Détail payement
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
              <li class="breadcrumb-item active">Détail</li>
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
                <h3 class="card-title">Détail d'un paiement</h3>
              </div>
              <div class="card-body">
                <div> <a href="{{asset($payment->image)}}"><img src="{{asset($payment->image)}}" alt="Image" class="img-fluid"></a> </div>
                @if($payment->confirm)
                <p> 
                  <strong>Confirmation</strong> <br>
                  Paiement confirmé le 
                  <strong>{{date('d M Y',strtotime($payment->confirm_at))}}</strong>
                </p>
                @else   
                  @if($payment->reject)
                  <p> <span class="text-danger">
                    Payement rejeté pour cette raison</span>: <br>
                    {{$payment->raison}}, le {{date('d M Y',strtotime($payment->reject_at))}}
                  </p>
                  @else  
                  <div> <strong>Confirmation en attente</strong> <br>
                    <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.payment.confirm',['id'=>$payment->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-primary"> <i class="fas fa-check"></i> Confirmer </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                    <a href="{{route('admin.payment.reject',['id'=>$payment->id])}}" class="m-1 btn btn-danger">
                      <i class="fas fa-trash"></i> Rejeter
                    </a>
                  </div>
                  @endif
                @endif
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
