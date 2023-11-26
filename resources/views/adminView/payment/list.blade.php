@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Payement
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
            <h1 class="m-0 text-dark">Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Paiements</li>
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
                <h3 class="card-title">Tous les paiements</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Auteur</th>
                      <th>Message</th>
                      <th>Statut</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($payments as $c)
                      <tr>
                        <td>{{date('d M Y',strtotime($c->created_at))}}</td>
                        <td>
                            <a href="{{route('admin.user.profile',['id'=>$c->user()->id])}}" title="Profil">
                              @if($c->user()->type_compte == 2)
                               {{$c->user()->pseudo}}
                              @else   
                               {{$c->user()->nameSociete}}
                              @endif
                            </a>
                        </td>
                        <td>{{$c->message}}</td>
                        <td> 
                          @if($c->confirm)
                            <span class="badge badge-success badge-pill">Confirmé</span>
                          @else 
                            @if($c->reject)
                              <span class="badge badge-danger badge-pill">Rejeté</span>,
                              {{$c->raison}}, <span class="badge">{{date('d M Y',strtotime($c->reject_at))}}</span>
                            @else   
                              <span class="badge badge-warning badge-pill">En attente...</span>
                            @endif
                          @endif
                        </td>
                        <td><a title="Détail" 
                            href="{{route('admin.payment.show',['id'=>$c->id])}}"
                              class="m-1 btn btn-dark"> <i class="fas fa-eye"></i> </a>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucun payment</td>
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
