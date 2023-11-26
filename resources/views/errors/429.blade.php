{{--@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
--}}
@extends('public.layout')
@section ('title')
Erreur 429 | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<section class="error-section">
      <div class="container">
        <div class="row">
          <div class="col-md-11 m-auto">
            <img src="{{asset('template/images/429.png')}}" alt="">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-9 m-auto text-center">
            <div class="sec-heading">
              <h2 class="sec-title">Oops! Trop de requêtes</h2>
              <p class="sec-subtitle">Trop de requêtes sont effectuées</p>
            </div>
            <a href="{{route('home')}}" class="btn btn-filled btn-round">
                <span class="bh"></span> <span>Retour à l'accueil</span>
            </a>
          </div>
        </div>
      </div>
    </section>
@endsection