@extends('layout_dash.template')
@section('title')  Bénéficiaire | Méthodes de transfert @endsection
@section('contenu')

<h2 class="admin-heading">Les méthodes enregistrées pour le bénéficiaire 
    <b>{{$recipient->name}} {{$recipient->fname}}</b> 
    <a href="{{ route('u.recipient.method.new',['id'=>$recipient->id]) }}" class="order-card"> <i
            class="fas fa-plus"></i> Ajouter une méthode ?</a></h2>
<!-- Credit or Debit Cards  -->
<div class="bg-offwhite shadow">
    @if ($recipient->methods()->count() == 0 )   
        <div class="alert alert-danger">
            Vous devez ajouter au moins une méthode pour ce bénéficiaire pour faire un transfert d'argent.
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <p class="p-2 font-weight-bold">Les méthodes de réception</p>
        </div>
        <div class="col-12">
           
        <div class="row">
            @foreach($recipient->methods() as $meth)
             
            <div class="col-md-6">
            <div class="card p-2 mb-2">
                <div class="card-header">
                    <div class="card-title">{{$meth->method()->name}}</div>
                </div>
                @php $mm = $meth->method(); @endphp
                <div class="card-body">
                    @if($mm->slug == "bank")  
                    <p>
                        <b>Banque:</b> {{$meth->bank_name}} | 
                        <b>Int. compte:</b> {{$meth->account_name}} |
                    </p>
                    <p>
                        <b>N° compte:</b> {{$meth->account_number}} | 
                        <b>RIB:</b> {{$meth->rib}}
                    </p>
                    @elseif($mm->slug == "interact")
                    <p>
                        <b>Information</b> 
                    </p>
                    <p>{{$meth->interact}}</p>
                    @elseif( $mm->slug == "cash" )  
                    <p><b>Nom & Prénom(s):</b> {{$meth->cash_name_fname}}</p>
                    <p> <b>CNI:</b> {{$meth->cash_cni}}</p>
                    @else  
                    <p> <b>Nom & Prénom(s):</b> {{$meth->phone_name}}</p>
                    <p> <b>Numéro de téléphone:</b> {{$meth->phone_number}}</p>
                    @endif
                </div>

                <div class="card-footer">
                    <a title="Modifier" class="m-2" href="{{ route('u.recipient.method.edit',['id'=>$recipient->id,'meth_id'=>$meth->id]) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a title="Supprimer" class="m-2" href="{{ route('u.recipient.method.delete',['id'=>$recipient->id,'meth_id'=>$meth->id]) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
            </div>
            @endforeach
        </div>
            
        </div>
    </div>
   </div>
</div>



@endsection
