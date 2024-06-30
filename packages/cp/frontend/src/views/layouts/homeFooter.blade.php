<footer id="footer" class="footer-texts-more-lighten p-0 m-0">
	<div class="container">
		<div class="row py-5">
			<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
				<h4 class="text-5 mb-3 text-color-light">{{ translate('useful_links') }}</h4>
				<ul class="list list-unstyled mb-0">
					<li class="mb-1"><a class="text-4 text-color-light" href="{{ route('allPackages')}}">{{ translate('our_packages') }}</a></li>
				
					<li class="mb-1"><a class="text-4 text-color-light"  href="{{ route('allStories')}}">{{ translate('success_story') }}</a></li>
					<li class="mb-1"><a class="text-4 text-color-light" href="{{asset('/')}}blog">{{ translate('blog') }}</a></li>
					<li class="mb-1"><a class="text-4 text-color-light"  href="{{ route('allTestimonials')}}">{{ translate('testimonial') }}</a></li>
				</ul>
			</div>
			<div class="col-md-6 col-lg-4 mb-4 mb-md-0">
				<h5 class="text-5 mb-3 text-color-light">{{ translate('contact_us') }}</h5>
				<ul class="list list-icons list-icons-lg">
					<li class="mb-1"><i class="far fa-dot-circle text-color-light"></i><p class="m-0 text-color-light">{{$ws->contact_address}}</p></li>
					<li class="mb-1"><i class="fab fa-whatsapp text-color-light"></i><p class="m-0"><a class="text-color-light" href="tel:{{$ws->footer_contact}}">{{$ws->footer_contact}}</a></p></li>
					<li class="mb-1"><i class="far fa-envelope text-color-light"></i><p class="m-0"><a class="text-color-light" href="mailto:{{$ws->contact_email}}">{{$ws->contact_email}}</a></p></li>
				</ul>
			</div>

			<div class="col-md-6 col-lg-3">
				<h5 class="text-5 mb-3 text-color-light">{{ translate('support') }}</h5>
				<ul class="list list-unstyled mb-0">
				<li class="mb-1"><a class="text-4 text-color-light" href="{{asset('/')}}page/6/user-manual">{{ translate('user_manual') }}</a></li>
				<li class="mb-1"><a class="text-4 text-color-light"  href="{{asset('/')}}page/3/about-us">{{ translate('about_us') }}</a></li>
				<li class="mb-1"><a class="text-4 text-color-light" href="{{asset('/')}}page/4/privacy-policy">{{ translate('privacy_policies') }}</a></li>
				<li class="mb-1"><a class="text-4 text-color-light"  href="{{asset('/')}}page/5/terms-regulation">{{ translate('terms_and_conditions') }}</a></li>
				<li class="mb-1"><a class="text-4 text-color-light" href="">{{ translate('payment_option') }}</a></li>
				{{-- <li class="mb-1"><a class="text-4 text-color-light"  href="{{asset('/')}}page/2/contact-us">{{ translate('contact_us') }}</a></li> --}}
				
				</ul>
			</div>

			
			<div class="col-md-6 col-lg-2">
				<h5 class="text-5 mb-3 text-color-light">{{ translate('follow_us') }}</h5>
				<ul class="header-social-icons social-icons">
					<li class="social-icons-instagram">
						<a href="https://www.instagram.com/marriagematchbd/?hl=en" class="no-footer-css" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
					</li>
					<li class="social-icons-linkedin mx-2">
						<a href="{{$ws->linkedin_url}}" class="no-footer-css" target="_blank" title="Linkedin"><i class="fab fa-linkedin"></i></a>
					</li>
					<li class="social-icons-facebook">
						<a href="{{$ws->fb_url}}" class="no-footer-css" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
					</li>

					<li class="social-icons-youtube">
						<a href="{{$ws->youtube_url}}" class="no-footer-css" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
					</li>
				</ul>
				<br>
			
			</div>
			
					
		</div>	
	</div>
	

	<div class="footer-copyright  bg-color-scale-overlay bg-color-scale-overlay-2">
		<div class="bg-color-scale-overlay-wrapper">
			<div class="container py-2">
				<div class="row">
					<div class="d-flex justify-content-between">
						<div class="py-2">
							
							<p class="text-white py-1">
								<img alt="mmbd" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $ws->logo()]) }}">&nbsp;
								&copy; Copyright 2017 - {{ date('Y')}} | Marriage Match BD | Developed By : <a class="text-white" href="https://a2sys.co/" title="a2sys">a2sys</a>
							</p>

						</div>
						<div class="py-2">
							<nav id="sub-menu">
                            <ul>
                                <li class="border-0"><i class="fas fa-angle-right text-color-light"></i><a href="{{ route('sitemap') }}" class="ms-1 text-decoration-none text-color-light"> Sitemap</a></li>
                                <li class="border-0"><i class="fas fa-angle-right text-color-light"></i><a href="{{asset('/')}}page/2/contact-us" class="ms-1 text-decoration-none text-color-light"> {{ translate('contact_us') }}</a></li>
                            </ul>
                        </nav>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</footer>


