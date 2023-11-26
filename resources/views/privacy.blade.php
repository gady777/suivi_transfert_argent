@extends('public.layout')
@section ('title')
  {{$privacy->title ?? 'Politique de confidentialité'}}
@endsection

@section('contenu')
<section class="banner v7" style="background: url({{asset($privacy->image)}}) no-repeat scroll 0 0;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 col-md-9">
            <div class="ban-content">
              <h1>Politique de confidentialité</h1>
            </div>
          </div>
        </div>
      </div>
</section>
    <!-- Banner section end -->

    <!-- About overview section start -->
    <section class="about-overview">
      <div class="container">
        <div class="row">
          <div class="col">
          <h2>{{$cms->title??'Politique de confidentialité de Transfert Union'}}</h2>
            <div style="text-align: justify;">
              {!! $privacy->content ?? '' !!}
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
