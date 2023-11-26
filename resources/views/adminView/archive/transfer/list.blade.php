@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Archive Tranfert d'argent
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
            <h1 class="m-0 text-dark">Archive | Tranfert d'argent</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Archive | Tranfert d'argent</li>
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
                <h3 class="card-title">Archive | Transferts d'argent</h3>
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
                      <th>Id trans</th>
                      <th>Expéditeur</th>
                      <th>Bénéficiaire</th>
                      <th>Montant</th>
                      <th>Méthode</th>
                      <th>Statut</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ds as $c)
                      <tr>
                        <td>{{date("d-m-Y",strtotime($c->created_at))}} {{config('app.timezone')}}</td>
                        <td>
                          <a title="Détail" href="{{route('admin.transfer.detail',['id'=>$c->id])}}">
                            {{$c->id_transaction}}
                          </a>
                        </td>
                        <td>{{ $c->author()->pseudo }}</td>
                        <td>{{$c->recipient()->name}} {{$c->recipient()->fname}}</td>
                        <td>
                          {{number_format($c->amount,2,"."," ")}} {{$c->countryFrom()->devise()->abbreviation ?? ''}}</td>
                        </td>
                        <td>{{$c->method()->name}}</td>
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
                                action="{{route('admin.transfer.inprogress',['id'=>$c->id])}}" 
                                method="post">
                                  <button type="submit" title="Marquer en cours de traitement" 
                                  class="m-1 btn btn-info"> <i class="fas fa-spinner"></i> </button>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              </form>
                              @if($c->has_tranche)  
                              <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                              class="btn btn-primary mx-1"> <i class="fas fa-list"></i> </a>
                              @else  
                              <a href="{{route('admin.transfer.tranche.new',['id'=>$c->id])}}" 
                              class="btn btn-warning mx-1"> <i class="fas fa-random"></i> </a>
                              @endif
                            @endif
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.transfer.confirm',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-success"> <i class="fas fa-check"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            @if($c->has_tranche)  
                            @if($c->statut =="waiting_validation")
                                <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                                class="btn btn-primary mx-1"> <i class="fas fa-list"></i> </a>
                                @endif
                            @else
                            <a href="{{route('admin.transfer.reject',['id'=>$c->id])}}" class="btn btn-danger" title="Rejeter la demande"><i class="fas fa-trash"></i></a>
                            @endif
                          @else
                           @if($c->has_tranche)  
                             <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                                class="btn btn-primary mx-1"> <i class="fas fa-list"></i> </a>
                           @endif
                          @endif
                          <a class="btn btn-dark m-1" title="Détail" href="{{route('admin.transfer.detail',['id'=>$c->id])}}"> <i class="fas fa-eye"></i> </a>
                          <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.archive.transfer.operate',['id'=>$c->id])}}" method="post">
                              <button title="Supprimer des archives" type="submit" class="m-1 btn btn-danger"> <i class="fas fa-backspace"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">
                        Aucun transfer archivé.
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
