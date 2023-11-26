@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading">Demande de paiement - Etape 2</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="{{route('u.request.starter')}}">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="request-money-payment.html">Details paiement</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Success</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

            <form id="send-money" method="post" class="form bg-offwhite py-5" action={{ route('u.request.confirm') }} >
                @csrf
                <input type="hidden" name="type" value="User" >
                <div class="text-center">
                    <h3>Details sur le paiement</h3>

                </div>
                <input type="hidden" name="idRec" value="{{ $info->id }}" >
                <div class="form-group">
                    <label for="amount">Montant</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text currency-icon">$</span></div>
                        <input type="number" class="form-control" name="amount" data-bv-field="amount" id="amount" value="10
                        00"
                            placeholder="">

                        <div class="input-group-append"> <span class="input-group-text p-0">
                               <select name="devise" id="" class="form-control" >
                                   @foreach( $les_devises as $devise)
                                    <option value="{{ $devise->id }}">{{ $devise->abbreviation." ( ".$devise->symbole." ) " }}</option>
                                   @endforeach
                               </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="paymentDue">Paiement doit etre fait avant le</label>
                    <div class="position-relative">
                        <input id="paymentDue" value="" type="text" name="dateBut" class="form-control" required
                            placeholder="Payment Due Date">
                        <span class="icon-inside"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description de la demande</label>
                    <textarea class="form-control p-3" name="description" rows="4" id="description" required
                        placeholder="Payment Description"></textarea>
                </div>

                <ul class="pager mt-4">
                    <li></li>
                    <li>
                        <button class="btn btn-default mr-0">
                            <span>Lancer la demande</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </li>
                </ul>
            </form>
        </div>

    </div>
</div>
@endsection
