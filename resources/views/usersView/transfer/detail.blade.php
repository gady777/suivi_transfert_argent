@extends('layout_dash.template')
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Détail du transfert</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Détail du transfert</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" 
        role="tabpanel" aria-labelledby="pills-profile-tab">

        <div class="tab-pane fade show active" id="pills-profile" 
            role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="bg-offwhite success form">
                                        <div class="">
                                            @php $d = $t ; @endphp
                                            @if($d->reject)
                                                <h3 class="text-danger"> 
                                                    <i class="fas fa-close"></i> Transfert rejeté
                                                </h3>
                                                <p>
                                                   <b>Raison:</b> {{$d->reject_raison}}, le {{ date('d-m-Y H:i', strtotime($d->reject_at)) }} {{config('app.timezone')}}
                                                </p>
                                            @else  
                                                @if($d->statut == 'pending')   
                                                    <h3 class="text-warning">Transfert en attente...</h3>
                                                @elseif($d->statut == 'waiting_validation')
                                                    <h3 class="text-info">Transfert en cours...</h3>
                                                @else  
                                                    <h3 class="text-success">Transfert effectué avec succès!</h3>
                                                @endif
                                            @endif

                                            <p>
                                                @php $r = $t->recipient();@endphp
                                                Vous avez transféré 
                                                <b> {{number_format($t->amount,2,'.',' ')}} 
                                                    {{$t->countryFrom()->devise()->abbreviation}} </b> à 
                                                    <b>{{$t->recipient()->name}} {{$t->recipient()->fname}}</b>    
                                            </p>
                                            <p>
                                                <b>Frais</b>: {{$t->fee_amount}} {{$t->countryFrom()->devise()->abbreviation}} <br> 
                                                <b>Montant réel</b>: 
                                                    {{ number_format($t->receive_amount,2,'.',' ') }} {{$r->country()->devise()->abbreviation}}
                                            </p>
                                            <p>
                                                <b>Id transfert:</b> {{$t->id_transaction}}
                                            </p>
                                            <div>
                                                <strong>Réception: ({{$t->method()->name}})</strong> <br>
                                                @php $mth_slug = $t->method()->slug;$rr = $t; @endphp
                                                @if($mth_slug == "bank")  
                                                  <div>Nom de la banque: {{$rr->bank_name}}</div>
                                                  <div>Intitulé du compte: {{$rr->account_name}} </div>
                                                  <div>Numéro de compte: {{$rr->account_number}}</div>
                                                  <div>Clé RIB: {{$rr->rib}} </div>
                                                @elseif($mth_slug == "interact")
                                                  <div>Informations interact: {{$rr->interact}}</div>
                                                @elseif($mth_slug == "mobile")
                                                  <div>Numéro mobile: {{$rr->phone_number}}</div>
                                                  <div>Nom du propriétaire: {{$rr->phone_name}}</div>
                                                @elseif ($mth_slug == "cash")
                                                    <div>Nom & Prénom: {{$rr->cash_name_fname}}</div>
                                                    <div>Numéro CNI ou Passport: {{$rr->cash_cni}}</div>
                                                @endif
                                                <p> 
                                                    <b>Bénéficiaire</b>: 
                                                    {{$t->recipient()->email}} ({{$t->recipient()->name}} {{$t->recipient()->fname}}) 
                                                </p>
                                            </div>
                                            
                                            <hr>
                                            <a href="{{route('u.transfer.home')}}" 
                                            class="btn btn-default mr-0 mt-5">
                                                <span class="bh"></span>
                                                <span>Les transferts</span>
                                            </a>
                                            <a href="{{route('u.transfer.state1')}}" 
                                            class="btn btn-default mr-0 mt-5">
                                                <span class="bh"></span>
                                                <span>Un autre transfert ?</span>
                                            </a>

                                        </div>
                                    </div>
                                </div>

        </div>

    </div>
</div>

@endsection
