@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - News - Nouvelle
@endsection

@section('body_class','hold-transition sidebar-mini layout-fixed')

@section('layout_content')
<div class="wrapper">
  @include ("adminView.layout.top")
  @include ("adminView.layout.aside_left")
  <div class="content-wrapper">
    @include('flash::message')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Actualités</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.news.home')}}">Actualités</a></li>
              <li class="breadcrumb-item active">Détail</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Détail actualité</h3>
              </div>
              <div class="card-body">
                <div>
                  <img src="{{asset($news->image)}}" alt="Image" style="width:100%;height:auto;">
                  <h4>{{$news->title}}</h4>
                  <div class="text-muted">
                    Créé le {{$news->created_at}}, dernière modification: {{$news->updated_at}}
                  </div>
                  <div class="">
                    {{$news->description}}
                  </div>
                  <div class="">
                    {!! $news->content !!}
                  </div>
                  <div class="">
                    <strong>Mots clés</strong>: {{$news->keywords}}
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
