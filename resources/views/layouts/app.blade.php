<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ config('app.name', 'Image Upload') }} | @yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('assets/front/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/pnotify/dist/pnotify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/pnotify/dist/pnotify.buttons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/vendor/pnotify/dist/pnotify.nonblock.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/main.css') }}">
    @yield('css')
</head>
<body>

	<div class="container-contact100">
        @yield('content')
    </div>

	<div id="dropDownSelect1"></div>

	<script src="{{ asset('assets/front/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('assets/front/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    @yield('js')
</body>
</html>
