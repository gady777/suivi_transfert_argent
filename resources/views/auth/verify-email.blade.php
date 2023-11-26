@extends('public.layout')
@section ('title')
Confirmer email | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection
@section('contenu')
<section class="overview">
<div class="container">
<div class="row">
<div class="col-lg-6">
       <img style="max-width: 400px; width:100%;height:auto;" src="{{asset('assets/img/envelope.png')}}" 
                                       alt="Email">
    </div>
    <div class="col-lg-6">
                    <h1>Bravooo!</h1>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Un nouveau lien de vérification a été envoyé à 
                            votre adresse e-mail.
                        </div>
                        @endif
                        <p>La création de votre compte a été effectuée avec succès. 
                            veuillez vous vérifier votre boîte aux mails pour confirmer votre 
                            adresse email .
                            Si vous n'avez pas reçu de mail
                            <form class="d-inline" method="POST" action="{{ route('verification.send')  }}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" 
                                    class="btn btn-primary btn-sm">
                                cliquer ici pour renvoyer
                            </button>
                            </form>
                        </p>
                        <a href="{{route('home')}}">Revenez à l'accueil</a>
    </div>
</div>
</div>
</section>
@endsection
