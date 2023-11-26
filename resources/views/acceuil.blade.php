@extends('public.layout')

@section('style')
    <style>
        .steps li span::before {
            height: 85px !important;
            width: 85px !important;
        }

        .steps li span {
            height: 70px !important;
            width: 70px !important;
        }
    </style>
@endsection

@section('contenu')
    <section class="banner v7">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <div class="ban-content">
                        <h1>Sentez-vous proche de votre famille</h1>
                        <p align="justify">Aujourd'hui vos transferts d'argent sont à portée de main, simple et sécurisé.
                            Avec Transfert Union, vous pouvez envoyer de l’argent aux membres de votre famille à l’étranger
                            pour leur venir en aide. Vos proches peuvent récupérer l’argent en espèces ou directement sur
                            leur portefeuille mobile, en quelques minutes*.
                        </p>
                        <a href="{{ route('u.transfer.state1') }}" class="btn btn-outline btn-round icon-left">
                            <span class="bh"></span> <span><i class="fas fa-play"></i> Je veux transférer</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="form-tab">
                        <ul class="nav nav-tabs">
                            <li><a class="active" data-toggle="tab" href="{{ route('u.transfer.state1') }}">Envoyez de
                                    l'argent</a></li>

                        </ul>
                        <div class="tab-content currency-form">
                            <div id="send-money" class="tab-pane fade in active show">
                                <form action="{{ route('u.transfer.state1') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <h6 class="label-text">Pays d'envoi</h6>
                                    <div class="form-field">
                                        <select class="send-from">
                                            @foreach ($countries as $country)
                                                <option @if ($country->id == 4) selected @endif
                                                    value="{{ asset('template/images/flags/') }}/{{ strtolower($country->devise()->abbreviation) }}.png"
                                                    data-n="{{ $country->devise()->abbreviation }}"
                                                    data-rate="{{ $country->devise()->rate }}">{{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <h6 class="label-text">Envoyer vers</h6>
                                    <div class="form-field">
                                        <select class="send-to">
                                            @foreach ($countries as $country)
                                                <option  @if ($country->id == 3) selected @endif
                                                    value="{{ asset('template/images/flags/') }}/{{ strtolower($country->devise()->abbreviation) }}.png"
                                                    data-n="{{ $country->devise()->abbreviation }}"
                                                    data-rate="{{ $country->devise()->rate }}">{{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-field">
                                        <label>Montant à envoyer</label>
                                        <div class="join-field">
                                            <input type="number" id="send_amount" name="send_amount" placeholder="000.00">
                                            <div class="curr-select send-send">
                                                <span class="selected" data-rate="" data-n="">
                                                    <img src="{{ asset('assets/images/money_pay_icon.svg') }}"
                                                        alt="">
                                                    <span></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label>Montant à recevoir</label>
                                        <div class="join-field">
                                            <input type="number" id="receive_amount" name="receive_amount"
                                                placeholder="000.00">
                                            <div class="curr-select rec-rec">
                                                <span class="selected" data-rate="" data-n="">
                                                    <img src="{{ asset('assets/images/money_pay_icon.svg') }}"
                                                        alt="">
                                                    <span></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="label-text">Mode de transfert</h6>
                                    <div class="form-field">
                                        <select class="method-transfert">
                                            @foreach ($transfertMethod as $transfer)
                                                <option value="{{ $transfer->fee }}">{{ $transfer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="currency-text" style="display: block !important;">
                                        <div class="rate-area">
                                            Taux de change: <span> <strong id="rate1_num"></strong> <strong
                                                    id="rate1_name"></strong> </span>
                                            <span>=</span>
                                            <span> <strong id="rate2_num"></strong> <strong id="rate2_name"></strong>
                                            </span>
                                        </div>
                                        <div>
                                            Frais: <span> <strong id="change_fee"></strong> <strong
                                                    id="fee_rate_name"></strong>
                                            </span>
                                        </div>
                                        <div>
                                            Total à payer: <span> <strong id="total"></strong> <strong
                                                    id="total_rate_name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <button class="btn btn-block btn-filled form-btn">
                                        <span class="bh"></span> <span>Envoyer de l'argent <i
                                                class="fas fa-arrow-right"></i></span>
                                    </button>
                                    <span class="accept-terms">En poursuivant vos actions,
                                        vous acceptez les <a href="{{ route('terms') }}">CGV</a></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Banner section end -->

    <!-- Easy steps section start -->
    <section class="easy-steps">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 m-auto">
                    <div class="sec-heading">
                        <h2 class="sec-title">Envoyer de l'argent avec simplicité</h2>
                        <p class="sec-subtitle" align="justify">Aujourd'hui vos transferts d'argent sont à portée de main,
                            simple et sécurisé, aux meilleurs tarifs en seulement 3 clics depuis votre compte sécurisé afin
                            de prendre soin de votre famille et de vos amis.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-12 m-auto">
                    <ul class="row">
                        <div class="col-6 col-sm-3 text-center">
                            <img style="max-width: 100px; height:auto;margin:auto;padding:auto;" class="rounded-circle"
                                src="{{ asset('template/images/transfer-inscrire.jpeg') }}" alt="Inscription">
                            <strong>Inscrivez-vous</strong>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <img style="max-width: 100px; height:auto;margin:auto;padding:auto;" class="rounded-circle"
                                src="{{ asset('template/images/trabsfer-recipient.jpeg') }}" alt="Bénéficiaires">
                            <strong>Ajouter vos bénéficaires</strong>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <img style="max-width: 100px; height:auto;margin:auto;padding:auto;" class="rounded-circle"
                                src="{{ asset('template/images/transfer-transfer.jpeg') }}" alt="Transfert"><strong>
                                Effectuer un transfert</strong>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <img style="max-width: 100px; height:auto;margin:auto;padding:auto;" class="rounded-circle"
                                src="{{ asset('template/images/transfer-pay.jpeg') }}" alt="Payer"><strong>Payez
                                pour votre transfert</strong>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Easy steps section end -->

    <!-- Payment service section start -->
    <section class="payment-service bg-offwhite">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="content-box">
                        <h2>Envoie & Reception d'argent</h2>
                        <p align="justify">Accéder à votre compte Transfert Union et envoyer de l’argent en ligne
                            directement depuis le site www.transfertunion.com. Commencez à utiliser notre plateforme
                            Transfert Union dès maintenant pour profiter d’offres exceptionnelles.</p>
                        <ul class="list">
                            <li><i class="fas fa-check-circle"></i>L’ensemble des transferts sont traités à la minutes.
                            </li>
                            <li><i class="fas fa-check-circle"></i>Des réduction sur vos envois d’argent</li>
                            <li><i class="fas fa-check-circle"></i>Nombreuses méthodes de reception d'argent</li>
                            <li><i class="fas fa-check-circle"></i>Un service support humain à votre écoute</li>
                        </ul>
                        <a href="{{ route('register.personnel') }}" class="btn btn-default">
                            <span class="bh"></span> <span>Je crée mon compte</span></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure class="imgBox">
                        <img src="{{ asset('template/images/receveid-money.png') }}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- Payment service section end -->

    <!-- Services section start -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 m-auto">
                    <div class="sec-heading">
                        <h2 class="sec-title">Qu'offrons-nous à notre communauté?</h2>
                        <p class="sec-subtitle" align="justify">Un service très simple à mettre en place. De plus, il est
                            hautement sécurisé et facile à utiliser. Les frais sont raisonnables et les taux de change plus
                            avantageux que la plupart. C'est de loin le meilleur service de transfert d'argent que à
                            utiliser !"</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="iconBox boxed text-center">
                        <!-- <img src="images/icons/1.png" alt="" class="img-icon"> -->

                        <!-- Roysha icon -->
                        <span class="roysha-icon roysha-secured"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span><span class="path4"></span><span
                                class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                class="path8"></span><span class="path9"></span><span class="path10"></span><span
                                class="path11"></span><span class="path12"></span><span class="path13"></span></span>

                        <h5><a href="#">Nombreux types de transfert</a></h5>
                        <p>Envoyez votre argent comme bon vous semble, en agence ou via un numéro de téléphone portable.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="iconBox boxed text-center">

                        <!-- Roysha icon -->
                        <span class="roysha-icon roysha-amount"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span><span class="path4"></span><span
                                class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                class="path8"></span><span class="path9"></span><span class="path10"></span><span
                                class="path11"></span></span>

                        <h5><a href="#">Frais fixes & très bas</a></h5>
                        <p align="">Nous n'avons aucun frais caché, nous affichons tous les frais de transferts et
                            le montant à recevoir.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="iconBox boxed text-center">
                        <!-- Roysha icon -->
                        <span class="roysha-icon roysha-wallet"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span><span class="path4"></span><span
                                class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                class="path8"></span><span class="path9"></span><span class="path10"></span><span
                                class="path11"></span><span class="path12"></span><span class="path13"></span><span
                                class="path14"></span></span>

                        <h5><a href="#">Livraison instantanée</a></h5>
                        <p>L’ensemble des transferts sont traités en quelques secondes, nous vous faisons gagner du temps.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('code')
    <script>
        jQuery(function($) {
            var span = $('.send-send').first().find('.selected');
            var flag = $('.send-from .hidden-value').attr('data-value');
            var rate = $('.send-from .hidden-value').attr('data-rate');
            var n = $('.send-from .hidden-value').attr('data-n');
            span.find('img').attr('src', flag);
            span.attr('data-rate', rate);
            span.attr('data-n', n);
            span.find('span').text(n);

            var spanTo = $('.rec-rec').first().find('.selected');
            var flagTo = $('.send-to .hidden-value').attr('data-value');
            var rateTo = $('.send-to .hidden-value').attr('data-rate');
            var nTo = $('.send-to .hidden-value').attr('data-n');
            spanTo.find('img').attr('src', flagTo);
            spanTo.attr('data-rate', rateTo);
            spanTo.attr('data-n', nTo);
            spanTo.find('span').text(nTo);

            var last = 0;

            function sendFrom() {
                var span = $('.send-send').first().find('.selected');
                var flag = $('.send-from .hidden-value').attr('data-value');
                var rate = $('.send-from .hidden-value').attr('data-rate');
                var n = $('.send-from .hidden-value').attr('data-n');
                span.find('img').attr('src', flag);
                span.attr('data-rate', rate);
                span.attr('data-n', n);
                span.find('span').text(n);
                if (!last) {
                    calculateRate1();
                } else {
                    calculateRate2();
                }
            }

            function sendTo() {
                var spanTo = $('.rec-rec').first().find('.selected');
                var flagTo = $('.send-to .hidden-value').attr('data-value');
                var rateTo = $('.send-to .hidden-value').attr('data-rate');
                var nTo = $('.send-to .hidden-value').attr('data-n');
                spanTo.find('img').attr('src', flagTo);
                spanTo.attr('data-rate', rateTo);
                spanTo.attr('data-n', nTo);
                spanTo.find('span').text(nTo);
                if (!last) {
                    calculateRate1();
                } else {
                    calculateRate2();
                }
            }

            $("#send_amount").keyup(function() {
                last = 0;
                calculateRate1();
            });
            $("#receive_amount").keyup(function() {
                last = 2;
                calculateRate2();
            });
            $('.send-send li').click(function() {
                var span = $(this).parents('.send-send').first().find('.selected');
                var src = $(this).find('img').attr('src');
                span.find('img').attr('src', src);
                span.attr('data-rate', $(this).attr('data-rate'));
                span.attr('data-n', $(this).attr('data-n'));
                if (!last) {
                    calculateRate1();
                } else {
                    calculateRate2();
                }
            });

            $('.method-transfert ul li').click(function() {
                var am1 = parseFloat($('#send_amount').val());
                var fee = $('.method-transfert .hidden-value').attr('data-value');
                if (isNaN(am1)) {
                    am1 = 0;
                }
                if (isNaN(fee)) {
                    fee = 0;
                }
                $('#total').text(((am1 * fee) / 100) + am1);
                $('#change_fee').text((am1 * fee) / 100);

                setTimeout(() => {
                    var am1 = parseFloat($('#send_amount').val());
                    var fee = $('.method-transfert .hidden-value').attr('data-value');
                    if (isNaN(am1)) {
                        am1 = 0;
                    }
                    if (isNaN(am1)) {
                        am1 = 0;
                    }
                    $('#total').text(((am1 * fee) / 100) + am1);
                    $('#change_fee').text((am1 * fee) / 100);
                }, 100);
            });

            $('.send-to ul li').click(function() {
                sendTo();
                setTimeout(() => {
                    sendTo();
                }, 100);
            });

            $('.send-from ul li').click(function() {
                sendFrom();
                setTimeout(() => {
                    sendFrom();
                }, 100);
            });

            $('.rec-rec li').click(function() {
                var span = $(this).parents('.rec-rec').first().find('.selected');
                var src = $(this).find('img').attr('src');
                span.find('img').attr('src', src);
                span.attr('data-rate', $(this).attr('data-rate'));
                span.attr('data-n', $(this).attr('data-n'));
                if (!last) {
                    calculateRate1();
                } else {
                    calculateRate2();
                }
            });
            calculateRate1();

            function calculateRate1() {
                var fee = parseFloat($('.method-transfert .hidden-value').attr('data-value'));
                var f1 = parseFloat($('.send-send .selected').attr("data-rate"));

                var f2 = parseFloat($('.rec-rec .selected').attr("data-rate"));
                if (!f1 || $('.rec-rec .selected').attr("data-rate") == "") {
                    return;
                }

                var am1 = parseFloat($('#send_amount').val());
                if (isNaN(am1)) {
                    am1 = 0;
                }
                if (isNaN(fee)) {
                    fee = 0;
                }
                $("#rate1_num").text(1);
                $('#rate1_name').text($('.send-send .selected').attr("data-n"));
                $('#fee_rate_name').text($('.send-send .selected').attr("data-n"));
                $('#total_rate_name').text($('.send-send .selected').attr("data-n"));
                $("#rate2_num").text((f1 / f2).toFixed(2));
                $('#rate2_name').text($('.rec-rec .selected').attr("data-n"));
                $('#change_fee').text((am1 * fee) / 100);
                $('#total').text(((am1 * fee) / 100) + am1);
                $("#receive_amount").val(((am1 * f1) / f2).toFixed(2));
            }

            function calculateRate2() {
                var fee = parseFloat($('.method-transfert .hidden-value').attr('data-value'));

                var f1 = parseFloat($('.send-send .selected').attr("data-rate"));

                var f2 = parseFloat($('.rec-rec .selected').attr("data-rate"));
                if (!f2 || $('.send-send .selected').attr("data-rate") == "") {
                    return;
                }

                var am2 = parseFloat($('#receive_amount').val());
                if (isNaN(am2)) {
                    am2 = 0;
                }

                if (isNaN(fee)) {
                    fee = 0;
                }

                var am1 = parseFloat($('#send_amount').val());
                if (isNaN(am1)) {
                    am1 = 0;
                }

                $("#rate1_num").text(1);
                $('#rate1_name').text($('.send-send .selected').attr("data-n"));
                $("#rate2_num").text((f1 / f2).toFixed(2));
                $('#rate2_name').text($('.rec-rec .selected').attr("data-n"));
                $("#send_amount").val(((am2 * f2) / f1).toFixed(2));

                $('#fee_rate_name').text($('.send-send .selected').attr("data-n"));
                $('#total_rate_name').text($('.send-send .selected').attr("data-n"));
                
                $('#change_fee').text((am1 * fee) / 100);
                $('#total').text(((am1 * fee) / 100) + am1);

                setTimeout(() => {
                    var am1 = parseFloat($('#send_amount').val());
                    var fee = $('.method-transfert .hidden-value').attr('data-value');
                    if (isNaN(am1)) {
                        am1 = 0;
                    }
                    if (isNaN(am1)) {
                        am1 = 0;
                    }
                    $('#total').text(((am1 * fee) / 100) + am1);
                    $('#change_fee').text((am1 * fee) / 100);
                }, 100);
            }
        });
    </script>
@endsection
