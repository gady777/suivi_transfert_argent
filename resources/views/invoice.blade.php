
<!DOCTYPE html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeMarch">
  <!-- Site Title -->
  <title>Reçu</title>
  <link rel="stylesheet" href="{{asset("invoice/assets/css/style.css")}}">
</head>

<body>
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">
            <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16">
              <b class="cs-primary_color">Reçu No:</b> #{{$deposit['id']}}</p>
            <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date: </b>{{date('d-m-Y',strtotime($deposit['created_at']))}}</p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="{{asset('assets/images/logo.png')}}" alt="Logo"></div>
          </div>
        </div>
        <div class="cs-invoice_head cs-mb10">
          <div class="cs-invoice_left">
            <b class="cs-primary_color">Reçu de:</b>
            <p>
              @if ($user->nameSociete)
                {{$user->nameSociete}}
              @elseif ($user->lastname)
                {{$user->lastname}} {{$user->firstname}}
              @else
                {{$user->pseudo}}
              @endif
              <br>
              @if($user->adresseSociete)
                {{$user->adresseSociete}}
              @else
                {{$user->adresse}}
              @endif <br>
              {{$user->email}}
            </p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <b class="cs-primary_color">Paiement à:</b>
            <p>
              @if(strtolower($receiver_type) == "admin")
                Transfert Union
              @else
                @if ($receiver->nameSociete)
                  {{$receiver->nameSociete}}
                @elseif ($receiver->lastname)
                  {{$receiver->lastname}} {{$receiver->firstname}}
                @else
                  {{$receiver->pseudo}}
                @endif
                <br>
                {{$receiver->email}}
              @endif

            </p>
          </div>
        </div>
        <div class="cs-table cs-style1">
          <div class="cs-round_border">
            <div class="cs-table_responsive">
              <table>
                <thead>
                  <tr>
                    <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Intitulé</th>
                    <th class="cs-width_4 cs-semi_bold cs-primary_color cs-focus_bg">Description</th>
                    <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">Qty</th>
                    <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Prix</th>
                    <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="cs-width_3">Dépôt d'argent</td>
                    <td class="cs-width_4">Dépôt à {{strtolower($receiver_type) == "admin" ? 'Transfert Union' : $receiver->email }}</td>
                    <td class="cs-width_1">1</td>
                    <td class="cs-width_2">{{$deposit['price']}}</td>
                    <td class="cs-width_2 cs-text_right">{{$deposit['price']}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="cs-invoice_footer cs-border_top">
              <div class="cs-left_footer cs-mobile_hide">
                <p class="cs-mb0"><b class="cs-primary_color">Résumé</b></p>
                <!--p class="cs-m0">Ceci est la preuve de votre transaction sur {{config('info.app_name')}}</p-->
              </div>
              <div class="cs-right_footer">
                <table>
                  <tbody>
                    <tr class="cs-border_left">
                      <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Sous total</td>
                      <td class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">{{$deposit['price']}}</td>
                    </tr>
                    <tr class="cs-border_left">
                      <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Tax</td>
                      <td class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">/</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="cs-invoice_footer">
            <div class="cs-left_footer cs-mobile_hide"></div>
            <div class="cs-right_footer">
              <table>
                <tbody>
                  <tr class="cs-border_none">
                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">Total</td>
                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">{{$deposit['price']}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="cs-note">
          {{date('d-m-Y')}} Transfert Union
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset("invoice/assets/js/jquery.min.js")}}"></script>
  <script src="{{asset("invoice/assets/js/jspdf.min.js")}}"></script>
  <script src="{{asset("invoice/assets/js/html2canvas.min.js")}}"></script>
  <script src="{{asset("invoice/assets/js/main.js")}}"></script>
</body>
</html>
