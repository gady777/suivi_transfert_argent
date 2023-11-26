{{--@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
--}}
@extends('public.layout')
@section ('title')
Erreur 500 | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<section class="error-section">
      <div class="container">
        <div class="row">
          <div class="col-md-11 m-auto">
            <img src="{{asset('template/images/500.png')}}" alt="">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-9 m-auto text-center">
            <div class="sec-heading">
              <h2 class="sec-title">Oops! Erreur 500</h2>
              <p class="sec-subtitle">Erreur du serveur</p>
            </div>
            <a href="{{route('home')}}" class="btn btn-filled btn-round">
                <span class="bh"></span> <span>Retour à l'accueil</span>
            </a>
          </div>
        </div>
      </div>
    </section>
@endsection