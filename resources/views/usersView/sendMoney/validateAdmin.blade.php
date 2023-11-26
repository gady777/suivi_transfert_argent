@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading">Demande de paiement - Etape 2</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link " href="{{route('createTransaction')}}">Commencer</a>
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

            <form id="send-money" method="POST" class="form bg-offwhite py-5" action={{ route('u.send.confirm') }}  >
                @csrf
                <input type="hidden" name="type" value="Admin" >

                <div class="text-center">
                    <span>Ennvoyer de l'argent à <h4>Transfert Union</h4></span>
                </div>


                <?php if(isset($msg)){ ?>
                <div class="alert">
                    <div class="alert alert-danger">
                        Votre solde est insuffisant pour effectué cette transaction
                    </div>
                </div>
                <?php } ?>
                @if (isset($error))
                <div class="alert">
                    <div class="alert-danger p-4">{{$error}}</div>
                </div>
                @endif
                <div class="form-group">
                    <label for="amount">Montant</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text currency-icon">$</span></div>
                        <input type="number" class="form-control" name="amount" value="1000"
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
                    <label for="description">Laisser un message</label>
                    <textarea class="form-control p-3" name="message" rows="4"
                        placeholder=""></textarea>
                    @error('message')
                    <span class="text-danger">Veillez laisser un motif de transaction</span>
                    @enderror
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
