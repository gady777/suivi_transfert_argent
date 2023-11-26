@extends('layout_dash.template')
@section('title')  Toutes vos opérations de dépôt  @endsection
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Toutes vos opérations de dépôt
        <a href="{{route('u.depot.state1')}}" class="float-right"> <i class="fas fa-plus"></i> 
        Nouveau dépôt</a>
    </h3>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" 
        id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <table class="table table-hover" id="transactionTable" >
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Méthode</th>
                        <th>Montant</th>
                        <th>Frais</th>
                        <th>Montant réel</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $nbre=0; ?>
                    @foreach($ds as $d)
                    <tr>
                        <td> {{ date('d-m-Y H:i', strtotime($d->created_at)) }}</td>
                        <td>
                            @if($d->method())
                                {{$d->method()->name}}
                            @else   
                                @if($d->method == "bank")
                                    Virement bancaire
                                @elseif($d->method == "interact")
                                    Interact
                                @elseif($d->method == "mobile")
                                    Mobile Money
                                @elseif($d->method == "cash")
                                    Cash Money
                                @endif
                            @endif
                        </td>
                        <td>{{$d->amount}} {{ $d->currency()->abbreviation }}</td>
                        <td class="text-center"> 
                            {{$d->fee}} %
                        </td>
                        <td class="text-center"> 
                            {{$d->receive_amount}} {{ $d->currency()->abbreviation }}
                        </td>
                        <td>
                            @if($d->reject)
                                <span class="text-danger"> <i class="fas fa-close"></i> Rejeté</span>, 
                                {{$d->reject_raison}}, le {{ date('d-m-Y H:i', strtotime($d->reject_at)) }}
                            @else  
                                @if($d->statut == 'pending')   
                                    <span class="badge badge-warning">En attente...</span>
                                @elseif($d->statut == 'waiting_validation')
                                    <span class="badge badge-info">En cours...</span>
                                @else  
                                    <span class="badge badge-success">Confirmé!</span>
                                @endif
                            @endif
                        </td>
                        <td class="text-center"> 
                            <a title="Voir les détails" href="{{route('u.depot.show',['id'=>$d->id])}}"> <i class="fas fa-eye"></i> </a>     
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
