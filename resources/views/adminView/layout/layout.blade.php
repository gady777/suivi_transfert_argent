<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="robots" content="nofollow,noindex">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title', 'Money Transfert')</title>
@include ('adminView.layout.css')

@section('meta')@endsection
<link rel="icon" href="{{asset('assets/images/favicon.png')}}">
<link rel="apple-touch-icon" href="{{asset('assets/images/favicon.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/favicon.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/favicon.png')}}">
</head>
<body class="@yield('body_class')">
@yield('layout_content')
@include ('adminView.layout.js')
@yield('add_js')
</body>
</html>
