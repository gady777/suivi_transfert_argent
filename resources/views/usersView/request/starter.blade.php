@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Demander de l'argent </p>
    </h3>
    <!--div class="row">
        <div class="col-6 text-center"><a href="" class="btn btn-secondary " >Voir les demandes envoyées</a></div>
        <div class="col-6 text-center"><a href="" class="btn btn-secondary ">Voir les demandes recues</a></div>
    </div-->

    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form id="send-money" method="post" action="{{ route('u.request.starter') }}" class="form bg-offwhite py-5" >
            @csrf
            <div class="text-center">
                <h3 class="text-5 msg-header">Envoyez une demande de paiement</h3>

                <!--p class="text-4 text-center">Request your payment on anytime, anywhere in the world.</p-->
            </div>
            <div>
                @if (isset($msg))
                <div class="alert">
                    <div class="alert-danger p-4">Auncun utilisateur n'a pas été trouver, veillez verifier le mail</div>
                </div>
                @endif
            </div>

            <div class="form-group">

                <label for="emailID"> A qui voulez-vous demander un depot ?</label>
                <div class="alert alert-warning">
                    Si votre demande est destinée à Transfert Union, entrer comme mail depot@transfert.com
                </div>

                <input type="email" value="{{ @old('email') }}" class="form-control" name="email" required="" placeholder="Entrer son mail">
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
