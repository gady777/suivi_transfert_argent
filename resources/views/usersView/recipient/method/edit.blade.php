@extends('layout_dash.template')
@section('title')  Modifier une méthode de réception @endsection
@section('contenu')

<h2 class="admin-heading">Modifier une méthode de réception</h2>
<!-- Credit or Debit Cards  -->
<div class="infoItems bg-offwhite  shadow">
    <div class="row">
        <div class="col-12 mb-4">
            <p>Modifier une méthode de réception</p>
        </div>
    </div>
    <div class="row">
        <div class="content-edit-area col-lg-8">
            <div class="edit-content">
                <form method="post" 
                action="{{route('u.recipient.method.edit.post',['id'=>$recipient->id,'meth_id'=>$meth->id])}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="recipient" value="{{$recipient->id}}">
                    <div class="form-group">
                        <label class="title"> Choisir une méthode</label>
                        <select name="method" id="method" class="form-control">
                            <option value="">Choisir</option>
                            @foreach ($methods as $method)
                            <option @if(old('method')) {{ old('method') == $method->slug ? 'selected' : ''}}  @else {{ $meth->method()->slug == $method->slug ? 'selected' : '' }}  @endif value="{{$method->slug}}">{{$method->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @include ("usersView.recipient.method._recipient_method_edit")
                    </div>
                    <button class="btn btn-default btn-center btn-block mt-5">
                        <span class="bh"></span>
                        <span>Enregistrez la modification</span>
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
@section('code')
<script>
jQuery(function($){ 

$('#method').change(function(){
    toggleMethView();
})
toggleMethView();
//
function toggleMethView(){
    var meth = $('#method').val();
    if(!meth){
        return;
    }
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