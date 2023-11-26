@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - News
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
            <h1 class="m-0 text-dark">Accueil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Accueil</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$users_number}}</h3>

                <p>Utilisateurs actifs</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              {{--<a href="{{route('admin.user.home')}}" class="small-box-footer">Liste
                <i class="fas fa-arrow-circle-right"></i></a>--}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$deposits}}</h3>

                <p>Transfert</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              {{--<a href="{{route('admin.user.home')}}" class="small-box-footer">Voir
                <i class="fas fa-arrow-circle-right"></i></a>--}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$devises}}</h3>

                <p>Devises</p>
              </div>
              <div class="icon">
                <i class="ion ion-money"></i>
              </div>
              {{--<a href="{{route('admin.news.home')}}" class="small-box-footer">Tout voir
                <i class="fas fa-arrow-circle-right"></i></a>--}}
            </div>
          </div>
        </div>

        <div>

        <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"> <strong>TRANSFERTS RECENTS</strong> </h3>
              </div>
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      {{--<th>Date</th>--}}
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
                        {{--<td>{{date("d-m-Y",strtotime($c->created_at))}}</td>--}}
                        <td>
                          <a title="Détail" href="{{route('admin.transfer.detail',['id'=>$c->id])}}">
                            {{$c->id_transaction}}
                          </a>
                        </td>
                        <td>{{ $c->author()->pseudo }}</td>
                        <td>{{$c->recipient()->name}} {{$c->recipient()->fname}}</td>
                        <td>
                          {{number_format($c->amount,2,'.',' ')}} {{$c->countryFrom()->devise()->abbreviation ?? ''}}</td>
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
                              class="btn btn-primary m-1"> <i class="fas fa-list"></i> </a>
                              @else  
                              <a href="{{route('admin.transfer.tranche.new',['id'=>$c->id])}}" 
                              class="btn btn-warning m-1"> <i class="fas fa-random"></i> </a>
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
                                class="btn btn-primary m-1"> <i class="fas fa-list"></i> </a>
                              @endif
                            @else
                              @if($c->statut == "waiting_validation")
                              <a href="{{route('admin.transfer.tranche.new',['id'=>$c->id])}}" 
                                class="btn btn-warning m-1"> <i class="fas fa-random"></i> </a>
                                
                              @endif
                              <a href="{{route('admin.transfer.reject',['id'=>$c->id])}}" class="btn btn-danger" title="Rejeter la demande"><i class="fas fa-trash"></i></a>
                            @endif
                          @else
                           @if($c->has_tranche)  
                             <a href="{{route('admin.transfer.tranche.detail',['id'=>$c->tranche_id])}}" 
                                class="btn btn-primary m-1"> <i class="fas fa-list"></i> </a>
                           @endif
                           <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.archive.transfer.operate',['id'=>$c->id])}}" method="post">
                              <button title="Mettre dans les archives" type="submit" class="m-1 btn btn-default"> <i class="fas fa-backspace"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                          @endif
                          <a class="btn btn-dark m-1" title="Détail" 
                          href="{{route('admin.transfer.detail',['id'=>$c->id])}}"> 
                          <i class="fas fa-eye"></i> </a>
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
              {{--<div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Auteur</th>
                      <th>Opération</th>
                      <th>Montant</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                      <td>{{$tr->receiver()->pseudo}}</td>
                      <td>{!! $tr->content !!}</td>
                      <td>{{$tr->amount}}  
                        @if( $tr->countryFrom() )
                          {{$tr->countryFrom()->devise()->abbreviation}}
                        @else  
                          {{$tr->devise()->abbreviation}}
                        @endif
                      </td>
                      <td>{{date('d-m-Y H:i',strtotime($tr->created_at))}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              --}}
        </div>
      </div>

      </div>
    </section>

  </div>
</div>
@endsection
