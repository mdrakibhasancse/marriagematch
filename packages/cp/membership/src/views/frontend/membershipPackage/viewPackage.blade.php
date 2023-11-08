@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)
@section('content')

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm mb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1 class="text-dark"><strong>{{ translate('package_details') }}</strong></h1>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="featured-boxes featured-boxes-style-3 featured-boxes-flat">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="featured-box featured-box-effect-3">
                        <div class="box-content box-content-border-0 shadow-lg">
                            {{-- <i class="icon-featured far fa-user"></i> --}}
                            <img class="icon-featured" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $package->fi()]) }}" alt="">
                                <h4 class="card-title text-color-primary mt-2 mb-2 text-5 font-weight-bold">
                                    {{ translate($package->title) }}
                                </h4>
                            <h4 class="card-title mt-2 mb-2 text-5 font-weight-bold"> {{translate($package->final_price)}} {{translate('bdt')}}</h4>
                            <h4 class="card-title mt-2 mb-4 text-5 font-weight-bold">{{translate('duration')}} ({{translate($package->duration)}} {{translate('day')}})</h4>
                                
                            <div class="text-start">
                                <ul class="list list-icons list-icons-md px-2 text-2 ">
                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                        <i class="fa fa-check-circle" style="color: #00934D;"></i>
                                        <span>{{translate($package->daily_proposal_sent)}} {{translate('proposals')}} ({{translate('day')}})</span>
                                        </span>
                                    </li>
                                    <li class="text-3-5  mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span >{{translate('total_proposals')}} {{translate($package->total_proposal_sent)}} </span>

                                        </span>
                                    
                                    </li>
                                
                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                    <span>
                                        <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                        <span class="mt-1">{{translate('view_daily')}} {{translate($package->daily_contact_limit)}} 
                                          {{-- {{translate('contact')}} --}}
                                        </span>
                                    </span>
                                    </li>
                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span >
                                                  {{translate('view_total')}} {{translate($package->total_contact_limit)}} 
                                                   {{-- {{translate('contact')}} --}}
                                            </span>
                                        </span>
                                    </li>

                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span >
                                                {{translate('cv_collect')}}
                                                {{translate($package->daily_cv_collect_limit)}}
                                            </span>
                                        </span>
                                    </li>

                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span >  
                                                {{translate('view_total_cv_collect')}} {{translate($package->total_cv_collect_limit)}}
                                            </span>
                                        </span>
                                    </li>

                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span >{{translate('daily')}} {{translate('matched_profile')}} {{translate($package->daily_matched_profile_sent)}}</span>
                                        </span>
                                    </li>

                                    <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span >{{translate('total')}} {{translate('matched_profile')}} 

                                                {{translate($package->total_matched_profile_sent)}}
                                            
                                            </span>
                                        </span>
                                    </li>

                                    {{-- <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                        <span>
                                            <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                            <span>{{translate('package_description')}}:

                                             {{translate($package->description)}}
                                            
                                            </span>
                                        </span>
                                    </li> --}}
                                     <p class="card-text text-justify text-4" style="padding-left: 4px !important; background:#f8f8f8;"></p>
                                </ul>

                                <div class="form-group" style="padding-left: 7px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  name="agree" id="Checkbox" checked>
                                        <label class="form-check-label" for="Checkbox">
                                           <a href="{{asset('/')}}page/11/terms-regulation" class="w3-text-gray text-decoration-none">{{translate('i_agree_the_terms_and_conditions')}}</a>
                                        </label>
                                    </div>
                                </div>
                               
                            </div>


                                                     


                            <form method="post" action="{{route('membership.packageOrder',$package->id)}}">
                                @csrf
                            
                                <div class="text-center mt-4 pt-2">
                                    <button type="submit" class="btn border-0 font-weight-semi-bold positive-ls-1 text-2-5 px-5 py-3 text-white text-uppercase  {{$pendingOrder != null ? "disabled" : " "}}" style="background-color: #FD017C;">{{ translate('order_now') }}
                                    </button>
                                    <br>
                                    @if($pendingOrder != null)
                                        <a href="{{ route('membership.myOrderDeatils',$pendingOrder->id)}}">{{ translate('you_have_pending_order') }}</a>
                                    @endif
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection