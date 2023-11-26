@extends('layout_dash.template')
@section('contenu')

<h2 class="admin-heading">Ajouter des comptes bancaires </h2>
<!-- Credit or Debit Cards  -->
<div class="infoItems bg-offwhite  shadow">
    <div class="row">
        <div class="col-12 mb-4">
            <h3>Modifier un compte</h3>
        </div>
        <div class="content-edit-area">
            <div class="edit-header">
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="edit-content">
                <form id="add-Card" method="post" action="{{ route('u.bank.edit.save') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $card->id }}" >
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="your-card-provider">Fournisseur de carte</label>
                                <select id="your-card-provider" name="provider" class="custom-select" required="">

                                    @switch($card->provider)
                                        @case(1)
                                            <option value="">Choisir</option>
                                            <option value="01" selected >Visa</option>
                                            <option value="02">MasterCard</option>
                                            <option value="03">American Express</option>
                                            <option value="04">Discover</option>
                                            @break
                                        @case(2)
                                            <option value="">Choisir</option>
                                            <option value="01">Visa</option>
                                            <option value="02" selected>MasterCard</option>
                                            <option value="03">American Express</option>
                                            <option value="04">Discover</option>
                                            @break
                                        @case(3)
                                            <option value="">Choisir</option>
                                            <option value="01">Visa</option>
                                            <option value="02" >MasterCard</option>
                                            <option value="03" selected>American Express</option>
                                            <option value="04">Discover</option>
                                            @break
                                        @case(4)
                                           <option value="">Choisir</option>
                                            <option value="01">Visa</option>
                                            <option value="02" >MasterCard</option>
                                            <option value="03" >American Express</option>
                                            <option value="04" selected>Discover</option>
                                            @break
                                        @default

                                    @endswitch
                                </select>
                                @error('provider')
                                    <span class="text-danger">Choisissez le type de carte</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cardNumber">Numero de la carte</label>
                                <input type="number" class="form-control" name="numberCard" required value="{{ $card->numberCard , @old('numberCard') }}"
                                    placeholder="Numero de la carte" maxlength="16" minlength="16" >
                            </div>
                            @error('cardNumber')
                                <span class="text-danger">Numéro invalid</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="expiryDate">Date d'expiration</label>
                                <input name="dateExp" type="month" class="form-control" required
                                    value="{{ $card->dateExp ,@old('dateExp')}}" placeholder="MM/YY">
                                @error('dateExp')
                                    <span class="text-danger">Entrer la date d'expiration</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cvvNumber">CVV <!--span class="text-info ml-1" data-toggle="tooltip"
                                        data-original-title="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number."><i
                                            class="fas fa-question-circle"></i></span--></label>
                                <input  value="{{$card->cvv, @old('cvv')}}" id="cvvNumber" type="password" class="form-control"
                                    required name="cvv" value="" placeholder="CVV (3 caractères)">
                            </div>
                            @error('cvv')
                                <span class="text-danger">Entrer le cvv de la carte</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-card-holder-name">Nom sur la carte</label>
                                <input type="text" class="form-control" name="nameCard" value="{{ $card->nameCard, @old('nameCard') }}" required placeholder="Nom sur la carte">
                            </div>
                            @error('nameCard')
                                    <span class="text-danger">Entrer votre noom</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-default btn-center btn-block">
                        <span class="bh"></span>
                        <span>Modifier ma carte</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Card info  -->
<div id="edit-card-details" class="accord bg-offwhite mt-3 p-3  shadow">
    <!--div class="content-edit-area">
        <div class="edit-header">
            <h5 class="title">Update Card</h5>
            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="edit-content">
            <form id="update-card" method="post">
                <div class="form-group">
                    <label for="edircardNumber">Your Card Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><img class="ml-auto"
                                    src="images/visa.png" alt="visa" title=""></span></div>
                        <input type="text" class="form-control" data-card-form="edircardNumber" id="edircardNumber"
                            disabled value="XXXXXXXXXXXX4623" placeholder="Card Number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit-card-holder-name">Card Holder Name</label>
                    <input type="text" class="form-control" data-card-form="edit-card-holder-name"
                        id="edit-card-holder-name" required value="Sohne Due" placeholder="Card Holder Name">
                </div>
                <div class="form-row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="edit-expire-name">Expiry Date</label>
                            <input id="edit-expire-name" type="text" class="form-control"
                                data-card-form="edit-expire-name" required value="05/25" placeholder="MM/YY">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="edit-cvv-number">CVV Number <span class="text-info ml-1" data-toggle="tooltip"
                                    data-original-title="For this youre credit the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number."><i
                                        class="fas fa-question-circle"></i></span></label>
                            <input id="edit-cvv-number" type="password" class="form-control"
                                data-card-form="edit-cvv-number" required value="321" placeholder="CVV (3 digits)">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Security question</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Security question">
                        </div>
                    </div>

                </div>

                <button class="btn btn-default d-block">
                    <span>Update Card</span>
                </button>
            </form>
        </div>
    </div-->
</div>



@endsection
