<div class="container mb-5 mt-5">
    @if($packages->count() > 0)
	<h2 class="font-weight-normal text-8 text-center">{{ translate('our_packages') }}</h2>
    @endif
	<div class="row pb-2">
       
         @include('membership::frontend.membershipPackage.packgePart')      
    
	
	</div>

	
	<div class="pt-5 text-center">
        <a href="{{ route('allPackages')}}" class="btn text-white" style="background-color: #FD017C;">{{ translate('see_all') }}</a>
    </div>


	
</div>

