<div class="container mb-5 mt-5">
    <h2 class="font-weight-normal text-7 text-center">{{ translate('testimonial') }}</h2>
    <div class="row pb-2">
        @foreach($testimonials->take(4) as $testimonial)
        <div class="col-md-3 col-12 mb-5 mb-lg-0 ">
            <div class="card shadow box-shadow">
                
                <img height="200" class="card-img-top" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $testimonial->fi()]) }}" alt="Card Image">
                <div class="card-body" style="padding:10px;min-height:180px;">
                    <h4 class="card-title text-4 font-weight-bold text-center"> {{ $testimonial->localeTitleShow() }}</h4>
                    <p class="card-text text-center">  
                    {{ Str::limit($testimonial->localeExcerptShow(), 130, '...') }}
                    </p>
                    
                </div>
                <div class="card-footer text-center" style="background-color: #FD017C;">
                    <a href="{{ route('viewStory',$testimonial->id)}}" class="text-color-white font-weight-semibold text-2" style="text-decoration: none">{{ translate('read_more') }}</a>
                </div>
            </div>
        </div>
        @endforeach
      

    </div>
 
    <div class="pt-5 text-center">
        <a href="{{ route('allTestimonials')}}" class="btn text-white" style="background-color: #FD017C;">{{ translate('see_all') }}</a>
    </div>


</div>