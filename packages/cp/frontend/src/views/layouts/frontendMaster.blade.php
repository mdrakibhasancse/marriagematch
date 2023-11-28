<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

    
        @yield('meta_tag')


		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
        <link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">

		   <!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
  
		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">
        <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>

        <link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css') }}">
		<!-- vendor CSS -->
		<link rel="stylesheet" href="{{asset("/frontend/vendor/bootstrap/css/bootstrap.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/fontawesome-free/css/all.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/animate/animate.compat.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/simple-line-icons/css/simple-line-icons.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/owl.carousel/assets/owl.carousel.min.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/vendor/owl.carousel/assets/owl.theme.default.min.css")}}">


		<link rel="stylesheet" href="{{asset("/frontend/vendor/magnific-popup/magnific-popup.min.css")}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset("/frontend/css/theme.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/css/theme-elements.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/css/theme-blog.css")}}">
		<link rel="stylesheet" href="{{asset("/frontend/css/theme-shop.css")}}">



		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{asset("/frontend/vendor/circle-flip-slideshow/css/component.css")}}">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{asset("/frontend/css/skins/default.css")}}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset("/frontend/css/custom.css")}}">

		<!-- Head Libs -->
		<script src="{{asset("/frontend/vendor/modernizr/modernizr.min.js")}}"></script>

		@if($ws->google_analytics_code)
            {!! $ws->google_analytics_code !!}
		@endif

		@if($ws->google_search_console)
            {!! $ws->google_search_console !!}
		@endif

		@if($ws->facebook_pixel_code)
            {!! $ws->facebook_pixel_code !!}
		@endif

		

        {{-- <style>
            body{
                font-family: 'Helvetica Neue', sans-serif;
            }
        </style> --}}
        @stack('css')


		

	</head>
	
	<body>
			

		<div class="body">  
			@include('frontend::layouts.frontendHeader') 
			@include('sweetalert::alert')
			@yield('content')

			@include('frontend::layouts.frontendFooter')
		</div>


		

		<!-- vendor -->
		<script src="{{asset("/frontend/vendor/jquery/jquery.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.appear/jquery.appear.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.easing/jquery.easing.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.cookie/jquery.cookie.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.validation/jquery.validate.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/jquery.gmap/jquery.gmap.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/lazysizes/lazysizes.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/isotope/jquery.isotope.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/owl.carousel/owl.carousel.min.js")}}"></script>

		
		<script src="{{asset("/frontend/vendor/magnific-popup/jquery.magnific-popup.min.js")}}"></script>

		
		<script src="{{asset("/frontend/vendor/vide/jquery.vide.min.js")}}"></script>
		<script src="{{asset("/frontend/vendor/vivus/vivus.min.js")}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset("/frontend/js/theme.js")}}"></script>

		<!-- Circle Flip Slideshow Script -->


		
		<script src="{{asset("/frontend/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js")}}"></script>



		<!-- Current Page Views -->
		<script src="{{asset("/frontend/js/views/view.home.js")}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset("/frontend/js/custom.js")}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset("/frontend/js/theme.init.js")}}"></script>
		<!-- Current Page Vendor and Views -->
		<script src="{{asset("/frontend/js/views/view.shop.js")}}"></script>

			<!-- Examples -->
		
		
		@stack('scripts')
	</body>

</html>


