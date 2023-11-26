@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Archive Tranfert par tranche
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
            <h1 class="m-0 text-dark">Archive | Tranfert par tranche</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Archive | Tranfert par tranche</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
      {{--<div class="row">
          <div class="col">
            <a class="btn btn-primary
            " href="{{route('admin.transfer.tranche.new')}}">Créer
              un transfert par tranche</a>
          </div>
        </div> <br>--}}
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Archive | Tranfert par tranche</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id trans</th>
                      <th>Client</th>
                      <th>Montant</th>
                      <th>Devise</th>
                      <th>Solde</th>
                      <th>Statut</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ts as $t)
                      <tr>
                        <td>
                          @if($t->transfer_id)  
                          <a title="Détail" href="{{route('admin.transfer.detail',['id'=>$t->transfer_id])}}">
                            {{$t->id_transaction}}
                          </a>
                          @else  
                          <a title="Détail" href="{{route('admin.transfer.tranche.detail',['id'=>$t->id])}}"> 
                          {{$t->id_transaction}} </a>
                          @endif
                        </td>
                        <td>{{$t->user()->pseudo }}</td>
                        <td>
                          {{number_format($t->amount,2,'.',' ')}}</td>
                        </td>
                        <td> {{$t->devise()->abbreviation}}</td>
                        <td>{{number_format($t->solde,2,'.',' ')}}</td>
                        <td> 
                            @if($t->complete)
                                <span class="badge badge-success">Complète</span>
                            @else  
                                <span class="badge badge-warning">En cours</span>
                            @endif
                        </td>
                        <td>
                          <form class="d-inline" 
                            onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                              action="{{route('admin.transfer.tranche.delete',['id'=>$t->id])}}" 
                              method="post">
                                <button type="submit" title="Supprimer" 
                                class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                          <a class="btn btn-dark m-1" title="Détail" href="{{route('admin.transfer.tranche.detail',['id'=>$t->id])}}"> 
                            <i class="fas fa-eye"></i> </a>
                            <a class="btn btn-info m-1" title="Modifier" href="{{route('admin.transfer.tranche.edit',['id'=>$t->id])}}"> 
                            <i class="fas fa-edit"></i> </a>
                            @if($t->complete == false)  
                              <a href="{{route('admin.transfer.tranche.instance.new',['id'=>$t->id])}}" title="Nouveau payement pour ce transfert" class="btn btn-success m-1">
                              <i class="fas fa-file-invoice-dollar"></i>
                              </a>
                            @endif
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.archive.transfer.tranche.operate',['id'=>$t->id])}}" method="post">
                              <button title="Supprimer des archives" type="submit" class="m-1 btn btn-danger"> <i class="fas fa-backspace"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
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
