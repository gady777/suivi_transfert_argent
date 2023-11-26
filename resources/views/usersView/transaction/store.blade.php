@extends('layout_dash.template')
@section('contenu')
 
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Voir l'Historique de mes transactions </p>

    </h3>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover" id="transactionTable" >
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type de d'operation</th>
                        <th>Contenu</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>

                    
                    @forelse($transactions as $item)
                    <tr>
                        <td scope="row"> {{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                        <td>#{{$item->operation_type}}</td>
                        <td>{{$item->content}}</td>
                        <td> {{$item->amount}} 
                            @if($item->countryFrom())  
                                {{$item->countryFrom()->devise()->abbreviation}}
                            @elseif($item->devise()) 
                                {{$item->devise()->abbreviation}}
                            @endif
                        </td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center">Aucune transaction</td>
                      </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection

@section('code')


<script>
$(function(){
    $('#transactionTable').DataTable();
})
</script>
@endsection
