@extends('public.layout')
@section ('title')
{{ $about->title ?? "Emploi | Transfert d'argent rapide et sécurisé - Canada - Afrique" }}
@endsection

@section('contenu')

<!-- Banner section start -->
<section class="banner v7" style="background: url({{asset($about->image)}}) no-repeat scroll 0 0;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-9">
            <div class="ban-content">
              <h1>{{$about->title ?? ""}}</h1>
              <p>{{$about->description ?? ""}}</p>
              {{--<a href="#" class="btn btn-outline btn-round"><span class="bh"></span> 
                <span>Learn more</span></a>--}}
            </div>
          </div>
          {{--<div class="col-lg-5 col-md-3">
            <a href="https://vimeo.com/191947042" class="video-btn" 
            data-fancybox><i class="fas fa-play"></i></a>
          </div>
        </div>--}}
      </div>
    </section>
    <!-- Banner section end -->

    <!-- About overview section start -->
    <section class="about-overview">
      <div class="container">
        <div class="row">
            <div class="col">
              {!! $about->content??"" !!}
            </div>
        </div>
       
      </div>
    </section>

    @endsection
