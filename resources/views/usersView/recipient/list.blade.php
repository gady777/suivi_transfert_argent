@extends('layout_dash.template')
@section('title')  Mes bénéficiaires @endsection
@section('contenu')

<h2 class="admin-heading">Enregistrez vos bénéficiaires ici 
    <a href="{{ route('u.recipient.new') }}" class="order-card"> <i
            class="fas fa-plus"></i> Ajouter un bénéficiaire</a></h2>
<!-- Credit or Debit Cards  -->
<div class="bg-offwhite  shadow">
    @if (Auth()->user()->recipients()->count() == 0 )   
        <div class="alert alert-danger">
            Vous devez ajouter au moins un bénéficiaire pour faire un transfert d'argent.
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <h3>Mes bénéficiaires</h3>
        </div>
        <div class="col-12">
        <table class="table table-hover" id="transactionTable" >
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rs as $r)
                    <tr>
                        <td>
                            {{$r->name}}
                        </td>
                        <td>
                            {{$r->fname}}
                        </td>
                        <td>{{$r->country()->name}}</td>
                        <td> 
                            {{$r->city}}
                        </td>
                        <td> 
                            {{$r->email}}
                        </td>
                        <td>
                            <a href="{{route('u.recipient.edit',['id'=>$r->id]) }}" 
                                class="btn-link mx-2">
                                <i class="fas fa-edit"></i></a>
                            <a href="{{route('u.recipient.method.list',['id'=>$r->id]) }}" 
                                class="btn-link mx-2">
                                <i class="fas fa-map-signs"></i>
                            </a>
                            <a onclick="return confirm('Supprimer ?')" href="{{ route('u.recipient.delete',['id'=>$r->id]) }}" 
                                    class="btn-link mx-2"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>



@endsection
