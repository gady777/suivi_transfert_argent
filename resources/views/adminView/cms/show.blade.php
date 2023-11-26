@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - CMS - SHOW
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
            <h1 class="m-0 text-dark">PAGE</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.cms.home')}}">Transfert</a></li>
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
                <h3 class="card-title">Détail page</h3>
              </div>
              @php $page = $cms ; @endphp
              <div class="card-body">
                <p> <strong>Nom:</strong> {{$page->name}}</p>
                <p> <strong>Slug:</strong> {{$page->slug}}</p>
                <p> <strong>Titre:</strong> {{$page->title}}</p>
                <p> <strong>Description:</strong> {{$page->description}}</p>
                <p> <strong>Image:</strong> 
                  <img src="{{asset($page->image)}}" class="img-fluid" alt="Image">
                </p>
                <div>
                  {!! $page->content !!}
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a class="btn btn-info" href="{{route('admin.cms.edit',['id'=>$page->id])}}"> <i class="fas fa-edit"></i> Modifier</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
