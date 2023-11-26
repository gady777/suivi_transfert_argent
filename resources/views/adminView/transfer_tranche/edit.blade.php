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
              <li class="breadcrumb-item active">Modifier</li>
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
                <h3 class="card-title">Modifier un transfert par tranche</h3>
              </div>

              <form method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email du client</label>
                    <input readonly name="email" value="{{old('email')??$t->user()->email}}" type="email"
                    class="form-control" id="exampleInputEmail1" 
                    placeholder="Email du client (membre de Transfert Union)">
                    @if ($errors->has('email'))
                      <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                  </div>
                  {{--<div class="form-group">
                    <label for="">Type</label>
                    <select name="type" required class="form-control">
                      <option value="">Choisir une option</option>
                      <option @if( old('type') == 'envoi' ) 'selected' @else {{$t->type == "envoi" ? "selected" : ""}} @endif 
                        value="envoi">ENVOI</option>
                      <option @if( old('type') == 'reception' ) 'selected' @else {{$t->type == "reception" ? "selected" : ""}} @endif value="reception">RECEPTION</option>
                    </select>
                  </div>--}}
                  <div class="form-group">
                    <label for="place">Montant à envoyer</label>
                    <input readonly value="{{old('amount')??$t->amount}}" name="amount" min="10" type="number" 
                      class="form-control"
                    id="place" placeholder="Montant total à envoyer">
                    @error('amount') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Devise d'envoi</label>
                    <select disabled required class="form-control">
                      <option value="">Choisir une devise</option>
                      @foreach( $devises as $d )
                        <option {{ old("devise") == $d->id ? 'selected' : ( $t->devise_id == $d->id ? 'selected' : '' )  }} value="{{$d->id}}">{{$d->abbreviation}}</option>
                      @endforeach
                    </select>
                    <div class="text-muted">De quelle devise le client enverra-t-il l'argent ?</div>
                    <input type="hidden" value="{{$t->devise_id}}" name="devise">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fas fa-edit"></i> 
                  Retour</button>
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
