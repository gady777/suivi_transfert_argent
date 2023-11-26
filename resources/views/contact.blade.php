@extends('public.layout')
@section ('title')
Nous contactez | Transfert d'argent rapide et sécurisé - Canada - Afrique
@endsection

@section('contenu')
 <!-- Banner section start -->
 <section class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-8 m-auto">
            <div class="ban-content text-center">
              <h1>Coordonnées</h1>
              <p>Nous nous ferons un plaisir de répondre à toutes les questions que vous pourriez avoir.</p>
              {{--<a href="https://vimeo.com/191947042" class="video-btn" data-fancybox>
                <i class="fas fa-play"></i></a>
              <span class="simple-txt">Call to Helpline</span>--}}
            </div>
          </div>        
        </div>
      </div>
    </section>
    <!-- Banner section end -->

    <!-- Contact section start -->
    <section class="contact">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7 nopadd-rth">
            <div class="contact-from-wrap">
              <div class="sec-heading">
                <h2 class="sec-title">Formulaire de contact</h2>
                <p class="sec-subtitle">Veuillez noter que si vous avez des questions concernant une transaction en cours, 
                la solution la plus rapide pour obtenir de l'aide est de nous écrire via le formulaire ci-dessous. </p>
              </div>
              <form method="post" action="{{route('contact.post')}}" class="contact-form clearfix">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group row align-items-end">
                  <div class="col-sm-6 mb-4 mb-sm-0">
                    <label>Votre identité *</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control"
                     placeholder="Nom">
                     @error('name')
                      <div class="text-danger">{{$message}}</div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="text" value="{{old('fname')}}" name="fname" 
                    class="form-control" placeholder="Prénom *">
                    @error('fname')
                      <div class="text-danger">{{$message}}</div>
                     @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label>Adresse email *</label>
                  <input type="email" value="{{old('email')}}" name="email" 
                  class="form-control" 
                  placeholder="Email">
                  @error('email')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Votre message *</label>
                  <textarea rows="5" class="form-control" placeholder="Message" name="message">{{old('message')}}</textarea>
                  @error('message')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-filled btn-round">
                  <span class="bh"></span> <span>Envoyer</span></button>
              </form>
            </div>
          </div>
          <div class="col-md-5 nopadd-ltf">
            <div class="contact-info-wrap">
              <address>
                <i class="fas fa-envelope"></i>
                <span>Adresse email</span>
                <a href="mailto:transfert@transfertunion.com">transfert@transfertunion.com</a>
                <a href="mailto:support@transfertunion.com<">support@transfertunion.com</a>
                <a href="mailto:direction@transfertunion.com">direction@transfertunion.com</a>
                
              </address>
              <address>
                <i class="fas fa-phone-alt"></i>
                <span>Téléphone</span>
                <a href="tel:{{config('info.app_telephone')}}">{{config('info.app_telephone')}}</a>
                <a href="tel:{{config('info.app_telephone2')}}">{{config('info.app_telephone2')}}</a>
              </address>
              <address>
                <i class="fas fa-map-marker-alt"></i>
                <span>Bureau</span>
                7-1244 Boulevrd Rolland,Montreal,<br> Québec, H1G 6C5, Canada 
              </address>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact section end -->

    <!-- Contact Media start -->
   {{-- <section class="contact-media bg-offwhite">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 m-auto text-center">
            <div class="sec-heading">
              <h2 class="sec-title">Connect With Our Social Medias</h2>
              <p class="sec-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut abore.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2 col-sm-4 col-6">
            <a href="#" class="cm-box">
              <i class="fab fa-facebook-f"></i>
              Facebook
            </a>
          </div>
          <div class="col-lg-2 col-sm-4 col-6">
            <a href="#" class="cm-box">
              <i class="fab fa-twitter"></i>
              Twitter
            </a>
          </div>
          <div class="col-lg-2 col-sm-4 col-6">
            <a href="#" class="cm-box">
              <i class="fab fa-instagram"></i>
              Instagram
            </a>
          </div>
          <div class="col-lg-2 col-sm-4 col-6">
            <a href="#" class="cm-box">
              <i class="fab fa-vimeo-v"></i>
              Vimeo
            </a>
          </div>
          <div class="col-lg-2 col-sm-4 col-6">
            <a href="#" class="cm-box">
              <i class="fab fa-youtube"></i>
              Youtube
            </a>
          </div>
          <div class="col-lg-2 col-sm-4 col-6">
            <a href="#" class="cm-box">
              <i class="fab fa-linkedin"></i>
              Linkedin
            </a>
          </div>
        </div>
      </div>
    </section>--}}
@endsection
