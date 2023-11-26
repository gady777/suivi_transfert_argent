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
            <a class="nav-link active" href="javascript:void(0)">Commencer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Méthode</a>
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
        <form id="send-money" method="get" 
            action="{{ route('u.transfer.method') }}" class="form bg-offwhite py-5" >
            <div class="form-group">
                    <label for="country"> Pays d'envoi</label>

                    <select class="form-control" id="country" name="country" required>
                        <option value="">Choisir un pays</option>
                        @foreach( $countries as $c )
                        <option {{ old('country') == $c->id ? 'selected' : '' }} value="{{$c->id}}">{{$c->name}} ( {{$c->devise()->abbreviation}} ) </option>
                        @endforeach
                    </select>
                    @error('country')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    @if(\Session::has('error'))
                        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                        {{ \Session::forget('error') }}
                    @endif
            </div>
            <div class="form-group">
                <label for="emailID"> A qui voulez-vous transférer de l'argent ?</label>
                @if (Auth()->user()->recipients()->count() == 0 )   
                    <div class="alert alert-danger">
                        Vous devez ajouter au moins un bénéficiaire pour faire un 
                        transfert d'argent.
                    </div>
                    <p>  
                        <a href="{{route('u.recipient.new')}}">Ajouter un bénéficiaire</a>
                    </p>
                @else  
                <select id="recipient" class="form-control" name="recipient" required>
                    <option value="">Choisir un bénéficiaire</option>
                    @php $recs = Auth()->user()->recipients(); @endphp
                    @foreach( $recs as $r )
                        <option {{ old('recipient') == $r->id ? 'selected' : '' }} value="{{$r->id}}">{{$r->name}} {{$r->fname}} ({{$r->country()->name}}) </option>
                    @endforeach
                    <option value="new">Autre bénéficiaire</option>
                </select>
                @error('recipient')
                <span class="text-danger">{{$message}}</span>
                @enderror

                @endif

                @if(\Session::has('error'))
                    <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                @endif
            </div>

            <ul class="pager mt-4">
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
        $('#recipient').change(function(){
            if($(this).val() == 'new'){
                let v = '{{route("u.recipient.new")}}?ret=trans-state1';
                if($('#country').val()){
                    window.location = v+'&country='+$('#country').val();
                }
                 
            }
        });
    });
</script>

@endsection