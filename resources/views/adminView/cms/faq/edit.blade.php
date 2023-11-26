@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - CMS - FAQ - edit
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
            <h1 class="m-0 text-dark">FAQ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">FAQ</li>
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
                <h3 class="card-title">Modifier Question</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="int">Question</label>
                    <input name="question" value="{{old('question') ? old('question') : $faq->question}}"
                    maxlength="255" type="text" class="form-control" id="int">
                    @if ($errors->has('question'))
                      <div class="text-danger">{{ $errors->first('intiquestiontule') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="desc">Réponse</label>
                    <textarea class="form-control" name="answer" rows="8"  id="desc" 
                    placeholder="Ajoutez la réponse">{{old('answer') ? old('answer') : $faq->answer}}</textarea>
                    @error('answer') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-edit"></i> Modifier la devise</button>
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
    CKEDITOR.replace('answer');
</script>
@endsection