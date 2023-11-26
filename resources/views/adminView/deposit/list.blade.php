@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Dépôt d'argent
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
            <h1 class="m-0 text-dark">Dépôt d'argent</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Dépôt d'argent</li>
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
                <h3 class="card-title">Tous les dépôts d'argent</h3>
              </div>
              <div class="card-body">
                {{--<p>
                  <strong> <span class="badge badge-danger">NB</span>: Lorsque vous validez la demande de dépôt d'un utilisateur,
                le compte {{config('info.app_name')}} de ce dernier est crédité du montant de la demande.</strong>
                </p> <br>--}}
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Demandeur</th>
                      <th>Montant</th>
                      <th>Méthode</th>
                      <th>Statut</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ds as $c)
                      <tr>
                        <td>{{date("d-m-Y",strtotime($c->created_at))}}</td>
                        <td>{{ $c->author()->pseudo }}</td>
                        <td>
                          {{$c->amount}} {{$c->currency()->symbole ?? ''}} {{$c->currency()->abbreviation ?? ''}}</td>
                        <td>
                          @if( $c->method  == 'bank')  
                            Virement Bancaire  
                          @elseif ($c->method  == 'cash') 
                            Cash money
                          @elseif($c->method  == 'mobile')
                            Mobile money
                          @elseif($c->method  == 'interact')  
                            Interact
                          @endif
                        </td>
                        <td> 
                            @if($c->reject)
                                <span class="text-danger"> <i class="fas fa-close"></i> Rejeté</span>, 
                                {{$c->reject_raison}}, le {{ date('d-m-Y H:i', strtotime($c->reject_at)) }}
                            @else  
                                @if($c->statut == 'pending')   
                                    <span class="badge badge-warning">En attente...</span>
                                @elseif($c->statut == 'waiting_validation')
                                    <span class="badge badge-info">En cours...</span>
                                @else  
                                    <span class="badge badge-success">Confirmé!</span>
                                @endif
                            @endif
                        </td>
                        <td>
                          @if($c->statut != "valid" and $c->reject == false)
                            @if( $c->statut != "waiting_validation" )
                            <form class="d-inline" 
                            onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                              action="{{route('admin.deposit.inprogress',['id'=>$c->id])}}" 
                              method="post">
                                <button type="submit" title="Marquer en cours de traitement" 
                                class="m-1 btn btn-info"> <i class="fas fa-spinner"></i> </button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            @endif
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.deposit.confirm',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-success"> <i class="fas fa-check"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <a href="{{route('admin.deposit.reject',['id'=>$c->id])}}" class="btn btn-danger" title="Rejeter la demande"><i class="fas fa-trash"></i></a>
                          @else 
                          @endif
                          <a class="btn btn-dark m-1" title="Détail" href="{{route('admin.deposit.detail',['id'=>$c->id])}}"> <i class="fas fa-eye"></i> </a>
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
