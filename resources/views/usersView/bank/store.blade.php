@extends('layout_dash.template')
@section('contenu')

<h2 class="admin-heading">Enregistrer vos diverses cartes bancaires ici <a href="{{ route('u.bank.add') }}" class="order-card"> <i
            class="fas fa-plus"></i> Ajouter une carte</a></h2>
<!-- Credit or Debit Cards  -->
<div class="infoItems bg-offwhite  shadow">
    <div class="row">
        <div class="col-12">
            <h3>Mes cartes bancaires</h3>
        </div>
        @if (Session::get('msg-update'))
        <div class="alert alert-success">
            Modification bien apportée à  la carte
        </div>
        @endif


        @foreach ($cards as $item)
        <div class="col-12 col-sm-6 col-lg-4 cardBox">
            <div class="account-card account-card-primary">
                <p class="pirotry text-right">Active</p>
                <div class="row">
                    <p class="card-number col-12">{{$item->numberCard}}</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="valid-card">Expire </p> <br>
                        <p class="expare ">{{ date('m-y', strtotime( $item->dateExp)) }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="card-holder-name">{{$item->nameCard}}</p>
                        <p class="text-success">Approuvé</p>
                    </div>
                    <div class="col-6">
                        @switch($item->provider)
                            @case(1)
                                <img class="ml-auto" src="{{asset('dashboard/images/visa.png')}}" alt="visa" title="">
                                @break
                          @case(2)
                              <img class="ml-auto" src="{{asset('dashboard/images/mastercard.png')}}" alt="visa" title="">
                              @break
                          @case(3)
                              <img class="ml-auto" src="{{asset('dashboard/images/american-express.png')}}" alt="visa" title="">
                              @break
                         @case(4)
                              <img class="ml-auto" src="{{asset('dashboard/images/discover.png')}}" alt="visa" title="">
                              @break
                            @default
                        @endswitch
                    </div>
                </div>
                <div class="account-card-overlay">
                    <a href="{{ route('u.bank.edit',$item->id) }}"  class=" btn-link "> <span class="mr-1"><i class="fas fa-edit"></i></span>Modifier</a>

                        <a href="{{ route('u.bank.delete',$item->id) }}" class="text-light btn-link mx-2">
                        <span class="mr-1"><i
                                class="fas fa-minus-circle"></i></span>Effacer</a>
                </div>
            </div>
        </div>
        @endforeach


        <div class="col-12 col-sm-6 col-lg-4 cardBox">
            <div class="account-card account-card-primary text-center p-4">
                <a href="{{ route('u.bank.add') }}" class="account-card-new d-flex align-items-center  btn-link">
                    <p class="text-center">
                        <span class="text-3"><i class="fas fa-plus-circle"></i></span>
                        <span class="d-block">Ajouter une nouvelle carte</span>
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
