@extends('layout_dash.template')
@section('title')  Toutes vos opérations de transfert  @endsection
@section('contenu')

<div class="profile-content">
    <h3 class="admin-heading">Toutes vos opérations de transfert
        <a href="{{route('u.transfer.state1')}}" class="float-right"> <i class="fas fa-plus"></i> 
        Nouveau transfert</a>
    </h3>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" 
        id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <table class="table table-bordered" id="transactionTable" >
                <thead>
                    <tr>
                        {{--<th>Date</th>--}}
                        <th>Bénéficiaire</th>
                        <th>Id transfert</th>
                        <th>Méthode récep</th>
                        <th>Montant</th>
                        <th>Dévise réception</th>
                        <th>Montant réel</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $nbre=0; ?>
                    @foreach($ts as $d)
                    <tr>
                        {{--<td> {{ date('d-m-Y H:i', strtotime($d->created_at)) }}</td>--}}
                        <td>{{$d->recipient()->name}} {{$d->recipient()->fname}}</td>
                        <td>
                        <a title="Voir les détails" 
                            href="{{route('u.transfer.show',['id'=>$d->id])}}"> {{$d->id_transaction}} </a>
                        </td>
                        <td>
                            {{$d->method()->name}}
                        </td>
                        <td>{{number_format($d->amount,2,'.',' ')}} {{ $d->countryFrom()->devise()->abbreviation }}</td>
                        <td class="text-center"> 
                            @php $r = $d->recipient(); @endphp
                            {{$r->country()->devise()->abbreviation}}
                        </td>
                        <td class="text-center"> 
                            {{number_format($d->receive_amount,2,'.',' ')}} {{$r->country()->devise()->abbreviation}}
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
                            <a title="Voir les détails" 
                            href="{{route('u.transfer.show',['id'=>$d->id])}}"> <i class="fas fa-eye"></i> </a>     
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
