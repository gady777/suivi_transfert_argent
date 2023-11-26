@extends('public.layout')
@section ('title')
  {{$terms->title?? 'Mentions légales'}}
@endsection

@section('contenu')
<!-- Banner section start -->
<section class="banner v7" style="background: url({{asset($terms->image)}}) no-repeat scroll 0 0;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 col-md-9">
            <div class="ban-content">
              <h1>{{$terms->title?? 'Mentions légales'}}</h1>
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
            <h2>{{$terms->title?? 'Mentions légales'}}</h2>
            <div style="text-align: justify;">
              {!! $terms->content??'' !!}
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About overview section end -->
@endsection
