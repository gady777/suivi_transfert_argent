@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Dépôt
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
            <h1 class="m-0 text-dark">Dépôt</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.deposit.home')}}">Dépôt</a></li>
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
                <h3 class="card-title">Détail dépôt</h3>
              </div>
              @php $c= $depot; @endphp
              <div class="card-body">
                <p> <b>Date:</b> {{date("d-m-Y H:i",strtotime($c->created_at))}}</p>
                <p> <b>Demandeur:</b> {{ $c->author()->pseudo }}</p>
                <p> <b>Montant:</b> {{$c->amount}} {{$c->currency()->symbole ?? ''}} {{$c->currency()->abbreviation ?? ''}}</p>
                <p> <b>Méthode:</b> 
                @if($depot->method == "bank")
                        <b>Virement bancaire</b> <br>
                    Nom banque: <b>{{$depot->bank_name}}</b> <br>
                    Intitulé compte: <b>{{$depot->account_name}}</b> <br>
                    Numéro compte: <b>{{$depot->account_number}}</b> <br>
                    Clé RIB: <b>{{$depot->rib}}</b>
                    @elseif($depot->method == "mobile")
                      <b>Mobile Money</b> <br>
                      Numéro de téléphone: <b>{{$depot->phone_number}}</b> <br>
                      Propriétaire: <b>{{$depot->phone_name}}</b>
                    @elseif($depot->method == "cash")
                        <b>Cash Money</b> <br>
                        Nom & Prénom: <b>{{$depot->cash_name_fname}}</b> <br>
                        CNI ou Passport: <b>{{$depot->cash_cni}}</b>
                    @elseif($depot->method == "interact")
                        <b>Interact</b> <br>
                        Informations: <b>{{$depot->interact}}</b>
                    @endif
                </p>
                <p>
                    Frais: <b>{{ ( ( $depot->amount * $depot->fee ) / 100 ) }} {{$depot->currency()->abbreviation}}</b> <br>
                    Montant à recevoir: <b>{{$depot->receive_amount}} {{$depot->currency()->abbreviation}}</b> 
                </p>
                <p> <b>Statut:</b> 
                @if($c->reject)
                                <span class="text-danger"> <i class="fas fa-close"></i> Rejeté</span>, 
                                {{$c->reject_raison}}, le {{ date('d-m-Y H:i', strtotime($c->reject_at)) }}
                            @else  
                                @if($c->statut == 'pending')   
                                    <span class="badge badge-warning">En attente...</span>
                                @elseif($c->statut == 'waiting_validation')
                                    <span class="badge badge-info">En cours...</span>
                                @else  
                                    <span class="badge badge-success">Confirmé!</span>
                                @endif
                            @endif
                </p>
                
               <p> <b>Actions</b>: 
               
               @if($c->statut != "valid" and $c->reject == false)
                            @if( $c->statut != "waiting_validation" )
                            <form class="d-inline" 
                            onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                              action="{{route('admin.deposit.inprogress',['id'=>$c->id])}}" 
                              method="post">
                                <button type="submit" title="Marquer en cours de traitement" 
                                class="m-1 btn btn-info"> <i class="fas fa-spinner"></i> </button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            @endif
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.deposit.confirm',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-success"> <i class="fas fa-check"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <a href="{{route('admin.deposit.reject',['id'=>$c->id])}}" class="btn btn-danger" title="Rejeter la demande"><i class="fas fa-trash"></i></a>
                          @else 
                          /
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
