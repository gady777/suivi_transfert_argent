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
            <a class="btn btn-primary" href="{{route('admin.cms.create')}}">Ajouter
              une page</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes les pages</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Slug</th>
                      <th>Titre</th>
                      <th>Description</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($pages as $p)
                      <tr>
                        <td>{{$p->name}}</td>
                        <td>{{$p->slug}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->description}} </td>
                        <td>
                            <a title="Modifier" href="{{route('admin.cms.edit',['id'=>$p->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.cms.delete',['id'=>$p->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <a title="Voir" 
                            href="{{route('admin.cms.show',['id'=>$p->id])}}"
                              class="m-1 btn btn-dark"> <i class="fas fa-eye"></i> </a>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucune page</td>
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
