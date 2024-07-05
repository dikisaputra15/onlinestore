<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>@yield('title')</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('eshop/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('eshop/css/magnific-popup.min.css') }}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('eshop/css/font-awesome.css') }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset('eshop/css/jquery.fancybox.min.css') }}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('eshop/css/themify-icons.css') }}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('eshop/css/niceselect.css') }}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('eshop/css/animate.css') }}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('eshop/css/flex-slider.min.css') }}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('eshop/css/owl-carousel.css') }}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('eshop/css/slicknav.min.css') }}">

    @stack('style')
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{ asset('eshop/css/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('eshop/style.css') }}">
    <link rel="stylesheet" href="{{ asset('eshop/css/responsive.css') }}">
	
	
</head>
<body class="js">

     <!-- Header -->
     @include('components.headerfront')
	
	
      <!-- Content -->
      @yield('main')
	
	 <!-- Footer -->
     @include('components.footerfront')
 
	<!-- Jquery -->
    <script src="{{ asset('eshop/js/jquery.min.js') }}"></script>
    <script src="{{ asset('eshop/js/jquery-migrate-3.0.0.js') }}"></script>
	<script src="{{ asset('eshop/js/jquery-ui.min.js') }}"></script>
	<!-- Popper JS -->
	<script src="{{ asset('eshop/js/popper.min.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('eshop/js/bootstrap.min.js') }}"></script>
	<!-- Color JS -->
	<script src="{{ asset('eshop/js/colors.js') }}"></script>
	<!-- Slicknav JS -->
	<script src="{{ asset('eshop/js/slicknav.min.js') }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('eshop/js/owl-carousel.js') }}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{ asset('eshop/js/magnific-popup.js') }}"></script>
	<!-- Waypoints JS -->
	<script src="{{ asset('eshop/js/waypoints.min.js') }}"></script>
	<!-- Countdown JS -->
	<script src="{{ asset('eshop/js/finalcountdown.min.js') }}"></script>
	<!-- Nice Select JS -->
	<script src="{{ asset('eshop/js/nicesellect.js') }}"></script>
	<!-- Flex Slider JS -->
	<script src="{{ asset('eshop/js/flex-slider.js') }}"></script>
	<!-- ScrollUp JS -->
	<script src="{{ asset('eshop/js/scrollup.js') }}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{ asset('eshop/js/onepage-nav.min.js') }}"></script>
	<!-- Easing JS -->
	<script src="{{ asset('eshop/js/easing.js') }}"></script>
	<!-- Active JS -->
	<script src="{{ asset('eshop/js/active.js') }}"></script>
</body>
</html>