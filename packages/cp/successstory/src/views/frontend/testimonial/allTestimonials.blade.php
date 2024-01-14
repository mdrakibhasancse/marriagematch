@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)
@section('content')

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm mb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1 class="text-dark"><strong>{{ translate('testimonial') }}</strong></h1>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5 mt-5">
    <div class="row pb-2">
        @foreach($testimonials as $testimonial)
        <div class="col-md-3 col-12 mb-5 mb-lg-0 pt-4">
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
  
    <div class="pt-5 text-start">
       {{$testimonials->render()}}
    </div>


</div>
@endsection