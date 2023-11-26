@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Transférer de l'argent 
            <a class="float-right" href="{{route('u.transfer.home')}}">Tous les transferts</a>
        </p>
    </h3>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)">Méthode</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Infos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Succès</a>
        </li>
    </ul>

    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" 
    aria-labelledby="pills-profile-tab">
        <form id="send-money" method="post" 
            action="{{ route('u.transfer.state2') }}" class="form bg-offwhite py-5" >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="country" value="{{$country->id}}">
            <input type="hidden" name="recipient" value="{{$recipient->id}}">
            <div class="form-group">
                <h3 class="title"> Choisir une méthode</label>
                <select name="method" id="method" class="form-control">
                    <option value="">Choisir</option>
                    @foreach ($methods as $meth)
                    <option {{ old('method') == $meth->slug ? 'selected' : '' }} value="{{$meth->slug}}">{{$meth->name}}</option>
                    @endforeach
                </select>
            </div>
            <div> <hr>
                @include ("usersView.transfer._depot_method")
            </div>
            <ul class="pager mt-4">
                <li>
                    <a href="javascript:history.back()" class="btn btn-default mr-0">
                        <i class="fas fa-chevron-left"></i>
                        <span>Précédent</span>
                    </a>
                </li>
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