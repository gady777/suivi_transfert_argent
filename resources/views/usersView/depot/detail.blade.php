@extends('layout_dash.template')
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Détail du dépôt</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Détail du dépôt</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" 
        role="tabpanel" aria-labelledby="pills-profile-tab">

        <div class="tab-pane fade show active" id="pills-profile" 
        role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="bg-offwhite  success form">
                                        <div class="text-center">
                                            @php $d = $dep ; @endphp
                                            <h1 class="">
                                                <i class="far fa-help text-success"></i>
                                            </h1>
                                            @if($d->reject)
                                                <h3 class="text-danger"> 
                                                    <i class="fas fa-close"></i> Rejeté
                                                </h3>
                                                <p>
                                                    {{$d->reject_raison}}, le {{ date('d-m-Y H:i', strtotime($d->reject_at)) }}
                                                </p>
                                            @else  
                                                @if($d->statut == 'pending')   
                                                    <h3 class="text-warning">En attente...</h3>
                                                @elseif($d->statut == 'waiting_validation')
                                                    <h3 class="text-info">En cours...</h3>
                                                @else  
                                                    <h3 class="text-success">Succès!</h3>
                                                @endif
                                            @endif
                                            

                                            <p class="">
                                                Vous avez déposé 
                                                <b> {{$dep->amount}} {{$dep->currency()->abbreviation}} </b>, 
                                             Frais: <b>{{$dep->fee}} %</b>, montant réel: <b>{{ $dep->receive_amount }} {{$dep->currency()->abbreviation}}</b>
                                            </p>
                                            <div>
                                                <strong>Réception:</strong>
                                                @if($dep->method == "bank")  
                                                  <div>Nom de la banque: {{$d->bank_name}}</div>
                                                  <div>Intitulé du compte: {{$d->account_name}} </div>
                                                  <div>Numéro de compte: {{$d->account_number}}</div>
                                                  <div>Clé RIB: {{$d->rib}} </div>
                                                @elseif($d->method == "interact")
                                                  <div>Informations interact: {{$d->interact}}</div>
                                                @elseif($d->method == "mobile")
                                                  <div>Numéro mobile: {{$d->phone_number}}</div>
                                                  <div>Nom du propriétaire: {{$d->phone_name}}</div>
                                                @elseif ($d->method == "cash")
                                                    <div>Nom & Prénom: {{$d->cash_name_fname}}</div>
                                                    <div>Numéro CNI ou Passport: {{$d->cash_cni}}</div>
                                                @endif
                                            </div>
                                            
                                            <hr>
                                            <a href="{{route('u.depot.home')}}" 
                                            class="btn btn-default mr-0 mt-5">
                                                <span class="bh"></span>
                                                <span>Les dépôts</span>
                                            </a>
                                            <a href="{{route('u.depot.state1')}}" 
                                            class="btn btn-default mr-0 mt-5">
                                                <span class="bh"></span>
                                                <span>Un autre dépôt ?</span>
                                            </a>

                                        </div>
                                    </div>
                                </div>

        </div>

    </div>
</div>

@endsection
