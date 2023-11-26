@extends('layout_dash.template')
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Deposer de l'argent</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)">Success</a>
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
                                            <p class="">Vous avez déposé 
                                                <b> {{$dep->amount}} {{$dep->currency()->abbreviation}} </b>, 
                                             Frais: <b>{{$dep->fee}} %</b>, montant réel: <b>{{ $dep->receive_amount }} {{$dep->currency()->abbreviation}}</b>
                                            </p>
                                            <p>Veuillez patienter la confirmation par Transfert Union</p>
                                            
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
