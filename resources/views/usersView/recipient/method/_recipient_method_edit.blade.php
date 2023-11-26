<div style="display:none;" class="meth-bank">
    <div class="form-group">
      <input type="text" 
        class="form-control" 
        name="bank_name" 
        placeholder="Nom de la banque"
        value="{{old('bank_name')??$meth->bank_name}}">
     @if( $errors->has('bank_name') )
        <span class="text-danger">{{$errors->first('bank_name')}}</span>
     @endif
    </div>
    <div class="form-group">
        <input 
            type="text" 
            class="form-control" 
            name="account_name" 
            placeholder="Intitulé du compte"
            value="{{old('account_name')??$meth->account_name}}">
        @if( $errors->has('account_name') )
            <span class="text-danger">{{$errors->first('account_name')}}</span>
        @endif
    </div>
    <div class="form-group">
        <input 
            type="text" 
            name="account_number"
            class="form-control"
            placeholder="Le numéro du compte"
            value="{{old('account_number')??$meth->account_number}}">
        @if( $errors->has('account_number') )
            <span class="text-danger">{{$errors->first('account_number')}}</span>
        @endif
    </div>
    <div class="form-group">
        <input 
            type="text" 
            name="rib"
            class="form-control"
            placeholder="Clé RIB"
            value="{{old('rib')??$meth->rib}}">
        @if( $errors->has('rib') )
            <span class="text-danger">{{$errors->first('rib')}}</span>
        @endif
    </div>
</div>
<div style="display:none;" class="meth-interact">
    <div class="form-group">
        <input type="text" name="interact" 
         maxlength="200" class="form-control" 
         placeholder="Les informations du compte interact (Téléphone ou Email)"
         value="{{old('interact')??$meth->interact}}">
         @if( $errors->has('interact') )
            <span class="text-danger">{{$errors->first('interact')}}</span>
        @endif
    </div>
</div>
<div style="display:none;" class="meth-mobile">
    <div class="form-group">
        <input 
            type="tel" 
            name="phone_number" 
            class="form-control"
            placeholder="Numéro de téléphone"
            value="{{old('phone_number')??$meth->phone_number}}">
        @if( $errors->has('phone_number') )
            <span class="text-danger">{{$errors->first('phone_number')}}</span>
        @endif
    </div>
    <div class="form-group">
        <input 
            type="text" 
            name="phone_name" 
            class="form-control"
            placeholder="Nom du propriétaire"
            value="{{old('phone_name')??$meth->phone_name}}">
        @if( $errors->has('phone_name') )
            <span class="text-danger">{{$errors->first('phone_name')}}</span>
        @endif
    </div>
</div>
<div style="display:none;" class="meth-cash">
    <div class="form-group">
        <input 
            type="text" 
            name="cash_name_fname"
            class="form-control"
            placeholder="Nom & Prénom"
            value="{{old('cash_name_fname')??$meth->cash_name_fname}}">
        @if( $errors->has('cash_name_fname') )
            <span class="text-danger">{{$errors->first('cash_name_fname')}}</span>
        @endif
    </div>
    <div class="form-group">
        <input 
            type="text" 
            name="cash_cni"
            class="form-control"
            placeholder="CNI ou Passport"
            value="{{old('cash_cni')??$meth->cash_cni}}">
        @if( $errors->has('cash_cni') )
            <span class="text-danger">{{$errors->first('cash_cni')}}</span>
        @endif
    </div>
</div>