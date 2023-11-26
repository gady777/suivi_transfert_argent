@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Faire une demande de paiement à Transfert Union </p>

    </h3>
    <h4 class="text-2 msg-header"><a href="{{route('u.make.paiment.store') }}">Voir l'etat de mes demandes</a> </h4>
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form action="{{ route('u.make.payment.next') }}" method="POST" enctype="multipart/form-data"
            class="form bg-offwhite py-5">
            @csrf
            <div class="text-left">


                <!--p class="text-4 text-center">Request your payment on anytime, anywhere in the world.</p-->
            </div>
            <?php
            if(isset($msg)){ ?>
            <div class="alert alert-success">
                Votre demande a été envoyer avec succès
            </div>
            <?php } ?>

            <div class="form-group">
                <div class="">
                    <div class="form-group">
                        <label for="nom">Une preuve de paiement</label>
                        <div class="custom-file">
                            <input type="file" class="" id="preuve" name="preuve">
                        </div>
                    </div>

                </div>
                @error('preuve')
                <div class="form-group" style="color:red">
                    Veuillez nous envoyer une image ou document attestant votre paiement
                </div>
                @enderror
                <div class="form-group">
                    <label for="description">Laisser un message</label>
                    <textarea class="form-control p-3" name="message" rows="4"
                        placeholder="">{{  @old('message')}}</textarea>
                </div>
                @error('message')
                <div class="form-group" style="color:red">
                    Laisser un motif
                </div>
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
