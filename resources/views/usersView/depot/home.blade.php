@extends('layout_dash.template')
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Deposer de l'argent</h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Success</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

            <div class="form-group">
                <form action="{{route('u.depot.state2')}}" method="POST" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text currency-icon"> 
                            <i class="fas fa-money-check-alt"></i> </span>
                        </div>
                        <input min="5" type="number" 
                        class="form-control @error('amount') is-invalid @enderror" 
                        name="amount" 
                            value="{{old('amount')}}" 
                            placeholder="Montant" id="price">                        
                        <div class="input-group-append">
                            <select name="currency" data-style="custom-select" 
                            data-container="body" data-live-search="true" 
                            class="selectpicker" id="currency">
                            <optgroup label="Choisir une monnaie">
                                @foreach( $currencies as $cur )
                                <option data-icon="currency-flag currency-flag-{{strtolower($cur->abbreviation)}} mr-1" 
                                        data-subtext="{{$cur->intitule}}" 
                                        @if( old('currency') == $cur->id ) selected @endif 
                                        value="{{$cur->id}}">{{$cur->abbreviation}}
                                </option>
                                @endforeach
                            </optgroup>
                            </select>
                            @error('currency')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    
                    @include('usersView.depot._method_part')
                    <hr>
                    <div>
                        <div style="display: none;">
                          @foreach($meths as $mm)
                            <span class="meth-fee-{{$mm->slug}}">{{$mm->fee}}</span>
                          @endforeach
                        </div>
                        Frais: <strong id="reel_fee"></strong> <br>
                        Montant réel: <strong id="reel_amount"></strong>
                    </div>

                    <div class="form-group">
                        <button onclick="return confirm('Etes-vous sûre de vouloir effectuer le dépôt ?')" class="btn btn-primary">Lancer le depot</button>
                    </div>
                </form>

            </div>

        </div>

        @if(\Session::has('error'))
            <div class="alert alert-danger">{{ \Session::get('error') }}</div>
            {{ \Session::forget('error') }}
            @endif
            @if(\Session::has('success'))
            <div class="alert alert-success">{{ \Session::get('success') }}</div>
            {{ \Session::forget('success') }}
            @endif

    </div>
</div>

@endsection

@section ('code')
<script>
jQuery(function($){

$('.single-payment').click(function(e){
    var d = $(this).attr('data-value');
    $('#payment_meth').val(d);
    toggleMethView(d);
    calculateFee();
});
$('.single-payment').each(function(){
    if ($(this).hasClass('selected')) {
        toggleMethView($(this).attr('data-value'));
    }
});
//
function toggleMethView(meth){
    $('div[class*=meth-]').each(function(){
        if($(this).hasClass('meth-'+meth)){
            $(this).show();
            $(this).find('input,textarea').attr('required',true);
        }else{
            $(this).hide();
            $(this).find('input,textarea').removeAttr('required');
        }
    });
}
//
function calculateFee(){
    if(!$('#payment_meth').val()){
        return;
    }
    var p = parseInt($('#price').val(),10);

    var perc = parseFloat($('.meth-fee-'+ $('#payment_meth').val()).text()) ;
    var f = ( (p*perc) / 100);
    var c = $('#currency').find(":selected").text();
    $('#reel_fee').text(  p ? f + ' '+c : 0 + ' '+c);
    
    $('#reel_amount').text( p ? (p - f) + " "+c : "0 " + c );    
}
calculateFee();
//
$('#currency').on('change',function(){
    calculateFee();
});

$('#price').keyup(function(){
  calculateFee();
});

});

</script>
@endsection