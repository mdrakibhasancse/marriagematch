<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>{{$ws->website_title}}</title>	

		<meta name="author" content="{{ $ws->meta_author }}">
		<meta name="title" content="{{ $ws->meta_title }}">
		<meta name="description" content="{{ $ws->meta_description }}">

	    {{-- @dd($ws->meta_description); --}}
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
		<link rel="icon" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}" type="image/x-icon">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light%7CPoppins:600&display=swap" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>

		<link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css') }}">

		<!-- Vendor CSS -->
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

	</head>
	<body>
	    @include('sweetalert::alert')
		<div class="body">
			<div role="main" class="main">
				<div class="p-relative">
					<section class="section border-0 m-0" style="background-image: url({{ route('imagecache', ['template' => 'original', 'filename' => 'mmbdhome.png']) }}); background-size: cover; background-position: center; height: 100vh;">
						<div class="container h-100">
							<div class="d-flex flex-column align-items-start justify-content-center text-center h-100 pb-5">
								<h3 class="position-relative text-color-white text-5 line-height-5 font-weight-semibold mb-2 appear-animation" data-appear-animation="fadeInDownShorter" data-plugin-options="{'minWindowWidth': 0}">
									<span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-6">
										
									</span>
									{{-- ১,৫০,০০০+  --}}
									{{-- প্রোফাইল থেকে --}}
                                    {{ translate('from_150000_profiles') }}
									<span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-6">
										
									</span>
								</h3>
								<h1 class="text-color-white font-weight-extra-bold text-12 mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">
									{{-- আপনার জীবনসঙ্গী খুজুন --}}
									{{ translate('find_your_life_partner') }}
								</h1>
								<p class="text-4-5 text-color-white font-weight-light opacity-7 mb-4" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0}">
									{{-- সারাবিশ্বের ৩ মিলিয়ন ব্যবহারকারির মিলনমেলায় আপনাকে স্বাগতম --}}
									{{ translate('welcome_to_the_forum_of__three_million_users_worldwide') }}

								</p>
                                <div class="d-flex">
									@if(Auth::check())
								<a  href="{{ route('userrole.dashboard')}}" data-toggle="modal" data-target="#exampleModalLong" class="btn btn-primary btn-modern font-weight-bold text-3 btn-py-3 px-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1500" data-plugin-options="{'minWindowWidth': 0}">
									{{ translate('my_dashboard')}}
								<i class="fas fa-arrow-right ms-2"></i></a>
								@else
								<a  href="{{ route('register')}}" data-toggle="modal" data-target="#exampleModalLong" class="btn btn-primary btn-modern font-weight-bold text-3 btn-py-3 px-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1500" data-plugin-options="{'minWindowWidth': 0}">
								 {{ translate('join_now')}}
									 <i class="fas fa-arrow-right ms-2"></i></a>
								@endif

								<a  href="https://api.whatsapp.com/send?phone={{$ws->contact_mobile}}" data-toggle="modal" data-target="#exampleModalLong" class="btn btn-primary btn-modern font-weight-bold text-3 btn-py-3 px-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1500" data-plugin-options="{'minWindowWidth': 0}" style="margin-left: 5px;"><i class="fab fa-whatsapp "></i>  {{ translate('call_now')}}</a>

								</div>

								


						
							
							</div>
						</div>
					</section>

                     @include('frontend::layouts.homeHeader')
				</div>


				{{-- <section class="call-to-action call-to-action-default with-button-arrow call-to-action-in-footer">
					<div class="container">
						<div class="row">
							<div class="col-sm-9 col-lg-9">
								<div class="call-to-action-content">
									<h3>Porto is <strong class="font-weight-extra-bold">everything</strong> you need to create a <strong class="font-weight-extra-bold">website!</strong></h3>
									<p class="mb-0">The Best HTML Site Template on ThemeForest</p>
								</div>
							</div>
							<div class="col-sm-3 col-lg-3">
								<div class="call-to-action-btn">
									<a href="http://themeforest.net/item/porto-responsive-html5-template/4106987" target="_blank" class="btn btn-modern text-2 btn-primary">Buy Now</a><span class="arrow hlb d-none d-md-block appear-animation animated rotateInUpLeft appear-animation-visible" data-appear-animation="rotateInUpLeft" style="left: 110%; top: -40px; animation-delay: 100ms;"></span>
								</div>
							</div>
						</div>
					</div>
				</section> --}}

				{{-- <section class="call-to-action with-borders with-button-arrow mb-5">
					<div class="col-12">
						<div class="call-to-action-content text-center">
							<h3 class="">Porto is <strong class="font-weight-extra-bold">everything</strong> you need to create a <strong class="font-weight-extra-bold">website!</strong></h3>
							<a href="{{ asset('/NilofaMarriageMedia') }}" target="_blank" 
							class="btn text-2 text-white" style="background-color: #FD017C;">Nilofa Marrige Media</a>
						</div>
					</div>
				
				</section> --}}


				<section class="call-to-action with-borders button-centered mb-5">
					<div class="col-12">
						<div class="call-to-action-content">
							<h3>MarrigeMatchBd.Com পরিচালিত হচ্ছে Nilofa Marriage Media দ্বারা.</h3>
							
							
						</div>
					</div>
					<div class="col-12">
						<div class="call-to-action-btn">
							<a href="{{ asset('/NilofaMarriageMedia') }}" target="_blank" 
							class="btn text-2 text-white" style="background-color: #FD017C;">Nilofa Marrige Media</a>
						</div>
					</div>
				</section>
				

				@includeIf('successstory::frontend.story.stories')


				@includeIf('membership::frontend.membershipPackage.packages')

				

				 <section style="background-color: #F5F4FE">
					<div class="container">
						<div class="row pt-5">
							<div class="col">
								<div class="row text-center pb-5">
									<div class="col-md-12 mx-md-auto">
										<div class="overflow-hidden mb-3">
											<h1 class="word-rotator slide font-weight-bold text-8 mb-0">
												<span>{{ translate('about_us') }}</span>
												
											</h1>
										</div>
										<div class="mb-3">
											<p class="text-4 mb-0 text-justify">

												@php
												$aboutUs =  Cp\Menupage\Models\Page::whereActive(true)->where('id', 3)->first();
												@endphp

											    @if(isset($aboutUs))
                                                      @foreach ($aboutUs->pageItems as $item){!! $item->description !!}@endforeach
												@endif
												{{-- মেরিজ মেচ বিডি একটি বাংলাদেশি ম্যাট্রিমোনিয়াল সাইট, যা বিবাহিত ব্যক্তিদের সমন্বয় করার জন্য প্রতিষ্ঠিত হয়েছে। এই সাইটে বিবাহের জন্য নিবন্ধন করে থাকা প্রোফাইল হয়ে থাকে সদস্যদের। এই প্রোফাইলগুলি মূলত লোকালি সংগঠিত এবং বাংলাদেশের বিভিন্ন অঞ্চল থেকে সংগৃহীত হয়। <br> <br>

												মেরিজ মেচ বিডি একটি একত্রিকরণ প্ল্যাটফর্ম, যা প্রতিষ্ঠানগুলির জন্য বৈবাহিক ম্যাচিং সেবা প্রদান করে। এই সাইটে আপনি নিজের প্রোফাইল তৈরি করতে পারবেন এবং অন্যদের প্রোফাইলগুলি অনুসন্ধান করে একজন সঙ্গী খুঁজতে পারবেন। এই সাইটে প্রদান করা তথ্য সাহায্যে আপনি সঙ্গী প্রার্থীদের সাথে যোগাযোগ করতে পারবেন এবং পছন্দমত সঙ্গীকে বাস্তব জীবনে মিলাতে পারবেন। <br> <br>

												আমাদের প্রাথমিক লক্ষ্য হলো ব্যক্তিগত পছন্দ এবং মান অনুযায়ী সঠিক সঙ্গী খুঁজে পাওয়া, যা সম্প্রসারণশীল, প্রেমাদেশ এবং সম্প্রসারণবাদ নির্ভর করে নয়। আমাদের সাইটটি একটি সুরক্ষিত ও নিরাপদ পরিবেশ প্রদান করে, যাতে আপনি আত্মবিশ্বাসে বিবাহের সন্ধান চালিয়ে যাতে পারেন। <br> 

												মেরিজ মেচ বিডি পরিচালনা করার জন্য আমাদের দক্ষ এবং পেশাদার দল আছে, যারা প্রতিটি সদস্যকে সম্পূর্ণ পছন্দ এবং সংগঠনীয় প্রযুক্তি ব্যবহার করে সঠিক সঙ্গী খুঁজে পাওয়ার জন্য সহায়তা করে। আমাদের মূল উদ্দেশ্য হলো আপনাকে সাহায্য করা এবং আপনার সঙ্গী খুঁজে পাওয়ার প্রক্রিয়াটিকে সুবিধাজনক এবং সুসংগঠিত করা। 

												আশা করি আপনি এখানে আপনার সঙ্গী খুঁজতে সফল হবেন এবং আপনার বাস্তব জীবনে বিবাহের আনন্দ উপভোগ করবেন। যদি আপনার কোন প্রশ্ন বা অভিযোগ থাকে, আপনি সরাসরি আমাদের সাথে যোগাযোগ করতে পারেন। ধন্যবাদ আমাদের সাইটটি ব্যবহার করার জন্য। --}}

												{{-- Marriage match bd is a Bangladeshi matrimony website with the project of offering high-quality matrimonial services at affordable charges to marriage seekers. Marriage match bd is a matchmaking platform committed to assisting men and women find out their soul mates. If you are looking for a bride or groom in a specific community, you have reached the proper wedding/matrimony portal. Marriage match bd has eligible singles from a huge community from throughout Bangladesh that will help you find the best matches. Marriage Match bd is also an outstanding place for marriage seekers who have particular options about their life partners. You can seek a bride and groom by religion, caste, city, education, hobbies, and many such choices. Sign-up without spending a dime to get access to limitless Bangladeshi brides and grooms. Choose your life partner from tens of thousands of matrimonial profiles and pictures of eligible singles. --}}
											</p>
										</div>
									</div>
								</div>

								{{-- <div class="row mt-3 mb-5">
									<div class="col-md-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="800">
										<h3 class="font-weight-bold text-4 mb-2">Why Choose Marriage Match BD?</h3>
										<p>Marriage Match BD has helped thousands of singles find their match. As one of the leading matrimonial sites, we are one of the largest and most trusted sites around. Not many other sites can offer you a membership database of over thousand members with the promise of introducing you to single men and women across the world.</p>
									</div>
									<div class="col-md-4 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="600">
										<h3 class="font-weight-bold text-4 mb-2">National & International Matrimonials Site - Trusted By Over 5 Thousand Couple</h3>
										<p>Marriage Match BD has helped thousands of singles find their match. As one of the leading matrimonial sites, we are one of the largest and most trusted sites around. Not many other sites can offer you a membership database of over thousand members with the promise of introducing you to single men and women across the world.</p>
									</div>
									<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">
										<h3 class="font-weight-bold text-4 mb-2">Start Your Success Story On Marriage Match BD</h3>
										<p>As a premier site for marriages, we successfully bring together singles from around the world. Since 2006, thousands of happy men and women have met their soul mates on Marriage Match BD and have shared their stories with us. Check out the many success stories here. Let us help you fulfil your faith and earn your reward. Join today.</p>
									</div>

									<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">
										<h3 class="font-weight-bold text-4 mb-2">Discover & Communicate</h3>
										<p>Virtually meet thousands of like-minded singles and connect at lightning speed; on desktop, tablet, and your beloved phone. Chat into the wee hours of the night if you'd like. Post photos, share your interests and dreams-we'll help you look your best while you do it.</p>
									</div>

									<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">
										<h3 class="font-weight-bold text-4 mb-2">Save Time & Money</h3>
										<p>By the time you find a parking space and buy a drink, you've already spent a good deal of money and still haven't met anyone. Here we make it easy to meet folks and feel things out first–so when you do go on that first date, or meet for coffee, you can relax and be yourself.</p>
									</div>

									<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="800">
										<h3 class="font-weight-bold text-4 mb-2">Safety & Support</h3>
										<p>It can be rough out there in the wild. Here, you benefit from our internal review protocols, high-level encryption, and an entire community of fellow seekers who help weed out the haters. For more than 15 years, we've been helping people find love and form powerful, long-lasting partnerships.</p>
									</div>
								</div> --}}

							</div>
						</div>

					</div>
				</section>

				
				

				@includeIf('successstory::frontend.testimonial.testimonials')


				<section  style="background-color: #F5F4FE">
					<div class="container">
						<div class="featured-boxes featured-boxes-style-3 featured-boxes-flat">
					       <h2 class="font-weight-normal text-7 text-center pt-5">{{ translate('how_our_system_works') }}
							<p class="text-0">{{ translate('start_with_the_three_small_steps_below') }}</p>
						   </h2>
						   
							<div class="row">
								<div class="col-lg-4 col-sm-6">
									<div class="featured-box featured-box-primary featured-box-effect-3">
										<div class="box-content box-content-border-0">
											<i class="icon-featured far fa-user"></i>
											<h4 class="font-weight-normal text-5 mt-3">{{ translate('create_profile') }}</h4>
											<p class="mb-2 mt-2 text-2">Create your profile in seconds with our easy sign-up. Don't forget to add a photo!.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6">
									<div class="featured-box featured-box-secondary featured-box-effect-3">
										<div class="box-content box-content-border-0">
											<i class="icon-featured far fa-file-image"></i>
											<h4 class="font-weight-normal text-5 mt-3">{{ translate('visit_favorites_profile') }}</h4>
											<p class="mb-2 mt-2 text-2">Search our large member base with ease, with a range of preferences and settings.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6">
									<div class="featured-box featured-box-tertiary featured-box-effect-3">
										<div class="box-content box-content-border-0">
											<i class="icon-featured far fa-comments"></i>
											<h4 class="font-weight-normal text-5 mt-3">{{ translate('start_communicating') }}</h4>
											<p class="mb-2 mt-2 text-2">Send a message or interest to start communicating with members. It's your time to shine.</p>
										</div>
									</div>
								</div>
						
							</div>

						   <div class="pb-5 pt-3 text-center">
								<a href="#" class="btn text-white" style="background-color: #FD017C;">{{ translate('find_your_life_partner') }}</a>
						   </div>
					    </div>
					</div>
				</section>



                <section>
					<div class="container mb-5 mt-5">
						<div class="card-deck ">
							<div class="row">
                                <div class="col-md-6 mb-4">
									<div class="card shadow" style="min-height: 220px;">
										<div class="card-body- d-flex align-items-center justify-content-center">
											<iframe width="545" height="220px" src="https://www.youtube.com/embed/bTKqkO_2ASM?si=gCf-nqkdSot9wrMZ?modestbranding=1&rel=0&fs=0&disablekb=1&showinfo=0&autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
										</div>
									</div>
								</div>
								<div class="col-md-6">
                                   <div class="card shadow" style="min-height: 220px;">
										<div class="card-body d-flex align-items-center justify-content-center">
										<a href="{{ route('userrole.dashboard')}}">
											<img width="360" src="{{ route('imagecache', ['template' => 'original', 'filename' => 'sslecommerce.png']) }}" alt="sslecommerce">
										</a>
										</div>
										<a href="{{ route('userrole.dashboard')}}" class="btn text-white" style="background: #FD017C">{{ translate('click_the_button_for_online_payment') }}</a>
										
								    </div>
								</div>
								
							</div>
							
							
						</div>
					</div>
				</section>
			</div>

			 @include('frontend::layouts.homeFooter')
		</div>

		<!-- Vendor -->
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

	</body>
</html>
