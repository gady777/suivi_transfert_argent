@extends('layout_dash.template')
@section('contenu')
 
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Voir mes demandes d'argent </p>

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
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $nbre=0; ?>
                    @foreach($transactions as $item)
                    <?php $nbre +=1; ?>
                    <tr>
                        <td scope="row"> {{ date('m-Y', strtotime($item->created_at)) }}</td>
                        <td>{{$item->operation_type}}</td>
                        <td>{{$item->content}}</td>
                        <td> {{ "$ ".$item->amount}}</td>
                        <td>Validé # </td>
                    </tr>
                    @endforeach
                    <?php if($nbre==0){ ?>
                        <tr>
                            <td scope="row">Vide</td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php } ?>


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
