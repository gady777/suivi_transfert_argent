<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    @yield('description')
    @yield('keywords')
    <meta name="author" content="Transfert Union">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f2f3f5" />
    <!-- Site Properties -->
    <title>@yield('title',"Transfert Union | Transfert d'argent rapide et sécurisé - Canada - Afrique") </title>
    @include('includes.cssLink')

</head>

<body>
    <!-- preloader begin -->
    <div class="in-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- preloader end -->
    <header>
        <!-- header content begin -->
        <div class="uk-section uk-padding-remove-vertical">
            @include('layout.menu')
        </div>
        <!-- header content end -->
    </header>
    @yield('breadcrumb')
    <main>
        @yield('contenu')

    </main>
    <footer>
        @include('layout.footer')
    </footer>
    <!-- Javascript -->
    @include('includes.jsLink')
</body>

</html>
