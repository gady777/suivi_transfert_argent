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
            <h1 class="m-0 text-dark">Transfert par tranche</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.home')}}">Transfert par tranche</a></li>
              <li class="breadcrumb-item active">Ajouter</li>
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
                <h3 class="card-title">Créer un transfert par tranche</h3>
              </div>

              <form method="post" action="@if($transfer) {{route('admin.transfer.tranche.new.post',['id'=>$transfer->id])}} @else {{route('admin.transfer.tranche.new.post')}} @endif">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Client</label>
                    @if($transfer)
                     <input class="form-control" readonly type="text" value="{{$transfer->author()->pseudo}} ( {{$transfer->author()->email}} ) ">
                     <input type="hidden" name="email" value="{{$transfer->author()->email}}">
                     <input type="hidden" name="transfer" value="{{$transfer->id}}">
                    @else   
                      <input name="email" value="{{old('email')}}" type="email"
                      class="form-control" id="exampleInputEmail1" 
                      placeholder="Email du client (membre de Transfert Union)">
                      @if ($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                      @endif
                    @endif
                    
                  </div>
                  <div class="form-group">
                    <label for="place">Montant à envoyer</label>
                    @if($transfer) 
                      <input class="form-control" readonly type="number" name="amount" value="{{$transfer->amount}}">
                    @else  
                    <input value="{{old('amount')}}" name="amount" min="10" type="number" 
                      class="form-control"
                      id="place" placeholder="Montant total à envoyer">
                      @error('amount') <div class="text-danger"> {{ $message }} </div> @enderror
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="v">Devise d'envoi</label>
                    @if($transfer)  
                    <select disabled class="form-control readonly">
                      <option value="{{$transfer->countryFrom()->devise()->id}}" selected>
                      {{$transfer->countryFrom()->devise()->abbreviation}}
                      </option>
                    </select>
                    <input type="hidden" name="devise" value="{{$transfer->countryFrom()->devise()->id}}">
                    @else    
                    <select name="devise" required class="form-control">
                      <option value="">Choisir une devise</option>
                      @foreach( $devises as $d )
                        <option {{ old("devise") == $d->id ? 'selected' : ''  }} value="{{$d->id}}">{{$d->abbreviation}}</option>
                      @endforeach
                    </select>
                    @endif
                    <div class="text-muted">De quelle devise le client enverra-t-il l'argent ?</div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> 
                  Créer</button>
                </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection
