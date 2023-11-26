@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - CMS
@endsection

@section('body_class','hold-transition sidebar-mini')

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
            <h1 class="m-0 text-dark">CMS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">CMS</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a class="btn btn-primary" href="{{route('admin.cms.edit')}}">Modifier les informations</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes les options</h3>
              </div>
              <div class="card-body">
                <div class="list-group">
                  <div class="list-group-item">
                    <strong>Adresse email du site:</strong><br> {{$cms->email ?? "NON renseigné"}}
                  </div>
                  <div class="list-group-item">
                    <strong>Texte de bienvenu</strong>: <br>
                    {{$cms->welcome_text ?? "NON renseigné"}}
                  </div>
                  <div class="list-group-item">
                    <strong>Logo</strong> <br>
                    @if($cms->logo)
                    <img class="img-fluid" src="{{asset($cms->logo)}}" alt="Logo">
                    @else  
                    NON renseigné
                    @endif
                  </div>
                  <div class="list-group-item">
                    <strong>Image bannière</strong>: <br>
                    @if($cms->image_baniere)
                    <img class="img-fluid" src="{{asset($cms->image_baniere)}}" alt="Image bannière">
                    @else  
                    NON renseigné
                    @endif
                  </div>
                  <div class="list-group-item">
                    <strong>A propos de nous</strong>: <br>
                    {!! $cms->about_us ?? "NON renseigné" !!}
                  </div>
                  <div class="list-group-item">
                    <strong>Politique de confidentialité</strong>: <br>
                    {!! $cms->privacy ?? "NON renseigné" !!}
                  </div>
                  <div class="list-group-item">
                    <strong>Conditions d'utilisation</strong>: <br>
                    {!! $cms->terms ?? "NON renseigné" !!}
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
