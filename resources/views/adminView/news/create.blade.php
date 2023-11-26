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
              <li class="breadcrumb-item"><a href="{{route('admin.news.home')}}">Evènements</a></li>
              <li class="breadcrumb-item active">Ajouter</li>
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
                <h3 class="card-title">Créer une nouvelle actualité</h3>
              </div>

              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Titre</label>
                    <input name="title" value="{{old('title')}}" maxlength="100" type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer un titre">
                    @if ($errors->has('title'))
                      <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea maxlength="200" class="form-control" name="description" rows="8"  id="desc" placeholder="Ajoutez une description">{{old('description')}}</textarea>
                    @error('description') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="place">Mots clés</label>
                    <input value="{{old('keywords')}}" name="keywords" maxlength="100" type="text" class="form-control"
                    id="place" placeholder="Les mots clés séparés par des virgules (,)">
                    @error('keywords') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>

                  <div class="form-group">
                    <label for="desc">Contenu</label>
                    <textarea class="form-control" name="content" rows="15"  id="desc" placeholder="Ecrivez le contenu de l'article">{{old('content')}}</textarea>
                    @error('content') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Choisir un fichier</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choisir une image</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Télécharger</span>
                      </div>
                    </div>
                    @error('image') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Créer</button>
                </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
@section('add_js')
<script>
    CKEDITOR.replace( 'content' );
</script>
@endsection
