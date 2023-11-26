<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--TITLE-->
    <title>
        @yield( 'title' , config('info.app_name') )
    </title>

   @include('includes_dash.cssLink')
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
   @include('_whatsapp_widget')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status"></div>
    </div>

    <!-- Document Wrapper  -->
    <div id="main-wrapper">
        <!-- Header start -->
        <header class="header02">
            <div class="header-top">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-sm-8">
                            <div class="d-inline-flex ml-auto">
                                <a href="mailto:{{config('info.app_email')}}" class="top-text">
                                    <i class="fas fa-envelope"></i> {{config('info.app_email')}}</a>
                                <a href="tel:{{config('info.app_telephone')}}" class="top-text">
                                    <i class="fas fa-phone-volume"></i>
                                    {{config('info.app_telephone')}}</a> 
                                <a href="tel:{{config('info.app_telephone2')}}" style="margin-left:20px;" class="top-text">
                                    <i class="fas fa-phone-volume"></i>
                                    {{config('info.app_telephone2')}}</a>
                            </div>
                        </div>
                        <div class="col-sm-4 text-sm-right">
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </div>
                            {{--<div class="header-language">
                                    <ul class="list-unstyled list-inline">
                                        @include('_lang_user')
                                    </ul>
                                </div>--}}
                        </div>
                    </div>
                </div>
            </div>

            <!--header -->
            <div class="header-main">
                <div class="container d-flex align-items-center">
                    <a class="logo d-inline-flex" href="{{route('u.profil')}}">
                        <img src="{{asset('assets/images/logo2.png')}}" alt="Logo">
                    </a>

                    @include('layout_dash.menu')

                </div>
            </div>
            <!--end main header-->

        </header>
        <!-- Header end -->

        <!-- Admin Hero section-->
        <div class="hero-section">
            <div class="container">
                <div class="row  profile-complete-area">
                    <div class="col">
                        <div class="profile-item">
                            <i class="fas fa-mobile-alt bg-icon"></i>
                            <i class="{{Auth()->user()->telephoneUser ? 'fas fa-check-circle Verified-icon' : (Auth()->user()->telephoneSociete ? 'fas fa-check-circle Verified-icon':'far fa-circle Verified-icon') }}"></i>
                            <p class="title">Numéro Ajouté</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="profile-item">
                            <i class="fas fa-envelope bg-icon"></i>
                            <i class="fas fa-check-circle Verified-icon"></i>
                            <p class="title">Email Vérifié</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="progress" data-percentage="50">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">
                                <div class="profile-thumb mt-3 mb-4">
                                    <img style="min-width: 100px;" class="rounded-circle img-fluid"
                                    src="{{ asset(Auth::user()->photo ?? 'assets/images/avatar-b.svg' ) }}"
                                    alt="Profil">
                                    <div class="profile-thumb-edit verify-icon" data-toggle="tooltip" title="Profile Verified">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="profile-name">{{Auth()->user()->pseudo}}</p>
                    </div>
                </div>

            </div>
        </div>
        <!-- Admin End of Hero section-->

        <!-- Profile bar -->
        <div class="profilebar">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="local-time">
                            <p><b>Heure actuelle :</b> {{  date('H:i')}} {{config('app.timezone')}}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="local-time">
                            <p><b>Date actuelle:</b> {{ date('d-m-Y')}} {{config('app.timezone')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Profile bar -->

        <!-- Admin Content Section  -->
        <div id="content" class="py-4">
            <div class="container">
                <div class="row">
                    <!-- Left sidebar -->
                    <aside class="col-lg-3 sidebar">

                            @if(Auth::user()->type_compte == 2)

                              @include('layout_dash.menu-ind') <!-- Menu de compte personnel -->

                            @elseif(Auth::user()->type_compte == 3)

                              @include('layout_dash.menu-pro') <!-- Menu de compte pro -->

                            @endif

                    </aside>


                    <!-- Middle Panel  -->
                    <div class="col-lg-9">
                        @yield('contenu')

                    </div>

                </div>
            </div>
        </div>
        <!-- Content end -->

        <!-- Footer strat -->
        <footer class="footer">
            @include('layout_dash.footer')
        </footer>
        <!-- Footer end -->

    </div>
    <!-- Document Wrapper end -->

    <!-- Script -->
    @include('includes_dash.jsLink')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    @yield('code')

</body>

</html>
