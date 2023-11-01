<footer id="footer" class="footer-texts-more-lighten p-0 m-0">
	<div class="container">
		<div class="row py-5">
			<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
				<h4 class="text-5 mb-3 text-color-light">Useful Links</h4>
				<ul class="list list-unstyled mb-0">
					<li class="mb-1"><a class="text-4 text-color-light" href="{{ route('allPackages')}}">Packages</a></li>
				
					<li class="mb-1"><a class="text-4 text-color-light"  href="{{ route('allStories')}}">Success Story</a></li>
					<li class="mb-1"><a class="text-4 text-color-light" href="https://marriagematchbd.com/blog">Blog</a></li>
					<li class="mb-1"><a class="text-4 text-color-light"  href="{{ route('allTestimonials')}}">Testimonial</a></li>
				</ul>
			</div>
			<div class="col-md-6 col-lg-4 mb-4 mb-md-0">
				<h5 class="text-5 mb-3 text-color-light">CONTACT US</h5>
				<ul class="list list-icons list-icons-lg">
					<li class="mb-1"><i class="far fa-dot-circle text-color-light"></i><p class="m-0 text-color-light">{{$ws->contact_address}}</p></li>
					<li class="mb-1"><i class="fab fa-whatsapp text-color-light"></i><p class="m-0"><a class="text-color-light" href="tel:{{$ws->footer_contact}}">{{$ws->footer_contact}}</a></p></li>
					<li class="mb-1"><i class="far fa-envelope text-color-light"></i><p class="m-0"><a class="text-color-light" href="mailto:{{$ws->contact_email}}">{{$ws->contact_email}}</a></p></li>
				</ul>
			</div>

			<div class="col-md-6 col-lg-3">
				<h5 class="text-5 mb-3 text-color-light">Support</h5>
				<ul class="list list-unstyled mb-0">
				<li class="mb-1"><a class="text-4 text-color-light" href="https://marriagematchbd.com/page/12/user-manual">User Manual</a></li>
				<li class="mb-1"><a class="text-4 text-color-light"  href="https://marriagematchbd.com/page/9/about-us">About Us</a></li>
				<li class="mb-1"><a class="text-4 text-color-light" href="https://marriagematchbd.com/page/10/privacy-policy">Privacy Policies</a></li>
				<li class="mb-1"><a class="text-4 text-color-light"  href="https://marriagematchbd.com/page/11/terms-regulation">Terms and Conditions</a></li>
				<li class="mb-1"><a class="text-4 text-color-light" href="">Payment Option</a></li>
				<li class="mb-1"><a class="text-4 text-color-light"  href="https://marriagematchbd.com/page/2/contact-us">Contact</a></li>
				
				</ul>
			</div>

			
			<div class="col-md-6 col-lg-2">
				<h5 class="text-5 mb-3 text-color-light">FOLLOW US</h5>
				<ul class="header-social-icons social-icons">
					<li class="social-icons-instagram">
						<a href="https://www.instagram.com/marriagematchbd/?hl=en" class="no-footer-css" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
					</li>
					<li class="social-icons-linkedin mx-2">
						<a href="https://bd.linkedin.com/in/marriage-match-bd-97bb711b9" class="no-footer-css" target="_blank" title="Linkedin"><i class="fab fa-linkedin"></i></a>
					</li>
					<li class="social-icons-facebook">
						<a href="https://www.facebook.com/MarriageMatchBdCom/" class="no-footer-css" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
					</li>

					<li class="social-icons-youtube">
						<a href="https://www.youtube.com/channel/UCm4OXVKHNztjFKHkakOc9pw" class="no-footer-css" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
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
					<div class="col-sm-12">
						<div class="text-center">
							<p class="text-white py-1">

								&copy; Copyright {{ date('Y')}} | Marriage Match BD | Developed By : <a class="text-white" href="https://a2sys.co/" title="a2sys">a2sys</a>

								{{-- <br>
								<a href="{{ route('userrole.dashboard')}}">
									<img width="290" class="rounded" src="{{ route('imagecache', ['template' => 'original', 'filename' => 'sslecommerce.png']) }}" alt="sslecommerce" alt="Pay">
								</a> --}}
							</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</footer>


