@extends('layout_dash.template')
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Transfert d'argent</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Méthode</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Infos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)">Succès</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" 
        role="tabpanel" aria-labelledby="pills-profile-tab">

        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="bg-offwhite  success form">
                                        <div class="text-center">
                                            <h1 class=""><i class="far fa-check-circle text-success"></i></h1>
                                            <h3 class=" text-success">Succès!</h3>
                                            <p class="">Transaction Complète</p>
                                            <p class="">Vous avez transféré 
                                                <b> {{number_format($t->amount,2,'.',' ')}} {{$t->countryFrom()->devise()->abbreviation}} </b>, 
                                             Frais: <b>{{number_format($t->fee_amount,2,'.',' ')}} {{$t->countryFrom()->devise()->abbreviation}}</b>, 
                                             montant réel à la réception: <b>{{ number_format($t->receive_amount,2,'.',' ') }} {{$t->recipient()->country()->devise()->abbreviation}}</b>
                                            </p>
                                            <p>Veuillez patienter la confirmation par Transfert Union</p>
                                            
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
