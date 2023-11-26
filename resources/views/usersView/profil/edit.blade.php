@extends('layout_dash.template')
@section('contenu')
<div class="profile-area">
    <h3 class="admin-heading bg-offwhite">
        <a href="{{ route('u.profil') }}" class="" >
            <i class="fas fa-edit mr-1"></i>Voir mon profil</a>
        <p>Modifier mes informations</p>
        <span>Retrouvez ici vos différentes informations</span>
    </h3>
    <!-- Edit personal info  -->
    <div id="edit-personal-details" class="accord bg-offwhite shadow">

    </div>
    <!-- Edit personal info End -->


    <!-- Edit personal info End -->
    @foreach ($infos as $item)
    <div class="infoItems shadow">
        <div class="content-edit-area">
            <div class="edit-header">
                <h5 class="title">Mes Informations</h5>
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            </div>

            @if(Session('msg-error'))
            erreue
            @enderror

            <div class="edit-content">
                <form  method="post" action="{{ route('u.profil.save') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}" >

                    @if(Auth::user()->type_compte ==2)
                    <input type="hidden" name="type" value="ind" >
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="firstName"><b>Pseudo</b></label>
                                <input type="text" value="{{$item->pseudo }}" class="form-control" name="pseudo" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fullName"><b>Nom</b></label>
                                <input type="text" value="{{$item->firstname }}" class="form-control" name="firstname" placeholder="Nom de famille" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fullName"><b>Prénom(s)</b></label>
                                <input type="text" value="{{$item->lastname }}" class="form-control" name="lastname" placeholder="Prenom" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="birthDate"><b>Date d'annivversaire</b></label>
                                <div class="position-relative">
                                    <input id="birthDate" name="dateAnnif" value="{{$item->dateAnnif }}" type="text" class="form-control" required>
                                    <span class="icon-inside">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="emailID">Email ID <span
                                                class="text-muted font-weight-500">(Primary)</span></label>
                                        <input type="text" value="demo@company.com" class="form-control"
                                            data-pr-form="emailid" id="emailID" required placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailID">Email ID <span
                                                class="text-muted font-weight-500">(Personal)</span></label>
                                        <input type="text" value="demo@my.com" class="form-control"
                                            data-pr-form="emailid" id="emailID" required placeholder="Email ID">
                                    </div>
                                </div>
                            </div>
                            <a class="btn-link float-right mb-3" href="#"><span class="text-3 mr-1"><i
                                        class="fas fa-plus-circle"></i></span>Add another email</a>
                        </div-->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mobile-number">Numéro de téléphone <span
                                                class="text-muted font-weight-500">(Primary)</span></label>
                                        <input type="text" value="{{$item->telephoneUser}}" class="form-control"
                                            name="telephoneUser" required
                                            placeholder="Numero de telephone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Addresse</label>
                                <input type="text" value="{{$item->adresse}}" class="form-control" required name="adresse">
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit"><i class="far fa-save"></i> Sauvegarder les changements</button>
                    </div>
                    @elseif(Auth::user()->type_compte ==3)
                    <input type="hidden" name="type" value="pro" >
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="firstName"><b>Nom de la société</b></label>
                                <input type="text" value="{{$item->pseudo }}" class="form-control" name="pseudo" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fullName"><b>Nom du responsable</b></label>
                                <input type="text" value="{{$item->firstname }}" class="form-control" name="firstname" placeholder="Nom de famille" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fullName"><b>Prénom(s) du responsable</b></label>
                                <input type="text" value="{{$item->lastname }}" class="form-control" name="lastname" placeholder="Prenom" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="birthDate"><b>Date d'anniversaire du responsable</b></label>
                                <div class="position-relative">
                                    <input id="birthDate" name="dateAnnif" value="{{$item->dateAnnif }}" type="text" class="form-control" required>
                                    <span class="icon-inside">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="emailID">Email ID <span
                                                class="text-muted font-weight-500">(Primary)</span></label>
                                        <input type="text" value="demo@company.com" class="form-control"
                                            data-pr-form="emailid" id="emailID" required placeholder="Email ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailID">Email ID <span
                                                class="text-muted font-weight-500">(Personal)</span></label>
                                        <input type="text" value="demo@my.com" class="form-control"
                                            data-pr-form="emailid" id="emailID" required placeholder="Email ID">
                                    </div>
                                </div>
                            </div>
                            <a class="btn-link float-right mb-3" href="#"><span class="text-3 mr-1"><i
                                        class="fas fa-plus-circle"></i></span>Add another email</a>
                        </div-->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mobile-number">Numéro de téléphone personnel</label>
                                        <input type="text" value="{{$item->telephoneUser}}" class="form-control"
                                            name="telephoneUser" required
                                            placeholder="Numero de telephone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mobile-number">Numéro de téléphone professionnel</label>
                                        <input type="text" value="{{$item->telephoneSociete}}" class="form-control"
                                            name="telephoneSociete" required
                                            placeholder="Numero de telephone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Addresse Principale</label>
                                <input type="text" value="{{$item->adresse}}" class="form-control" required name="adresse">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Addresse Secondaire</label>
                                <input type="text" value="{{$item->adresseSociete}}" class="form-control"  name="adresseSociete">
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit"><i class="far fa-save"></i>Sauvegarder les changements</button>
                    </div>

                    @endif
                </form>

            </div>
        </div>

    </div>
    @endforeach



</div>
@endsection
