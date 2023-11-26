@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Frais
@endsection

@section('body_class','hold-transition sidebar-mini')

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
            <h1 class="m-0 text-dark">Les frais de traitement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Frais de traitement</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            {{--<a class="btn btn-primary" href="{{route('admin.currency.new')}}">Ajouter
              une devise</a>--}}
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tous les frais par devise</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Devise</th>
                      <th>Frais retrait</th>
                      <th>Minimum transfert (Banque)</th>
                      <th>Minimum transfert (PayPal)</th>
                      <th>Minimum transfert (MoMo)</th>
                      {{--<th>Minimum Paiement</th>--}}
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($fees as $c)
                      <tr>
                        <td>{{$c->devise()->abbreviation}}</td>
                        <td>{{$c->withdraw_fee}}</td>
                        <td>{{$c->minim_bank_account}}</td>
                        <td> {{$c->minim_tarnsfert_to_paypal}} </td>
                        <td>{{$c->minim_transfert_to_momo}}</td>
                        {{--<td>{{$c->minim_paiement}}</td>--}}
                        <td>
                            <a title="Modifier" href="{{route('admin.processing_fee.show.currency',['id'=>$c->devise()->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">
                        Aucun frais.
                        <a href="{{route('admin.currency.home')}}">Voir les devises</a>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
