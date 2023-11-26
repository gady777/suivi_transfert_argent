@extends('layout_dash.template')
@section('title')  Dépôt d'argent, étatpe 1  @endsection
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Dépôt</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)">Pays & Destinataire</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Montant</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Confirmation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Succès</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

            <form id="send-money" method="post" class="form bg-offwhite py-5" action="{{ route('u.send.verify') }}" >
                @csrf
                <div class="text-center">
                    <h3 class="text-5 msg-header">Details sur la personne</h3>
                    <p class="text-4 text-center">Envoyez de l'argent sur le compte de vos proches.</p>
                </div>
                <div>
                    @if (isset($msg))
                    <div class="alert">
                        <div class="alert-danger p-4">Auncun utilisateur trouvé, veuillez verifier l'e-mail</div>
                    </div>
                    @endif
                    @if (isset($error))
                    <div class="alert">
                        <div class="alert-danger p-4">{{$error}}</div>
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="emailID">Entrer le mail de l'utilisateur</label>
                    <input type="text" name="email" value="{{ @old('email') }}" class="form-control" data-bv-field="emailid" id="emailID" required
                        placeholder="Entrer son mail">
                </div>

                <ul class="pager mt-4">
                    <li>&nbsp;</li>
                    <li>
                        <button class="btn btn-default mr-0">
                            <span>Continuer</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </li>
                </ul>
            </form>
        </div>

    </div>
</div>


@endsection
