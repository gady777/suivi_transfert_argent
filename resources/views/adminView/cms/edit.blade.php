@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - CMS - Modifier page
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
            <h1 class="m-0 text-dark">Modifier page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.cms.home')}}">CMS</a></li>
              <li class="breadcrumb-item active">Modifier</li>
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
                <h3 class="card-title">Modifier page</h3>
              </div>
              @php $page = $cms ; @endphp
              <form method="post" action="{{route('admin.cms.edit.post',['id'=>$page->id])}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nom</label>
                    <input name="name" value="{{old('name')??$page->name}}" maxlength="50" type="text"
                    class="form-control" id="exampleInputEmail1" placeholder="Nom de la page">
                    @if ($errors->has('name'))
                      <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="place">Slug</label>
                    <input value="{{old('slug')??$page->slug}}" name="slug" maxlength="100" type="text" class="form-control"
                    id="place" placeholder="Slug">
                    @error('slug') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Titre</label>
                    <input name="title" value="{{old('title')??$page->title}}" type="text"
                    class="form-control" id="v" placeholder="Titre">
                    @if ($errors->has('title'))
                      <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" rows="5" 
                    class="form-control">{{old('description')??$page->description}}</textarea>
                    @if ($errors->has('description'))
                      <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="vi">Choisir une autre image</label>
                    <input name="image" type="file"
                    class="form-control" id="vi">
                    @if ($errors->has('image'))
                      <div class="text-danger">{{ $errors->first('image') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ct">Contenu</label>
                    <textarea class="form-control" name="content" id="ct"
                    placeholder="Contenu de la page">{{old('content')??$page->content}}</textarea>
                    @error('content') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-edit"></i> Modifier</button>
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