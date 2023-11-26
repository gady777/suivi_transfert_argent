@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading">Demande d'argent envoyer avec succès</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#">Send</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Success</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="bg-offwhite  success form">

                <div class="text-center">
                    <h1 class=""><i class="far fa-check-circle text-success"></i></h1>
                    <h3 class=" text-success">Success!</h3>
                    <p class="">Transaction Complete</p>
                    <p class="">
                        Votre demande d'argent a été envoyée à <b>Admin</b>
                    </p>

                    <hr>
                    <div class="invoice-option text-center mt-2">
                        <a href="#" class="invoice-btn"><i class="far fa-file-pdf"></i>Save as PDF</a>
                        <a href="#" class="invoice-btn"><i class="fas fa-print"></i>Print Receipt</a>
                        <a href="#" class="invoice-btn"><i class="far fa-envelope"></i>Email Receipt</a>
                    </div>
                    <hr>

                    <a href="{{route('u.request.starter')}}" class="btn btn-default mr-0 mt-5">
                        <span class="bh"></span>
                        <span>Demander de l'argent à une autre personne</span>
                    </a>
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
