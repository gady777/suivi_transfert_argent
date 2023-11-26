@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Tranfert par tranche
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
            <h1 class="m-0 text-dark">Tranfert par tranche</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.home')}}">Transferts par tranche</a></li>
              <li class="breadcrumb-item active">Détail</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col">
            @if ( $t->complete == false )
            <a class="btn btn-primary m-1" href="{{route('admin.transfer.tranche.instance.new',['id'=>$t->id])}}">
              <i class="fas fa-plus"></i> Nouvelle réception
            </a>
            @endif
            @if ( $t->complete_envoi == false )
            <a class="btn btn-dark m-1" href="{{route('admin.transfer.tranche.instance.new.envoi',['id'=>$t->id])}}">
              <i class="fas fa-plus"></i> Nouvel envoi
            </a>
            @endif
            <a class="btn btn-success m-1" 
              href="{{route('admin.transfer.tranche.detail.reception',['id'=>$t->id])}}">
              <i class="fas fa-paper-plane"></i> Toutes les réceptions
            </a>
            <a class="btn btn-info m-1" 
              href="{{route('admin.transfer.tranche.detail.envoi',['id'=>$t->id])}}">
              <i class="fas fa-less-than"></i> Tous les envois
            </a>
            <p> 
              <br>
              Transfert par tranche de <strong>{{$t->amount}} {{$t->devise()->abbreviation}}</strong> 
              soit <b> {{number_format($t->amount_cfa,2,'.',' ')}} F CFA </b> à 
              <strong>{{$t->user()->pseudo}} ({{$t->user()->email}})</strong>
            </p>
          </div>
        </div> <br>
        
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> 
                  <span class="font-weight-bolder">Résumé</span>
                </h3>
              </div>
              <div class="card-body">
                <p> <b>Id trans:</b> 
                  @if($t->transfer_id)  
                          <a title="Détail" href="{{route('admin.transfer.detail',['id'=>$t->transfer_id])}}">
                            {{$t->id_transaction}}
                          </a>
                          @else  
                          <a title="Détail" href="{{route('admin.transfer.tranche.detail',['id'=>$t->id])}}"> 
                          {{$t->id_transaction}} </a>
                          @endif
                </p>
                <p>
                  <b>Client:</b> <br>
                  {{$t->user()->pseudo }} <br>
                  @if($t->transfer())
                    <b>Bénéficiaire: </b> {{$t->transfer()->recipient()->name}} {{$t->transfer()->recipient()->fname}} ({{$t->transfer()->recipient()->email}})
                  @endif
                </p>
                <p>
                    <b>Montant: </b> {{number_format($t->amount,2,'.',' ')}}
                </p>
                <p>
                  <b>Devise: </b> {{$t->devise()->abbreviation}}
                </p>
                <p>
                  <b>Solde réception: </b> {{number_format($t->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}<br>
                  <b>Solde envoi: </b> {{number_format($t->solde_envoi,2,'.',' ')}} F CFA (XOF)
                </p>
                <p>
                  <b>STATUT</b> <br>
                  <b>Réception: </b> 
                  @if($t->complete)
                                <span class="badge badge-success">Complète</span>
                            @else  
                                <span class="badge badge-warning">En cours</span>
                            @endif
                    <br>
                  <b>Envoi: </b>
                    @if($t->solde_envoi == 0)
                      <span class="badge badge-success">Complète</span>
                    @else  
                      <span class="badge badge-warning">En cours</span>
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
