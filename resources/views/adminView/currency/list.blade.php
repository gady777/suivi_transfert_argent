@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Devise
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
            <h1 class="m-0 text-dark">Devises</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item active">Devises</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <a class="btn btn-primary" href="{{route('admin.currency.new')}}">Ajouter
              une devise</a>
          </div>
        </div> <br>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Toutes les devises</b> </h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Intitulé</th>
                      <th>Symbole</th>
                      <th>Abbreviation</th>
                      <th>Taux/F CFA (XOF)</th>
                      <th>Date</th>
                      <th>Heure</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($currencies as $c)
                      <tr>
                        <td>{{$c->intitule}}</td>
                        <td>{{$c->symbole}}</td>
                        <td>{{$c->abbreviation}}</td>
                        <td>{{$c->rate}} </td>
			<td>{{date('d-m-Y',strtotime($c->updated_at??$c->created_at))}} </td>
			<td>{{date('H:i:s',strtotime($c->updated_at??$c->created_at))}} {{config('app.timezone')}}</td>
                        <td>
                            <a title="Modifier" href="{{route('admin.currency.edit',['id'=>$c->id])}}"
                              class="m-1 btn btn-info"> <i class="fas fa-edit"></i> </a>
                            <form class="d-inline" onsubmit="return confirm('{{config('info.confirm_operation')}}');"
                            action="{{route('admin.currency.delete',['id'=>$c->id])}}" method="post">
                              <button type="submit" class="m-1 btn btn-danger"> <i class="fas fa-trash"></i> </button>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            {{--<a title="Paramètres/Frais de traitement" 
                            href="{{route('admin.processing_fee.show.currency',['id'=>$c->id])}}"
                              class="m-1 btn btn-dark"> <i class="fas fa-cog"></i> </a>--}}
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucune devise</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br> <br>                      
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Archives</b> </h3>
              </div>
              <div class="card-body">
                <form class="row" method="get">
                  <div class="col-md-3 form-group">
                    <label for="">Devise</label>
                    <select class="form-control" name="devise" id="">
                      <option value="">Choisir devise</option>
                      @foreach($currencies as $d)
                        <option {{ $d->id == $devise ? 'selected' : "" }} value="{{$d->id}}">{{$d->abbreviation}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Date début</label>
                    <input value="{{$date1??''}}" class="form-control" 
                    type="date" placeholder="Date 1" name="date1">
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Date fin</label>
                    <input value="{{$date2??''}}" class="form-control" 
                    type="date" placeholder="Date 2" name="date2">
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Rechercher</label> <br>
                    <button class="btn btn-dark form-control"> <i class="fas fa-search"></i> </button>
                  </div>
                </form>
                <hr>
                <table id="example4" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th rowspan="2">Intitulé</th>
                      <th rowspan="2">Symbole</th>
                      <th rowspan="2">Abbreviation</th>
                      <th rowspan="2">Taux/XOF</th>
                      <th colspan="4" class="text-center">
                        Validité (Date & Heure en {{config('app.timezone')}})
                      </th>
                    </tr>
                    <tr>
                      <td>Date déb</td> 
                      <td>H déb</td>
                      <td>Date fin</td> 
                      <td>H fin</td>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($archives as $c)
                      <tr>
                        <td>{{$c->intitule}}</td>
                        <td>{{$c->symbole}}</td>
                        <td>{{$c->abbreviation}}</td>
                        <td>{{$c->rate}} </td>
                        <td>
                          {{ date('d-m-Y',strtotime($c->was_created_at)) }} 
                        </td>
                        <td>
                          {{ date('H:i:s',strtotime($c->was_created_at)) }} 
                        </td>
                        <td>
                          {{ date('d-m-Y',strtotime($c->created_at)) }}
                        </td>
                        <td>
                          {{ date('H:i:s',strtotime($c->created_at)) }} 
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">Aucune devise</td>
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
@section('add_js')
<script>
  $("#example4").DataTable({
      "responsive": true,
      "autoWidth": false,
      bFilter:false,
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json",
      }
    });
</script>
@endsection