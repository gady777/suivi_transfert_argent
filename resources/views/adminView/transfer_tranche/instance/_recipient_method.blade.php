@if($method)
 @php 
    $depot = $method;
    $meth = $method->method(); 
 @endphp

 @if($meth->slug == "bank")
    Nom banque: <b>{{$depot->bank_name}}</b> <br>
    Intitulé compte: <b>{{$depot->account_name}}</b> <br>
    Numéro compte: <b>{{$depot->account_number}}</b> <br>
    Clé RIB: <b>{{$depot->rib}}</b>
 @elseif($meth->slug == "mobile")
    Numéro de téléphone: <b>{{$depot->phone_number}}</b> <br>
    Bénéficiaire: <b>{{$depot->phone_name}}</b>
 @elseif($meth->slug == "cash")
    Nom & Prénom: <b>{{$depot->cash_name_fname}}</b> <br>
    CNI ou Passport: <b>{{$depot->cash_cni}}</b>
 @elseif($meth->slug == "interact")
    Informations: <b>{{$depot->interact}}</b>
 @endif

@else  
<div class="text-danger">
    <p id="no_available_method" class="border-left">
    Aucune information trouvée. Les informations de réceptions pour 
    la méthode choisie n'existe pas pour ce bénéficiaire.
    </p>
</div>
<div class="border-left text-{{$recipient_methods->count() > 0 ? 'success' : 'danger'}}">
   <strong>Les méthodes disponibles sont:</strong>
   @forelse($recipient_methods as $m)
      <li> {{$m->method()->name}} </li>
   @empty
    <p>Pas de méthodes disponibles pour ce récepteur.</p>
   @endforelse
</div>
@endif
