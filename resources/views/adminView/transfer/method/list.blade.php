@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Méthodes de transfert
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
            <h1 class="m-0 text-dark">Méthodes de transfert</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Méthodes de transfert</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            {{--<a class="btn btn-primary" href="{{route('admin.transfer.method.new')}}">Ajouter
              une méthode</a>--}}
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes les méthodes</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Frais</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ms as $c)
                      <tr>
                        <td>{{$c->name}}</td>
                        <td>{{$c->fee}} %</td>
                        <td class="text-center">
                            <a title="Modifier" href="{{route('admin.transfer.method.edit',['id'=>$c->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                            {{--<form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.transfer.method.delete',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> 
                            </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>--}}
                        </td>
                      </tr>
                    @empty
                    <tr> <td class="text-center" colspan="3">Aucune donnée</td> </tr>
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
