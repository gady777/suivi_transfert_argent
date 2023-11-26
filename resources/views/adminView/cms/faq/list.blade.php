@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - CMS-FAQ
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
            <h1 class="m-0 text-dark">FAQ</h1>
          </div>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a class="btn btn-primary" href="{{route('admin.cms.faq.new')}}">Ajouter un élément dans la FAQ</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes questions</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Questions</th>
                      <th>Réponses</th>
                      <th>Créé le</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($faqs as $new)
                      <tr>
                        <td>{{$new->question}}</td>
                        <td>{!! $new->answer !!}</td>
                        <td> {{ date('d-m-Y',strtotime($new->created_at)) }} </td>
                        <td>
                            <a title="Modifier" href="{{route('admin.cms.faq.edit',['id'=>$new->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.cms.faq.delete',['id'=>$new->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucune question</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection

