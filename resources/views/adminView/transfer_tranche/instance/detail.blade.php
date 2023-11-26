@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Transfert Tranche
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
            <h1 class="m-0 text-dark">Transfert - Tranche</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.home')}}">Transfert</a></li>
              <li class="breadcrumb-item active">Détail Tranche</li>
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
                <h3 class="card-title">Détail Tranche</h3>
              </div>
              <div class="card-body">
                @php  $p = $ti; @endphp
                <p>
                  <b>Transfert:</b> @if($t->transfer_id) 
                          <a title="Détail" href="{{route('admin.transfer.detail',['id'=>$t->transfer_id])}}">
                            {{$t->id_transaction}}
                          </a>
                          @else  
                            {{$t->id_transaction}}
                          @endif
                </p>
                <p> 
                  <b>Id paiement:</b> {{$p->id_reception }}
                </p>
                <p>
                  <b>Date paiement:</b> {{date('d-m-Y',strtotime($p->pay_date))}}
                </p>
                <p> 
                  <b>Méthode paiement:</b> {{$p->method()->name}}
                </p>
                <p> 
                    <b>Montant:</b> {{$p->amount}} {{$t->devise()->abbreviation}}
                </p>
                <p>
                    <b>Montant pay:</b> {{number_format($p->receive_amount,2,'.',' ')}}
                </p>
                <p> <b>Devise pay:</b>  {{$p->devise()->abbreviation}}  </p>
                <p> <b>Solde:</b> {{number_format($p->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}</p>
                <hr>
               <p> 
                 <b>Réception</b> <br> 
                 @if($ti->valid)   
                  <span class="badge badge-success">Confirmé</span>, 
                   le {{date('d-m-Y',strtotime($p->valid_date_ok))}} <br>
                  <strong>Message:</strong> {{$p->valid_message}}
                 @else   
                  <a href="{{route('admin.transfer.tranche.instance.confirm_reception',['id'=>$t->id,'instance_id'=>$p->id])}}" title="Confirmez la réception" class="btn btn-sm btn-success"> <i class="fas fa-check"></i> </a>
                 @endif
               </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
