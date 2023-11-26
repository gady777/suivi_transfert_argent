@extends('public.layout')
@section ('title')
Envoyez de l'argent en ligne | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<!-- Banner section start -->
<section class="banner v6">
      <div class="container">
        <div class="row">
          <div class="col-md-11 m-auto">
            <div class="ban-content text-center">
              <h1>Envoyez de l'argent avec simplicité</h1>
              <p>Économisez du temps et de l’argent! En seulement 3 clics, vous enverrez des sourires à des milliers de kilomètres.<br> Notre service en ligne est la manière la plus pratique et la plus économique d’envoyer de l’argent, que ce soit<br>  pour aider vos proches ou pour payer un service à l’étranger.</p>
            </div>            
          </div>        
        </div>
        {{--<div class="row">
          <div class="col-md-8 m-auto">
            <form class="receive-form" action="#">
              <div class="form-field">
                <label>Indiquez le pays du destinataire</label>
                <div class="join-field">
                  <div class="curr-select">
                    <span class="selected"><img src="{{asset('template/images/flags/usa.png')}}" alt="">Etat-Unis &nbsp;<i class="fas fa-caret-down"></i></span>
                    <ul>
                       <li><a href="#"><img src="{{asset('template/images/flags/euro.png')}}" alt="">France</a></li>
                       <li><a href="#"><img src="{{asset('template/images/flags/xof.png')}}" alt="">Cameroun</a></li>
                       <li><a href="#"><img src="{{asset('template/images/flags/australia.png')}}" alt="">Canada</a></li>
                    </ul>
                  </div>
                  <button class="btn btn-filled"><span class="bh"></span> <span>Commencez</span></button>
                </div>                
              </div>
            </form>
          </div>
        </div>--}}
      </div>
    </section>
    <!-- Banner section end -->

    <!-- Our process section start -->
    <section class="our-process">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 m-auto">
            <div class="sec-heading">
              <span class="tagline">Un processus simplifié</span>
              <h2 class="sec-title">Envoyez votre argent en ligne</h2>
              <p class="sec-subtitle">Envoyez votre argent en ligne sur notre site et choisissez le mode de réception de votre bénéficiaire, en agence ou sur un compte bancaire.</p>
            </div>
          </div>          
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="iconBox boxed-shadow text-center">
              <!-- <img src="images/icons/5.png" alt="" class="img-icon"> -->

              <!-- Roysha icon -->
              <span class="roysha-icon roysha-wallet"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span></span>

              <h5><a href="{{route('register.personnel')}}">Ouvrez un compte</a></h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="iconBox boxed-shadow text-center">
              <!-- <img src="images/icons/6.png" alt="" class="img-icon"> -->

              <!-- Roysha icon -->
              <span class="roysha-icon roysha-amount"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span></span>

              <h5><a href="#">Entrer le montant  à envoyer</a></h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="iconBox boxed-shadow text-center">
              <!-- <img src="images/icons/7.png" alt="" class="img-icon"> -->

              <!-- Roysha icon -->
              <span class="roysha-icon roysha-hand-card"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span></span>

              <h5><a href="#">Choisissez votre destinataire</a></h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="iconBox boxed-shadow text-center">
              <!-- <img src="images/icons/8.png" alt="" class="img-icon"> -->

              <!-- Roysha icon -->
              <span class="roysha-icon roysha-hand"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span></span>
              <h5><a href="#">Confirmer votre opération</a></h5>
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="{{ route('register.personnel') }}" class="btn btn-default">
                            <span class="bh"></span> <span>Je crée mon compte</span></a>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- Our process section end -->

    <!-- Online Transfer section start -->
    <section class="online-transfer bg-offwhite">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="content-box">
              <span class="tagline bar">Transfer en ligne </span>
              <h2>Envoyez de l'argent en ligne</h2>
              <p>Votre bénéficiaire peut retirer votre transfert en espèces dans l'une de nos agences, par virement bancare ou via leur portefeuille mobile.</p>
            </div>

            <div class="accordion has-numbering" id="accordion">
              <p align="justify">
                <b>Ouvrir votre profil.</b> Inscrivez-vous ou connectez-vous, puis choisissez l'option « Envoyer de l'argent ».<br><br>

<b>Vérifier votre profil.</b> Si vous n'avez pas vérifié votre profil, vous devez tout d'abord passer le processus de vérification pour pouvoir envoyer de l'argent en ligne.<br><br>

<b>Remplir les informations relatives à votre transfert d'argent.</b> Choisissez « Type de Retrait » comme méthode pour recevoir de l'argent et assurez-vous d'inclure les informations complètes de votre bénéficiaire.<br><br>

<b>Payer le transfert.</b> Vous ne payer que les prix affichés, aucun frais cachés ne vous sera demandé<br><br>

<b>Informer votre bénéficiaire.</b> Informer votre bénéficiaire et faites-lui savoir que l'argent est prêt à être retiré auprès de l'une de nos agences. Ne divulguez pas les détails du transfert à une autre personne que le bénéficiaire visé.<br><br>
      </p>
            </div>

          </div>
          <div class="col-md-6">
            <figure class="imgBox">
              <!-- <img src="images/online-transfer.png" alt=""> -->
              <img src="{{asset('template/images/ani5/1.png')}}" alt="" class="ani5 ani5img1">
              <img src="{{asset('template/images/ani5/2.png')}}" alt="" class="ani5 ani5img2">
              <img src="{{asset('template/images/ani5/3.png')}}" alt="" class="ani5 ani5img3">
              <img src="{{asset('template/images/ani5/4.png')}}" alt="" class="ani5 ani5img4">
              <img src="{{asset('template/images/ani6/5.png')}}" alt="" class="ani5 ani5img5">
              <img src="{{asset('template/images/ani6/6.png')}}" alt="" class="ani5 ani5img6">
            </figure>
          </div>
        </div>
      </div>
    </section>
@endsection
