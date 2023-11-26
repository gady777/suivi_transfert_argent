@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Les frais
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
            <h1 class="m-0 text-dark">Les frais</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.currency.home')}}">Devises</a></li>
              <li class="breadcrumb-item active">Frais</li>
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
                <h3 class="card-title">{{$currency->intitule}} ({{$currency->abbreviation}})</h3>
              </div>

              <form method="post" action="{{route('admin.processing_fee.edit.post',['id'=>$currency->id])}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="f1">Frais de retrait</label>
                    <input name="withdraw_fee" 
                    value="{{old('withdraw_fee') ? old('withdraw_fee') :  ($fee ? $fee->withdraw_fee : '') }}" min="0" 
                    type="number"
                    class="form-control" id="f1" 
                    placeholder="Frais de retrait">
                    @if ($errors->has('withdraw_fee'))
                      <div class="text-danger">{{ $errors->first('withdraw_fee') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="p">Minimum transfert Banque</label>
                    <input value="{{old('minim_bank_account') ? old('minim_bank_account') : ( $fee ? $fee->minim_bank_account : '' ) }}" name="minim_bank_account" 
                    min="1" type="number" class="form-control"
                    id="p" placeholder="Banque">
                    @error('minim_bank_account') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="v">Minimum transfert PayPal</label>
                    <input name="minim_tarnsfert_to_paypal" 
                    value="{{old('minim_tarnsfert_to_paypal') ? old('minim_tarnsfert_to_paypal') : ( $fee ? $fee->minim_tarnsfert_to_paypal : '' ) }}" 
                    type="number"
                    class="form-control" id="v" placeholder="PayPal">
                    @if ($errors->has('minim_tarnsfert_to_paypal'))
                      <div class="text-danger">{{ $errors->first('minim_tarnsfert_to_paypal') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="v">Minimum transfert MoMo</label>
                    <input name="minim_transfert_to_momo" 
                    value="{{old('minim_transfert_to_momo') ? old('minim_transfert_to_momo') : ( $fee ? $fee->minim_transfert_to_momo : '' ) }}" 
                    type="number"
                    class="form-control" id="v" placeholder="Mobile Money">
                    @if ($errors->has('minim_transfert_to_momo'))
                      <div class="text-danger">{{ $errors->first('minim_transfert_to_momo') }}</div>
                    @endif
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> 
                    <i class="fa fa-save"></i> Sauvegarder</button>
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
