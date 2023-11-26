@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Faire un dépot à une autre personne </p>
    </h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('createTransaction')}}">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="send-money-details.html">Confirmer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="send-money-success.html">Success</a>
        </li>
    </ul>

    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form id="send-money" method="post" action="{{ route('u.send.verify') }}" class="form bg-offwhite py-5" >
            @csrf

            <div class="form-group">

                <label for="emailID"> A qui voulez-vous demander un depot ?</label>
                <div class="alert alert-warning">
                    Si votre demande est destinée à Transfert Union, entrer comme mail depot@transfert.com
                </div>

                @if (isset($msg))
                <div class="alert">
                    <div class="alert-danger p-4">Auncun utilisateur n'a pas été trouver, veillez verifier le mail</div>
                </div>
                @endif

                <input type="email" value="{{ @old('email') }}" class="form-control" name="email" placeholder="Entrer son mail">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <ul class="pager mt-4">
                <li>&nbsp;</li>
                <li>
                    <button class="btn btn-default mr-0">
                        <span>Suivant</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </li>
            </ul>
        </form>
    </div>

</div>
@endsection
