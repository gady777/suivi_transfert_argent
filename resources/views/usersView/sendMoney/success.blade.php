@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading">Envoyer de l'argent</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link " href="{{route('createTransaction')}}">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="send-money-details.html">Confirmer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="send-money-success.html">Success</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="bg-offwhite  success form">

                <div class="text-center">
                    <h1 class=""><i class="far fa-check-circle text-success"></i></h1>
                    <h3 class=" text-success">Success!</h3>
                    <p class="">Transaction Complete</p>
                    <p>Vous venez de créditer le compte de <b>{{ $info->email." ( ".$info->pseudo." )"  }}</b></p>

                    <hr>
                    <div class="invoice-option text-center mt-2">
                        <a href="{{route('u.invoice',['id'=>$deposit->id])}}" class="invoice-btn"><i class="far fa-file-pdf"></i>Save as PDF</a>
                    </div>
                    <hr>

                    <a href="{{route('u.dashboard')}}" class="btn btn-default mr-0 mt-5">
                        <span class="bh"></span>
                        <span>Voir historique de mes transactions</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
