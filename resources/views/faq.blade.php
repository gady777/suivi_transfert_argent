@extends('public.layout')
@section ('title')
Centre d'aides | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
<section class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            <div class="ban-content text-center">
              <h1>Insérer votre requête ici</h1><br>
             </div>
            <form class="bill-form v2 w-100" style="display:inline-block !important;" method="get">
              <div class="form-field">
                <div class="join-field">
                  <input value="{{$q??''}}" name="q" type="text" placeholder="Posez votre question...">
                  <button class="btn btn-block btn-filled form-btn"><span class="bh"></span> <span>Recherchez</span></button>
                </div>
              </div>
              <span class="text-white">*Nous recueillons vos mots-clés de recherche pour améliorer notre FAQ.</span>
            </form>
          </div>        
        </div>
      </div>
    </section>
    <!-- Banner section end -->

    <!-- Faq section start -->
    <section class="faq-tab">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 m-auto text-center">
            <div class="sec-heading">
              <h2 class="sec-title">Questions fréquentes</h2>
              <p class="sec-subtitle">Nous cherchons toujours à répondre à toutes vos questions à travers 
                nos articles. Les transferts d’argent peuvent devenir compliqués lorsque vous commencez 
                à examiner les frais et les coûts. Nous avons pris tout le travail acharné et l’avons 
                transformé en sujets compréhensibles et intéressants à lire!</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-10 col-md-12 m-auto">
            <div class="tab-content">
              <div id="general-qs" class="tab-pane fade in active show">
                <div class="accordion" id="accordion">
                @forelse ($faqs as $f)
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" 
                    data-target="#faq-{{$f->id}}" aria-expanded="true">
                    {{$f->question}}
                    </h5>
                    <div id="faq-{{$f->id}}" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                      {!! $f->answer !!}
                      </div>
                    </div>
                  </div>
                @empty
                    Aucun élément
                @endforelse
                </div>
              </div>
              {{--<div id="trasn-money" class="tab-pane fade">
                <div class="accordion" id="accordion1">
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#tm-1" aria-expanded="true">
                      Access Your Mobile Wallet
                    </h5>
                    <div id="tm-1" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscied do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspen disse ultrices gravida.</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#tm-2" aria-expanded="false">
                      Input Wallet Informations
                    </h5>

                    <div id="tm-2" class="collapse show" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Molestie eu blandit eu sodales, nulla vitae nulla tempor et porta, ante nec commodo. Nulla non fringilla urna dolor vivamus, vulputate eu neque vivamus lacus in, imperdiet id sed malesuada per.</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#tm-3" aria-expanded="false">
                      Confirm information and payover 
                    </h5>

                    <div id="tm-3" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Blandit eu sodales, nulla vitae nulla tempor et porta, ante nec commodo. Nulla non fringilla urna dolor vivamus, vulputate eu neque vivamus lacus in, imperdiet id sed malesuada per.</p>
                      </div>                    
                    </div>
                  </div>
                </div>
              </div> --}}
              {{--<div id="mbl-banking" class="tab-pane fade">
                <div class="accordion" id="accordion2">
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#mblb-1" aria-expanded="true">
                        Input Wallet Informations
                    </h5>
                    <div id="mblb-1" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscied do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspen disse ultrices gravida.</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#mblb-2" aria-expanded="false">
                      Access Your Mobile Wallet
                    </h5>

                    <div id="mblb-2" class="collapse show" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Molestie eu blandit eu sodales, nulla vitae nulla tempor et porta, ante nec commodo. Nulla non fringilla urna dolor vivamus, vulputate eu neque vivamus lacus in, imperdiet id sed malesuada per.</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#mblb-3" aria-expanded="false">
                      Confirm information payover 
                    </h5>

                    <div id="mblb-3" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Blandit eu sodales, nulla vitae nulla tempor et porta, ante nec commodo. Nulla non fringilla urna dolor vivamus, vulputate eu neque vivamus lacus in, imperdiet id sed malesuada per.</p>
                      </div>                    
                    </div>
                  </div>
                </div>
              </div>--}}
              {{--<div id="fee-charges" class="tab-pane fade">
                <div class="accordion" id="accordion3">
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#fc-1" aria-expanded="true">
                      Your Mobile Wallet
                    </h5>
                    <div id="fc-1" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscied do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspen disse ultrices gravida.</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#fc-2" aria-expanded="false">
                      Input Wallet Informations
                    </h5>

                    <div id="fc-2" class="collapse show" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Molestie eu blandit eu sodales, nulla vitae nulla tempor et porta, ante nec commodo. Nulla non fringilla urna dolor vivamus, vulputate eu neque vivamus lacus in, imperdiet id sed malesuada per.</p>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h5 class="collapsed" data-toggle="collapse" data-target="#fc-3" aria-expanded="false">
                      Confirm information and payover 
                    </h5>

                    <div id="fc-3" class="collapse" data-parent="#accordion">
                      <div class="acr-body">
                        <p>Blandit eu sodales, nulla vitae nulla tempor et porta, ante nec commodo. Nulla non fringilla urna dolor vivamus, vulputate eu neque vivamus lacus in, imperdiet id sed malesuada per.</p>
                      </div>                    
                    </div>
                  </div>
                </div>
              </div>--}}
            </div>

          </div>
          
        </div>
      </div>
    </section>
    <!-- Faq section end -->

    <!-- Question section start -->
    <section class="question bg-offwhite">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 m-auto text-center">
            <div class="sec-heading">
              <h2 class="sec-title">Vous avez une Question?</h2>
              <p class="sec-subtitle">Vous ne trouvez pas de reponses a votre préoccupations? pas de soucis a vous faire
                vous pouvez nous contacter afin de recevoir une assistance personnalisée. 
              </p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-filled btn-round"><span class="bh"></span> <span>Posez votre Question</span></a>
          </div>
        </div>
      </div>
    </section>
@endsection
