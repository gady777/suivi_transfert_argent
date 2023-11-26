@extends('layout_dash.template')
@section('title')  Détail du transfert par tranche | Les envoies  @endsection
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Détail du transfert par tranche
    <a href="{{route('u.transfer.tranche.detail',['id'=>$t->id])}}">Retour</a>
    </h3>
    <h3 class="admin-heading">
        Transfert par tranche de <strong>{{ number_format($t->amount,2,'.',' ') }} {{$t->devise()->abbreviation}}</strong> ( <b>{{$t->amount_cfa}} XOF</b> ) . 
        Restant à envoyer à Transfert Union: <strong>{{number_format($t->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}</strong>
    </h3>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" 
        id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <table class="table table-bordered" id="example1" >
          <thead>
                    <tr>
                      <th>Id trans</th>
                      <th>Id paiement</th>
                      <th>Infos</th>
                      <th>Date</th>
                      <th>Méthode</th>
                      <th>Montant</th>
                      {{--<th>Montant pay</th>--}}
                      <th>Devise pay</th>
                      <th>Solde</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ts as $p)
                      <tr>
                        <td>
                          @if($t->transfer_id) 
                          <a title="Détail" href="{{route('u.transfer.show',['id'=>$t->transfer_id])}}">
                            {{$t->id_transaction}}
                          </a>
                          @else  
                            {{$t->id_transaction}}
                          @endif
                        </td>
                        <td>{{$p->id_reception }}</td>
                        <td>{{$p->informations}}</td>
                        <td>{{date('d-m-Y',strtotime($p->pay_date))}}</td>
                        <td>{{$p->method()->name}}</td>
                        <td>{{number_format($p->amount,2,'.',' ')}} {{$t->devise()->abbreviation}} </td>
                        {{--<td>{{$p->receive_amount}} {{$p->devise()->abbreviation}}</td>--}}
                        <td>{{$p->devise()->abbreviation}}</td>
                        <td>{{$p->solde }} {{$t->devise()->abbreviation}}</td>
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
@endsection
{{--
@section('code')
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  jQuery(function($){
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      order:false,
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json",
        //"searchPlaceholder": "Entrez date ou devise"
      }
    });
  })
</script>
@endsection
--}}