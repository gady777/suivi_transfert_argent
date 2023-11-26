@extends('layout_dash.template')
@section('title')  Tous les transferts par tranche  @endsection
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Tous les transferts par tranche
    </h3>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" 
        id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <table class="table table-bordered table-stipped" id="transactionTable" >
            <thead>
                    <tr>
                      <th>Id trans</th>
                      <th>Montant</th>
                      <th>Devise</th>
                      <th>Solde réception</th>
                      <th>Solde envoi</th>
                      <th>Statut</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($ts as $t)
                      <tr>
                        <td>
                            @if($t->transfer_id)
                            <a href="{{route('u.transfer.show',['id'=>$t->transfer_id])}}">{{$t->id_transaction}} </a>
                            @else  
                            {{$t->id_transaction}} 
                            @endif
                        </td>
                        <td>
                          {{number_format($t->amount,2,'.',' ')}}</td>
                        </td>
                        <td> {{$t->devise()->abbreviation}}</td>
                        <td>{{number_format($t->solde,2,'.',' ')}} {{$t->devise()->abbreviation}}</td>
                        <td>{{number_format($t->solde_envoi,2,'.',' ')}} FCFA</td>
                        <td> 
                            @if($t->complete and $t->complete_envoi)
                                <span class="badge badge-success">Complète</span>
                            @else  
                                <span class="badge badge-warning">En cours</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a title="Voir les détails" 
                                href="{{route('u.transfer.tranche.detail',['id'=>$t->id])}}"> 
                                <i class="fas fa-eye"></i> 
                            </a>     
                        </td>
                      </tr>
                    @empty
                    <tr>
                      <td colspan="8" class="text-center text-danger">
                        Aucun transfert.
                      </td>
                    </tr>
                    @endforelse
                  </tbody> 
            </table>
        </div>
    </div>
</div>
@endsection
@section('code')
{{--<script>
$(function(){
    $('#transactionTable').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json",
      }
    });
})
</script>--}}
@endsection
