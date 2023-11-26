@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Demande de retrait
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
            <h1 class="m-0 text-dark">Demandes de retrait</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Demande de retrait</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            {{--<a class="btn btn-primary" href="{{route('admin.currency.new')}}">Ajouter
              une devise</a>--}}
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Toutes les demandes de retrait</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Demandeur</th>
                      <th>Montant</th>
                      <th>Date</th>
                      <th>Statut</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($demandes as $c)
                      <tr>
                        <td>{{ $c->author()->type_compte == 2 ? $c->author()->pseudo : $c->author()->nameSociete }}</td>
                        <td>{{$c->amount}}</td>
                        <td>{{date("d M Y",strtotime($c->created_at))}}</td>
                        <td> 
                          @if($c->statut) 
                          <span class="badge badge-success badge-pill">Validé</span> le 
                          {{date("d M Y",strtotime($c->datePay))}}
                          @else  
                           @if($c->reject)
                           <span class="badge badge-danger badge-pill">Rejeté</span>,
                           {{$c->reject_raison}}, 
                           <span class="badge">{{date("d M Y",strtotime($c->reject_at))}}</span>
                           @else 
                           <span class="badge badge-warning badge-pill">En attente</span>
                           @endif
                          @endif  
                        </td>
                        <td>
                          @if($c->statut == false and $c->reject == false)
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.withdraw.confirm',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-primary"> <i class="fas fa-check"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <a href="{{route('admin.withdraw.reject',['id'=>$c->id])}}" class="btn btn-danger" 
                            title="Rejeter la demande"><i class="fas fa-trash"></i></a>
                          @else 
                          /
                          @endif
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">
                        Aucune demande.
                      </td>
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
