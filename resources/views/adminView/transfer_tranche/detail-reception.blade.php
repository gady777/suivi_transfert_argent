@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Tranfert par tranche
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
            <h1 class="m-0 text-dark">Tranfert par tranche : réceptions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.home')}}">Transferts par tranche</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.detail',['id'=>$t->id])}}">Détail</a></li>
              <li class="breadcrumb-item active">Réceptions</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col">
            @if ( $t->complete == false )
            <a class="btn btn-primary m-1" href="{{route('admin.transfer.tranche.instance.new',['id'=>$t->id])}}">
              <i class="fas fa-plus"></i> Nouvelle réception
            </a>
            @endif
            <a class="btn btn-outline-dark m-1" href="{{route('admin.transfer.tranche.detail',['id'=>$t->id])}}"> <i class="fas fa-arrow-left"></i> Retour</a>
            <p> <br>
                Transfert par tranche de <strong>{{number_format($t->amount,2,'.',' ')}} {{$t->devise()->abbreviation}}</strong> à 
                  <strong>{{$t->user()->pseudo}} ({{$t->user()->email}})</strong> .
            </p>
          </div>
        </div> <br>
        
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> 
                  <span class="font-weight-bolder">Toutes les réceptions</span> <br>
                  Reste: <strong>{{number_format($t->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}</strong>
                </h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id trans</th>
                      <th>Id paiement</th>
                      <th>Date</th>
                      <th>Méthode</th>
                      <th>Montant</th>
                      <th>Montant pay</th>
                      <th>Devise pay</th>
                      <th>Solde</th>
                      {{--<th>Action</th>--}}
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ts as $p)
                      <tr>
                        <td>
                          @if($t->transfer_id) 
                          <a title="Détail" href="{{route('admin.transfer.detail',['id'=>$t->transfer_id])}}">
                            {{$t->id_transaction}}
                          </a>
                          @else  
                            {{$t->id_transaction}}
                          @endif
                        </td>
                        <td>{{$p->id_reception }}</td>
                        <td>{{date('d-m-Y',strtotime($p->pay_date))}}</td>
                        <td>{{$p->method()->name}}</td>
                        <td>{{number_format($p->amount,2,'.',' ')}} {{$t->devise()->abbreviation}} </td>
                        <td>{{$p->receive_amount}} {{$p->devise()->abbreviation}}</td>
                        <td>{{$p->devise()->abbreviation}}</td>
                        <td>{{number_format($p->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}</td>
                        {{--<td>
                          <a href="{{route('admin.transfer.tranche.instance.detail',['id'=>$t->id,'instance_id'=>$p->id])}}" title="Détail" class="m-1 btn btn-sm btn-dark"> <i class="fas fa-eye"></i> </a>
                          @if($p->valid == false) 
                            <a href="{{route('admin.transfer.tranche.instance.confirm_reception',['id'=>$t->id,'instance_id'=>$p->id])}}" 
                            title="Confirmez la réception" class="m-1 btn btn-sm btn-success"> <i class="fas fa-check"></i> </a>
                          @endif 
                        </td>--}}
                      </tr>
                    @empty
                    <tr>
                      <td colspan="12" class="text-center text-danger">
                        Aucun paiement.
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
