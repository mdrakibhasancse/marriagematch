@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)


@section('content')

<div role="main" class="main pt-3 mt-3">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class="text-dark"><strong>Career Opportunity</strong></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="section border-0 m-0" style="background-color: #fefeff !important">
        <div class="container">

            <div class="row pb-4">
                <div class="col-md-8">
                    <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="200">
                        <div class="accordion accordion-modern accordion-modern-grey-scale-1 without-bg mt-2" id="accordion">
                            @foreach ($jobPosts->take(1) as $jobPost)
                            <div class="card card-default mb-2">
                                <div class="card-header">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-3" data-bs-toggle="collapse" data-bs-parent="#accordion{{ $jobPost->id}}" href="#collapse{{ $jobPost->id}}">
                                           {{$jobPost->title}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$jobPost->id}}" class="collapse show">
                                    <div class="card-body mt-3">
                                        <p>{!! $jobPost->excerpt !!}</p>

                                        <ul class="list list-inline mt-4 mb-3 text-2">
                                             <li class="list-inline-item">
                                                <strong>Designation:</strong>
                                                {{ $jobPost->designation }}
                                            </li>
                                            {{-- <li class="list-inline-item ms-md-3">
                                                <strong>Location:</strong>
                                                {{ $jobPost->designation }}
                                            </li> --}}
                                        </ul>

                                        <a href="{{ route('applyForJop',$jobPost->id)}}" class="btn btn-modern btn-dark">Apply</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                             @foreach ($jobPosts->skip(1) as $jobPost)
                             <div class="card card-default mb-2">
                                <div class="card-header">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-3" data-bs-toggle="collapse" data-bs-parent="#accordion{{ $jobPost->id}}" href="#collapsen{{ $jobPost->id}}">
                                           {{$jobPost->title}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsen{{$jobPost->id}}" class="collapse">
                                    <div class="card-body mt-3">
                                       <p>{!! $jobPost->description !!}</p>

                                        <ul class="list list-inline mt-4 mb-3 text-2">
                                            <li class="list-inline-item">
                                                <strong>Designation:</strong>
                                                {{ $jobPost->designation }}
                                            </li>
                                            {{-- <li class="list-inline-item ms-md-3">
                                                <strong>QUALIFICATION:</strong>
                                                3+ YEARS EXPERIENCE, GRADUATION
                                            </li> --}}
                                        </ul>

                                        <a href="{{ route('applyForJop',$jobPost->id) }}" class="btn btn-modern btn-dark">Apply</a>
                                    </div>
                                </div>
                             </div>
                             @endforeach
                        </div>
                    </div>

                </div>
                
            </div>

        </div>
    </section>
</div>

@endsection









































