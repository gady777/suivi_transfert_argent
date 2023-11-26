@extends('layout_dash.template')
@section('title')  Ajouter un bénéficiaire @endsection
@section('contenu')

<h2 class="admin-heading">Ajouter un bénéficiaire </h2>
<!-- Credit or Debit Cards  -->
<div class="infoItems bg-offwhite  shadow">
    <div class="row">
        <div class="col-12 mb-4">
            <h3>Ajouter un bénéficiaire</h3>
        </div>
    </div>
    <div class="row">
        <div class="content-edit-area col-lg-8">
            <div class="edit-content">
                <form method="post" 
                action="{{route('u.recipient.new.post')}}{{request()->query->get('ret') ? '?ret='.request()->query->get('ret') : '' }}{{request()->query->get('country') ? '&country='.request()->query->get('country') : '' }}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="text" name="name" 
                        placeholder="Nom *" required value="{{old('name')}}">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        
                    </div>
                     <div class="form-group">
                        <input class="form-control form-control-lg" type="text" 
                        name="fname" required placeholder="Prénom(s) *" value="{{old('fname')}}">
                        @error('fname')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <select required name="country" class="form-control form-control-lg">
                            <option value="">Veuillez choisir un pays</option>
                            @foreach( $countries as $c )
                            <option  {{ old('country') == $c->id ? 'selected' : '' }}  value="{{$c->id}}">{{$c->name}} ({{$c->devise()->abbreviation}}) </option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <input required class="form-control form-control-lg" type="text" 
                        name="city" placeholder="Ville *" value="{{old('city')}}">
                        @error('city')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <input required class="form-control form-control-lg" type="email" 
                        name="email" placeholder="Email " value="{{old('email')}}">
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                     </div>

                     {{-- @include('usersView.recipient._method_part') --}}
                     
                    <button class="btn btn-default btn-center btn-block mt-5">
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