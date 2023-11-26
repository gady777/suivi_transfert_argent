@extends('layout_dash.template')
@section('title')  Modifier un bénéficiaire @endsection
@section('contenu')

<h2 class="admin-heading"> Modifier un bénéficiaire </h2>
<!-- Credit or Debit Cards  -->
<div class="infoItems bg-offwhite  shadow">
    <div class="row">
        <div class="col-12 mb-4">
            <h3> Modifier un bénéficiaire</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 content-edit-area">
            <div class="edit-content">
            
            <form method="post" action="{{ route('u.recipient.edit.post',['id'=>$r->id]) }}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="text" name="name" 
                        placeholder="Nom *" value="{{old('name') ?? $r->name }}">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <input class="form-control form-control-lg" type="text" 
                        name="fname" placeholder="Prénom(s) *" value="{{old('fname') ?? $r->fname}}">
                        @error('fname')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <select name="country" class="form-control form-control-lg">
                            <option value="">Veuillez choisir un pays</option>
                            @foreach( $countries as $c )
                            <option @if(old('country')) {{ old('country') == $c->id ? 'selected' : '' }} @else {{ $r->country()->id == $c->id ? 'selected' : '' }}  @endif   
                                value="{{$c->id}}">{{$c->name}} ({{$c->devise()->abbreviation}}) 
                            </option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <input class="form-control form-control-lg" type="text" 
                        name="city" placeholder="Ville *" value="{{old('city') ?? $r->city}}">
                        @error('city')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <input class="form-control form-control-lg" type="email" 
                        name="email" placeholder="Email " value="{{old('email') ?? $r->email}}">
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>

                     {{-- @include('usersView.recipient._method_part_edit') --}}
                     
                    <button class="btn btn-default btn-center btn-block">
                        <span class="bh"></span>
                        <span>Enregistrez le destinataire</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Edit Card info  -->
<div id="edit-card-details" class="accord bg-offwhite mt-3 p-3  shadow">
    
</div>

@endsection
@section ('code')
<script>
jQuery(function($){

$('.single-payment').click(function(e){
    var d = $(this).attr('data-value');
    $('#payment_meth').val(d);
    toggleMethView(d);
    toggleVImg();
});
//
function toggleVImg(){
    $('.single-payment').each(function(){
        if ($(this).hasClass('selected')) {
            $(this).addClass('border border-danger border-lg');
            toggleMethView($(this).attr('data-value'));
        }else{
            $(this).removeClass('border border-danger border-lg');
        }
    });
}
toggleVImg();
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

});

</script>
@endsection