@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Données de réceptions
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
            <h1 class="m-0 text-dark">Données de réceptions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Données de réceptions</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a class="btn btn-primary" 
              href="{{route('admin.receive_pay_method.new')}}">Ajouter
              une méthode</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Toutes les données</b> </h3>
              </div>
            </div> 
          </div>
        </div>
        <div class="container">
            <div class="row">
              @forelse($ms as $r)
              <div class="col-lg-4 col-6">
            <!-- small box -->
                <div class="small-box" style="height: 100%;">
                  <div class="inner">
                    <strong>{{$r->method()->name}}</strong> <br>
                    <div>
                      @php $mth_slug = $r->method()->slug;$rr = $r; @endphp
                                                @if($mth_slug == "bank")  
                                                  <div>Nom de la banque: {{$rr->bank_name}}</div>
                                                  <div>Intitulé du compte: {{$rr->account_name}} </div>
                                                  <div>Numéro de compte: {{$rr->account_number}}</div>
                                                  <div>Clé RIB: {{$rr->rib}} </div>
                                                @elseif($mth_slug == "interact")
                                                  <div>Email: {{$rr->interact}}</div>
                                                @elseif($mth_slug == "mobile")
                                                  <div>Numéro mobile: {{$rr->phone_number}}</div>
                                                  <div>Nom du propriétaire: {{$rr->phone_name}}</div>
                                                @elseif ($mth_slug == "cash")
                                                    <div>Nom & Prénom: {{$rr->cash_name_fname}}</div>
                                                    <div>Numéro CNI ou Passport: {{$rr->cash_cni}}</div>
                                                @endif
                    </div>
                  </div>
                  <div>
                    <a title="Modifier" href="{{route('admin.receive_pay_method.edit',
                       ['id'=>$r->id])}}" class="m-1 btn btn-info"> 
                       <i class="fas fa-edit"></i> 
                    </a>
                    <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.receive_pay_method.delete',['id'=>$r->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </div>
                </div>
              </div>
              
              @empty
              <p>
                Aucune donnée. <a href="{{route('admin.receive_pay_method.new')}}">Ajouter
                  </a> 
              </p>
              @endforelse
            
            </div>
        </div>

      </div>
    </section>

  </div>
</div>
@endsection
@section('add_js')
<script>
  $("#example4").DataTable({
      "responsive": true,
      "autoWidth": false,
      order:false,
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json",
        "searchPlaceholder": "Entrez date ou devise"
      }
    });
</script>
@endsection