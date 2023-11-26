@extends('adminView.layout.layout')

@section('title')
  {{config('info.app_name')}} - Admin - Transfert par tranche
@endsection

@section('body_class','hold-transition sidebar-mini layout-fixed')

<div class="wrapper">
  @include ("adminView.layout.top")
  @section('layout_content')
  @include ("adminView.layout.aside_left")
  <div class="content-wrapper">
    @include('flash::message')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Transfert par tranche: envoi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.home')}}">Transfert par tranche</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.transfer.tranche.detail.envoi',['id'=>$t->id])}}">Les envois</a></li>
              <li class="breadcrumb-item active">Ajouter paiement: envoi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ajouter paiement (envoi) à un transfert par tranche</h3>
              </div>

              <div class="card-body">
              @if (session('error'))
                  <div class="text-danger">
                      {{ session('error') }}
                  </div>
              @endif
                <p>
                  Transfert par tranche de {{number_format($t->amount,2,'.',' ')}} {{$t->devise()->abbreviation}} à 
                  {{$t->user()->pseudo}}, <b>{{number_format($t->amount_cfa,2,'.',' ')}} F CFA</b> <br>
                  Reste à envoyer au destinataire: <strong>{{number_format($t->solde_envoi,2,'.',' ')}} F CFA</strong>
                </p>
                <form method="post" action="{{route('admin.transfer.tranche.instance.new.envoi.post',['id'=>$t->id])}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="devise" value="{{$devise->id}}">
                  
                  <div class="form-group">
                      <label for="place">Montant</label>
                      <input value="{{old('amount')}}" name="amount" min="10" type="number" 
                        class="form-control"
                      id="place" placeholder="Montant à payer pour cette tranche en F CFA">
                      @error('amount') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <input type="hidden" name="type" value="envoi">
                  <div class="form-group">
                      <label for="v">Méthode</label>
                      <select id="method_id" name="method" required class="form-control">
                        <option value="">Choisir une méthode</option>
                        @if($t->transfer())
                        @php $mettth_id = $t->transfer()->method()->id; @endphp
                        @else 
                          @php $mettth_id  = null; @endphp
                        @endif
                          
                        @foreach( $methods as $d )
                          <option {{ old("method") ? (old("method") == $d->id ? 'selected' : ''): ($mettth_id==$d->id?'selected':'')  }} value="{{$d->id}}">
                            {{$d->name}} @if( $mettth_id==$d->id) (--Par défaut--) @endif
                          </option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="">Bénéficiaire</label>
                    <select class="form-control" name="recipient_id" id="recipient_id">
                      @foreach($recipients as $r)
                      <option 
                        @if(old('recipient_id'))  
                          {{old('recipient_id') == $r->id ? 'selected':''}}
                        @else  
                          {{($recipient and $recipient->id == $r->id) ?'selected':''}}
                        @endif
                       value="{{$r->id}}">{{$r->name}}({{$r->email}}) {{($recipient and $recipient->id == $r->id) ?'(--Par défaut--)':''}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div style="padding-left: 30px;" class="text-muted border-left" id="recipient_info"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Informations</label>
                    <textarea name="informations" placeholder="Entrez ici les informations de réception" class="form-control">{{old('informations')}}</textarea>
                    @error('informations') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  
                  <div class="form-group">
                    <label for="plac">Date de transaction</label>
                    <input value="{{old('pay_date')}}" name="pay_date" type="datetime-local" 
                      class="form-control"
                      id="plac">
                      @error('pay_date') <div class="text-danger"> {{ $message }} </div> @enderror
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> 
                    Ajouter</button>
                  </div>

                </form>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection

@section('add_js')

<script>
  jQuery(function($){
    $('form').submit(function(e){
      var tmp = $("body").find('#no_available_method').length;
      if( tmp ){

        if(!confirm("LES INFORMATIONS DE RECEPTION NE SONT PAS DISPONIBLES POUR CE BENEFICIAIRE. ETES-VOUS SURE DE VOULOIR CONTINUER ?")){
          e.preventDefault();
          window.location.href = "{{route('admin.transfer.tranche.detail.envoi',['id'=>$t->id])}}";
        }

      }

    });

    function loadInfo(){
      var r_id = parseInt($('#recipient_id').val(),10);
      var m_id = parseInt($('#method_id').val(),10);
      if(!r_id || !m_id){
        return;
      }
      var ur = "{{route('admin.transfer.tranche.load.recipient.info')}}"+'/'+r_id+'/'+m_id;
      $.ajax({
        method: 'GET',
        url:ur,
        beforeSend: function(){
          $('#recipient_info').html(
            '<div class="text-center spinner-border text-primary"></div>'
          );
        },
        success: function(data){
          $('#recipient_info').html(data);
        },
        error:function(err1,err2,err3){
          $('#recipient_info').html(
            '<div>Une erreur est survenue. <br> '+err1+', '+err2+', '+err3+' </div>'
          );
        }
      });
    }
    loadInfo();
    $('#method_id').change(function(){
      loadInfo();
    });
    $('#recipient_id').change(function(){
      loadInfo();
    });
  });
</script>

@endsection
