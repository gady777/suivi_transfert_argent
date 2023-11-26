@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Transfert
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
            <h1 class="m-0 text-dark">Transfert</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.home')}}">Transfert</a></li>
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
                <h3 class="card-title">Détail transfert</h3>
              </div>
              @php $c= $depot; @endphp
              <div class="card-body">
                <p> <b>Date:</b> {{date("d-m-Y H:i",strtotime($c->created_at))}}</p>
                <p> <b>Id transfert:</b> {{$c->id_transaction}}</p>
                <p> <b>Expéditeur:</b> {{ $c->author()->pseudo }}</p>
                <p class="border p-2"> <b>Bénéficiaire</b> <br> 
                  Email: <strong>{{$c->recipient()->email}}</strong> <br> 
                  Nom & Prénom(s): <strong>{{$c->recipient()->name}} {{$c->recipient()->fname}}</strong> <br>
                  Pays: <strong>{{$c->recipient()->country()->name}}</strong> <br>
                  Ville: <strong>{{$c->recipient()->city}}</strong>
                </p>
                <p> <b>Montant:</b> {{ $depot->amount }} {{$depot->countryFrom()->devise()->abbreviation}}</p>
                <p>
                    Frais: <b>{{ number_format($depot->fee_amount,2,'.',' ') }} {{$depot->countryFrom()->devise()->abbreviation}}</b> <br>
                    Montant à envoyer: <b>{{number_format($depot->receive_amount,2,'.',' ')}} {{$depot->recipient()->country()->devise()->abbreviation}}</b> 
                </p>
                <p> <b>Méthode:</b> 
                <b>{{$depot->method()->name}}</b> <br>
                @if($depot->method == "bank")
                        
                    Nom banque: <b>{{$depot->bank_name}}</b> <br>
                    Intitulé compte: <b>{{$depot->account_name}}</b> <br>
                    Numéro compte: <b>{{$depot->account_number}}</b> <br>
                    Clé RIB: <b>{{$depot->rib}}</b>
                    @elseif($depot->method == "mobile")
                      
                      Numéro de téléphone: <b>{{$depot->phone_number}}</b> <br>
                      Bénéficiaire: <b>{{$depot->phone_name}}</b>
                    @elseif($depot->method == "cash")
                        
                        Nom & Prénom: <b>{{$depot->cash_name_fname}}</b> <br>
                        CNI ou Passport: <b>{{$depot->cash_cni}}</b>
                    @elseif($depot->method == "interact")
                       
                        Informations: <b>{{$depot->interact}}</b>
                    @endif
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
                                action="{{route('admin.transfer.inprogress',['id'=>$c->id])}}" 
                                method="post">
                                  <button type="submit" title="Marquer en cours de traitement" 
                                  class="m-1 btn btn-info"> <i class="fas fa-spinner"></i> </button>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              </form>
                              @if($c->has_tranche)  
                              <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                              class="btn btn-primary m-1"> <i class="fas fa-list"></i> </a>
                              @else  
                              <a href="{{route('admin.transfer.tranche.new',['id'=>$c->id])}}" 
                              class="btn btn-warning m-1"> <i class="fas fa-random"></i> </a>
                              @endif
                            @endif
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.transfer.confirm',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-success"> <i class="fas fa-check"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            @if($c->has_tranche)  
                              @if($c->statut =="waiting_validation")
                                <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                                class="btn btn-primary m-1"> <i class="fas fa-list"></i> </a>
                              @endif
                            @else
                              @if($c->statut == "waiting_validation")
                              <a href="{{route('admin.transfer.tranche.new',['id'=>$c->id])}}" 
                                class="btn btn-warning m-1"> <i class="fas fa-random"></i> </a>
                              @endif
                              <a href="{{route('admin.transfer.reject',['id'=>$c->id])}}" class="btn btn-danger" title="Rejeter la demande"><i class="fas fa-trash"></i></a>
                            @endif
                          @else
                           @if($c->has_tranche)  
                             <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                                class="btn btn-primary m-1"> <i class="fas fa-list"></i> </a>
                           @endif
                           <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.archive.transfer.operate',['id'=>$c->id])}}" method="post">
                              <button title="Mettre dans les archives" type="submit" class="m-1 btn btn-default"> <i class="fas fa-backspace"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                          @endif
                          <a class="btn btn-dark m-1" title="Détail" 
                          href="{{route('admin.transfer.detail',['id'=>$c->id])}}"> 
                          <i class="fas fa-eye"></i> </a>
                    @if($c->has_tranche)  
                    <a class="btn btn-success m-1" title="Réceptions"
                      href="{{route('admin.transfer.tranche.detail.reception',['id'=>$c->tranche_id])}}">
                      <i class="fas fa-paper-plane"></i> Récep.
                    </a>
                    <a class="btn btn-info m-1" 
                      href="{{route('admin.transfer.tranche.detail.envoi',['id'=>$c->tranche_id])}}">
                      <i class="fas fa-less-than"></i> Env.
                    </a>
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
