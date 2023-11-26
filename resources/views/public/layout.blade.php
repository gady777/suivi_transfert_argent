<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('description')
    @yield('keywords')
    <title>@yield('title',"Transfert Union | Transfert d'argent rapide et sécurisé - Canada - Afrique") </title>
    <meta name="author" content="Transfert Union">
    <!-- Favicon icon -->
    @include('public.css')
    @include('_whatsapp_widget')
  </head>
  @yield('style')
  <body class="home-one">
    @include('public.header')
    @yield('contenu')
    @include("public.footer")
    <!-- JS -->
    @include('public.js')
    @yield('code')
  </body>
</html>
