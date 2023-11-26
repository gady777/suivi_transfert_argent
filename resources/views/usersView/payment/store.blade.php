@extends('layout_dash.template')
@section('contenu')
<div class="profile-content">
    <h3 class="admin-heading bg-offwhite">
        <p>Faire une demande de paiement à Transfert Union </p>

    </h3>
    <h4 class="text-2 msg-header"><a href="{{route('u.make.paiment')}}">Faire une demande</a> </h4>


    <div class="row">
        <div class="col-12">
            <table class="table table-hover" id="transactionTable" >
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $nbre=0; ?>
                    @forelse($data as $item)
                    <?php $nbre +=1; ?>
                    <tr>
                        <td> {{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                        <td>{{$item->message}}</td>
                        <td>
                          @if($item->reject ==0)
                              @if($item->confirm == 0)
                                  <span class="payments-status text-warning" >
                                  <span class="badge badge-warning badge-pill">attente...</span>
                                  </span>
                              @elseif($item->confirm == 1)
                                  <span class="payments-status text-success" >
                                      <span class="badge badge-success badge-pill">confimé</span>
                                  </span>
                              @endif
                          @else
                          <span class="payments-status text-danger" >
                              <span class="badge badge-danger badge-pill">Rej.</span>, {{$item->raison}}
                          </span>
                          @endif
                        </td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center">Aucune demande auparavant</td>
                      </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
