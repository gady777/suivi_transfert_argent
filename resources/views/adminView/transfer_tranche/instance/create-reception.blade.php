@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Transfert par tranche
@endsection

@section('body_class','hold-transition sidebar-mini layout-fixed')

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
            <h1 class="m-0 text-dark">Transfert par tranche: réception</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.home')}}">Transfert par tranche</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.detail.envoi',['id'=>$t->id])}}">Les réceptions</a></li>
              <li class="breadcrumb-item active">Ajouter paiement: réception</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ajouter paiement (réception) à un transfert par tranche</h3>
              </div>

              <div class="card-body">
              @if (session('error'))
                  <div class="alert alert-error">
                      {{ session('error') }}
                  </div>
              @endif
                <p>
                  Transfert par tranche de {{$t->amount}} {{$t->devise()->abbreviation}} à 
                  {{$t->user()->pseudo}}, <b>{{$t->amount_cfa}} F CFA</b> <br>
                  Reste à recevoir par le destinataire: <strong>{{$t->solde_reception}} F CFA</strong>
                </p>
                <form method="post" action="{{route('admin.transfer.tranche.instance.new.reception.post',['id'=>$t->id])}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="devise" value="{{$devise->id}}">
                  <div>
                  <div class="form-group">
                      <label for="place">Montant</label>
                      <input value="{{old('amount')}}" name="amount" min="10" type="number" 
                        class="form-control"
                      id="place" placeholder="Montant à payer pour cette tranche en F CFA">
                      @error('amount') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <input type="hidden" name="type" value="reception">
                    <div class="form-group">
                      <label for="v">Méthode</label>
                      <select name="method" required class="form-control">
                        <option value="">Choisir une méthode</option>
                        @foreach( $methods as $d )
                          <option {{ old("method") == $d->id ? 'selected' : ''  }} value="{{$d->id}}">{{$d->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Informations</label>
                    <textarea name="informations" placeholder="Entrez ici les informations de réception" class="form-control">{{old('informations')}}</textarea>
                    @error('informations') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  
                  <div class="form-group">
                    <label for="plac">Date de transaction</label>
                    <input value="{{old('pay_date')}}" name="pay_date" type="datetime-local" 
                      class="form-control"
                      id="plac">
                      @error('pay_date') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> 
                    Ajouter</button>
                  </div>

                </form>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
