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
              <li class="breadcrumb-item active">Tranche - Confirmer réception</li>
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
                <h3 class="card-title">Tranche - Confirmer réception</h3>
              </div>

              <div class="card-body">
              @if (session('error'))
                  <div class="alert alert-error">
                      {{ session('error') }}
                  </div>
              @endif
                <p>
                  Transfert par tranche de {{$t->amount}} {{$t->devise()->abbreviation}} à 
                  {{$t->user()->pseudo}}. Restant: <strong>{{$t->solde}} {{$t->devise()->abbreviation}}</strong>
                </p>
                <p class="d-inline-block">
                  <strong>Confirmer le tranfert </strong> <h4 class="d-inline mx-2 text-danger">{{$ti->id_reception}}</h4>
                </p>
                <form method="post" action="{{route('admin.transfer.tranche.instance.confirm_reception.post',['id'=>$t->id,'instance_id'=>$ti->id])}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="m_message" placeholder="Message...100 caractères au plus" 
                    class="form-control" maxlength="100" rows="3">{{old('m_message')}}</textarea>
                    @error('m_message') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="plac">Date réception</label>
                    <input value="{{old('date')}}" name="date" type="date" 
                      class="form-control"
                      id="plac">
                      @error('date') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> 
                    Confirmer</button>
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
