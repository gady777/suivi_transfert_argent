<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>Transfert Confirmé</title>
    <!--[if !mso]><!-- -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass * {
            line-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <!--[if !mso]><!-->
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
        }
    </style>
    <!--<![endif]-->
    <!--[if mso]>
        <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
    <!--[if lte mso 11]>
        <style type="text/css">
          .outlook-group-fix { width:100% !important; }
        </style>
        <![endif]-->


    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }
    </style>


    <style type="text/css">
    </style>

</head>

<body style="background-color:#f9f9f9;">


    <div style="background-color:#f9f9f9;">


        <!--[if mso | IE]>
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->


        <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                <tbody>
                    <tr>
                        <td style="border-bottom:#3f54be solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                            <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
        </tr>
      
                  </table>
                <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->


        <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                <tbody>
                    <tr>
                        <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                            <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               style="vertical-align:bottom;width:600px;"
            >
          <![endif]-->

                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">

                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">

                                    <tr>
                                        <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:64px;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">

                                            <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:20px;font-weight:bold;line-height:1;text-align:left;color:#27318A;">
                                                <img src="{{asset('assets/images/logo-icon.png')}}" width="20x" height="20px">     TRANSFERT UNION
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                            <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:16px;line-height:22px;text-align:left;color:#555;">
                                                Salut {{$transfer->author()->pseudo}} <br>
                                                @php $depot = $transfer; @endphp<br><br>

                                                Votre transfert de {{ $transfer->amount }} {{$depot->countryFrom()->devise()->abbreviation}} à 
                                                <strong>{{$depot->recipient()->name}} {{$depot->recipient()->fname}}</strong>
                                                est validé.<br><br>

                                                Id transfert: <strong>{{$depot->id_transaction}}</strong><br><br>
                                                
                                                Frais: <b>{{ $depot->fee_amount }} {{$depot->countryFrom()->devise()->abbreviation}}</b> <br>
                                                Montant à recevoir: <b>{{$depot->receive_amount}} {{$depot->recipient()->country()->devise()->abbreviation}}</b> <br><br>

                                                <b>Méthode: </b><br>
                                                @php $meth = $depot->method(); @endphp
                                                @php $rr= $depot; @endphp
                                                <b>{{$meth->name}}</b> <br>
                                                    @if($meth->slug == "bank")
                                                        Nom banque: <b>{{$rr->bank_name}}</b> <br>
                                                        Intitulé compte: <b>{{$rr->account_name}}</b> <br>
                                                        Numéro compte: <b>{{$rr->account_number}}</b> <br>
                                                        Clé RIB: <b>{{$rr->rib}}</b>
                                                        @elseif($meth->slug == "mobile")
                                                        Numéro de téléphone: <b>{{$rr->phone_number}}</b> <br>
                                                        Bénéficiaire: <b>{{$rr->phone_name}}</b>
                                                        @elseif($meth->slug == "cash")
                                                            Nom & Prénom: <b>{{$rr->cash_name_fname}}</b> <br>
                                                            CNI ou Passport: <b>{{--$rr->cash_cni--}}</b>
                                                        @elseif($meth->slug == "interact")
                                                            Informations: <b>{{$rr->interact}}</b>
                                                        @endif
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:50px;word-break:break-word;">

                                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                <tr>
                                                    <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                        <a href="{{route('home')}}">  <p style="background:#2F67F6;color:#ffffff;font-family:'Helvetica Neue',Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:rebeccapurple;text-transform:yes;">
                                                            Effectuez un nouveau transfert
                                                        </p></a>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                            <img style="height:auto;max-width:70px;display: block;margin-left: auto;margin-right: auto;" src="{{asset('assets/images/logo.png')}}" title="Transfert Union" ><br><br>
                                            <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:14px;line-height:20px;text-align:left;color:#525252;">
                                                Salutation,<br>Toute l'équipe,<br> 
                                                <a href="{{route('home')}}" style="color:#2F67F6">Transfert Union</a>
                                                
                                            </div>

                                        </td>
                                    </tr>

                                </table>

                            </div>

                            <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->


        <div style="Margin:0px auto;max-width:600px;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                            <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               style="vertical-align:bottom;width:600px;"
            >
          <![endif]-->

                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">

                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align:bottom;padding:0;">

                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">

                                                    <tr>
                                                        <td align="center" style="font-size:0px;padding:0;word-break:break-word;">

                                                            <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:justify;color:#575757;">
                                                                <b>Transfert Union est une marque déposée.</b><br>
                                                                Dans certains emails, nous utilisons des cookies et autre technologie similaire pour marquer chaque hyperlien présent dans le message. Ainsi, nous parvenons à comprendre un peu mieux vos interactions avec nos emails et nous pouvons améliorer nos communications futures. Si vous cliquez sur les liens de cet email, nous pourrons suivre l’utilisation que vous faites de notre site web. Pour en savoir plus sur l’utilisation des cookies et autre technologie similaire, veuillez consulter notre Avis sur les cookies.

            Conformément aux lois applicables en matière de protection des données et de la vie privée, Transfert Union s’est engagé à protéger la confidentialité. Si vous désirez en savoir plus, veuillez consulter notre Politique de confidentialité.

            Pour être sûr que les e-mails de Transfert Union parviennent dans votre boîte aux lettres, veuillez ajouter Transfert Union noreply@transfertunion.com à votre liste d'expéditeurs autorisés.
        
                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center" style="font-size:0px;padding:10px;word-break:break-word;">

                                                            <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;">
                                                                <a href="" style="color:#575757">&copy; {{date('Y')}} Transfert Union. Tous droits Réservés.
                                                            </div>

                                                        </td>
                                                    </tr>

                                                </table>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      <![endif]-->


    </div>

</body>

</html>