@extends('layout_dash.template')
@section('title')  Détail du transfert par tranche  @endsection
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Détail du transfert par tranche
    </h3>
    <h3 class="admin-heading">
        Transfert par tranche de <strong>{{number_format($t->amount,2,'.',' ')}} {{$t->devise()->abbreviation}}</strong> ( <b>{{$t->amount_cfa}} XOF</b> ) . 
    </h3>
    <div class="card">
     <div class="card-body">
         <p>
           <a href="{{route('u.transfer.tranche.detail.send.des',['id'=>$t->id])}}" 
           class="btn btn-success"><i class="fa fa-paper-plane"></i> Toutes les réceptions</a>
           <a href="{{route('u.transfer.tranche.detail.send.tu',['id'=>$t->id])}}" 
           class="btn btn-primary"> <i class="fas fa-less-than"></i> Tous les envois</a>
         </p>
        <p> 
          <b>Id trans:</b> 
                  @if($t->transfer_id)  
                          <a title="Détail" href="{{route('u.transfer.show',['id'=>$t->transfer_id])}}">
                            {{$t->id_transaction}}
                          </a>
                          @else  
                          {{$t->id_transaction}} 
                          @endif
                </p>
                <p>
                  <b>Client:</b> <br>
                  {{$t->user()->pseudo }} (vous) <br>
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
                  <b>Solde envoi: </b> {{number_format($t->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}<br>
                  <b>Solde réception: </b> {{number_format($t->solde_envoi,2,'.',' ')}} F CFA (XOF)
                </p>
                <p>
                  <b>STATUT</b> <br>
                  <b>Envoi: </b> 
                  @if($t->complete)
                                <span class="badge badge-success">Complète</span>
                            @else  
                                <span class="badge badge-warning">En cours</span>
                            @endif
                    <br>
                  <b>Réception: </b>
                    @if($t->solde_envoi == 0)
                      <span class="badge badge-success">Complète</span>
                    @else  
                      <span class="badge badge-warning">En cours</span>
                    @endif
                </p>
        </div>
    </div>


    {{--<h3 class="admin-heading">
        Reste à envoyer à Transfert Union : {{number_format($t->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}
    </h3>
    <h3 class="admin-heading">
        Reste à envoyer au destinataire par Transfert Union : {{number_format($t->solde_envoi,2,'.',' ')}} F CFA
    </h3>--}}
</div>

@endsection
