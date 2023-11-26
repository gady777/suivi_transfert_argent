@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Données de réceptions - Modifier
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
            <h1 class="m-0 text-dark">Données de réceptions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.receive_pay_method.home')}}">Devises</a></li>
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
                <h3 class="card-title">Modifier une méthode</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  
                  <div class="form-group">
                        <label class="title"> Choisir une méthode</label>
                        <select name="method" id="method" class="form-control">
                            <option value="">Choisir</option>
                            @foreach ($methods as $method)
                            <option @if(old('method')) {{ old('method') == $method->slug ? 'selected' : ''}}  @else {{ $r->method()->slug == $method->slug ? 'selected' : '' }}  @endif value="{{$method->slug}}">{{$method->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @include ("adminView.receive_pay_method._method_edit")
                    </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> 
                    <i class="fa fa-plus"></i> Sauvegarder</button>
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
jQuery(function($){ 

$('#method').change(function(){
    toggleMethView();
})
toggleMethView();
//
function toggleMethView(){
    var meth = $('#method').val();
    if(!meth){
        return;
    }
    $('div[class*=meth-]').each(function(){
        if($(this).hasClass('meth-'+meth)){
            $(this).show();
            $(this).find('input,textarea').attr('required',true);
        }else{
            $(this).hide();
            $(this).find('input,textarea').removeAttr('required');
        }
    });
}

});
</script>
@endsection