@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Transférer de l'argent </p>
    </h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Méthode</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)">Infos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Succès</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" 
    aria-labelledby="pills-profile-tab">
       <div class="form-group">
        <form method="post" onsubmit="return confirm('Etes-vous de vouloir effectuer ce transfert ?') "
            action="{{route('u.transfer.state3')}}" class="form bg-offwhite py-1" >
            <input type="hidden" name="recipient" value="{{$r->id}}">
            <input type="hidden" name="country" value="{{$country->id}}">
            <input type="hidden" name="method" value="{{$method->slug}}">
            <div class="form-row">
                <div class="col-lg-6">
                    <strong>EXPEDITEUR</strong> <br>
                    <strong>Vous</strong> <br>
                    Pays d'envoi: <strong>{{$country->name}}</strong> <br>
                    Devise d'envoi: <strong>{{$country->devise()->intitule}} ({{$country->devise()->abbreviation}}) </strong>
                </div>
                <div class="col-lg-6 border-left">
                    <strong>BENEFICIAIRE</strong> <br>
                    Nom & Prénom(s): <strong>{{$r->name}} {{$r->fname}}</strong> <br>
                    Pays de réception: <strong>{{$r->country()->name}}</strong> <br>
                    Dévise de réception: <strong>{{$r->country()->devise()->intitule}} ({{$r->country()->devise()->abbreviation}}) </strong>

                    <p>
                        <strong>Méthode de réception</strong> ({{$method->name}})<br>
                        @php $meth = $method->slug; @endphp
                        @if($meth == "bank")
                        Nom de la banque: <strong>{{$bank_name}}</strong><br>
                        Intitulé du compte: <strong>{{$account_name}}</strong><br>
                        Numéro du compte: <strong>{{$account_number}}</strong><br>
                        RIB: <strong>{{$rib}}</strong>
                        @elseif( $meth == "interact" )
                            Les infos interact: <strong>{{$interact}}</strong> <br>
                        @elseif( $meth == "mobile" )
                            Numéro de téléphone: <strong>{{$phone_number}}</strong> <br>
                            Propriétaire: <strong>{{$phone_name}}</strong>
                        @elseif( $meth == "cash" )
                        Nom & Prénom CASH: <strong>{{$cash_name_fname}}</strong> <br>
                        CNI ou Passport: <strong>{{$cash_cni}}</strong>
                        @endif
                    </p>
                    <input type="hidden" name="bank_name" value="{{$bank_name}}">
                    <input type="hidden" name="account_name" value="{{$account_name}}">
                    <input type="hidden" name="account_number" value="{{$account_number}}">
                    <input type="hidden" name="rib" value="{{$rib}}">
                    <input type="hidden" name="interact" value="{{$interact}}">
                    <input type="hidden" name="phone_number" value="{{$phone_number}}">
                    <input type="hidden" name="phone_name" value="{{$phone_name}}">
                    <input type="hidden" name="cash_name_fname" value="{{$cash_name_fname}}">
                    <input type="hidden" name="cash_cni" value="{{$cash_cni}}">
                </div>
            </div>
            <div class="form-group">
                <div class="text-center"><strong>TAUX DE CHANGE</strong></div>
                <div class="form-row">
                    <div class="col-lg-6 text-right">
                        <strong>1 {{$country->devise()->abbreviation}} ==</strong>
                    </div>
                    <div class="col-lg-6">
                        @php $v = $country->devise()->rate / $r->country()->devise()->rate; @endphp
                        <strong> => {{number_format($v,6,'.',' ')}} {{$r->country()->devise()->abbreviation}} </strong>
                    </div>
                </div>
            </div>
            <hr>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <strong>MONTANT</strong>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text currency-icon"> 
                            <i class="fas fa-money-check-alt"></i> </span>
                        </div>
                        <input min="5" required type="number" id="amount"
                            class="form-control @error('amount') is-invalid @enderror" 
                            name="amount" 
                            value="{{old('amount')}}" 
                            placeholder="Montant"> 
                        @php $cur = $country->devise(); @endphp
                        <div class="input-group-append">
                            <span class="input-group-text currency-icon"> 
                                {{$cur->abbreviation}} 
                            </span>
                        </div>                           
                        
                    </div>
            </div>
            <div class="d-none">
                <span class="{{$country->devise()->abbreviation}}" id="trans_origin_abb"></span>
                <span class="{{$r->country()->devise()->abbreviation}}" id="trans_destinate_abb"></span>
                <input type="hidden" id="fee" value="{{$method->fee}}">
            </div>
            <div class="form-group">
                <strong>FRAIS & MONTANT REEL</strong> <br>
                <p>FRAIS: <strong id="trans_fee"></strong>  </p>
                <p>MONTANT REEL A TRANSFERER: <strong id="trans_amount"></strong></p>
            </div>
            <ul class="pager my-4">
                <li>
                    <a href="javascript:history.back()" class="btn btn-default mr-0">
                        <i class="fas fa-chevron-left"></i>
                        <span>Précédent</span>
                    </a>
                </li>
                <li>&nbsp;</li>
                <li>
                    <button type="submit" class="btn btn-default mr-0">
                        <span>Confirmer le transfert</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </li>
            </ul>
        </form>
        </div>
    </div>
    </div>
</div>
@endsection

@section('code')
<script>
    jQuery(function($){
        $('#amount').keyup(function(){
            op();
        });
        $('#amount').click(function(){
            op();
        });
        op();
        function convert(originAmount,rate,destinateRate){
            return (originAmount * rate) / destinateRate;
        }
        //
        function getOpFee(){
            if(! $('#amount').val() ){
                return 0;
            }
            var am = parseFloat($('#amount').val());
            var fee = parseFloat($('#fee').val());
            return ( ( am * fee ) / 100 );
        }

        function op(){
            var fee = getOpFee();
            var m_amount = 0;
            if(parseFloat($('#amount').val())){
                m_amount = parseFloat($('#amount').val()) - fee;
            }
            var dep = convert(m_amount,{{$country->devise()->rate}},{{$r->country()->devise()->rate}});
            $("#trans_fee").text(fee+" "+$('#trans_origin_abb').attr('class'));
            $('#trans_amount').text(dep+" "+$("#trans_destinate_abb").attr('class'));
        }
    });
</script>
@endsection