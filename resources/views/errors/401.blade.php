{{--@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
--}}
@extends('public.layout')
@section ('title')
Erreur 401 | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<section class="error-section">
      <div class="container">
        <div class="row">
          <div class="col-md-11 m-auto">
            <img src="{{asset('template/images/401.png')}}" alt="">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-9 m-auto text-center">
            <div class="sec-heading">
              <h2 class="sec-title">Oops! Action non autorisée</h2>
              <p class="sec-subtitle">L'action que vous essayé de mener n'est pas autorisé</p>
            </div>
            <a href="{{route('home')}}" class="btn btn-filled btn-round">
                <span class="bh"></span> <span>Retour à l'accueil</span>
            </a>
          </div>
        </div>
      </div>
    </section>
@endsection