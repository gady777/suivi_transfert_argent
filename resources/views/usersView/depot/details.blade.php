@extends('layout_dash.template')
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Envoyer de l'argent à un autre utilisateur</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="{{route('createTransaction')}}">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="send-money-details.html">Confirmer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="send-money-success.html">Success</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


            <form id="deposit-send-money" action="{{ route('processTransaction') }}" method="post" class="form bg-offwhite py-4">
                @csrf

                <div class="text-center">
                    <h3>Hello, <b>{{Auth::user()->pseudo}} </b></h3>
                    <p>Vous venez de lancer un depot sur votre compte Transfert Union</p>
                    <h2>${{ $infos->price }} avec {{ $infos->method_transaction }}</h2>

                </div>
                <br>
                <ul class="pager mt-4">
                    <li>
                        <a href="{{route('createTransaction')}}" class="btn btn-default mr-0">
                            <span class="bh"></span>
                            <i class="fas fa-chevron-left"></i>
                            <span>Retour</span>
                        </a>
                    </li>
                    <li>
                        <input type="hidden" name="price" value="{{ $infos->price }}" >
                        <input type="hidden" name="currency" value="{{ $infos->currency }}">
                        <input type="hidden" name="method_transaction" value="{{ $infos->method_transaction }}">


                        <button class="btn btn-default mr-0">
                            <span class="bh"></span>
                            <span>Confimer le depot</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </li>
                </ul>
            </form>

        </div>
    </div>
</div>


@endsection
