  @foreach ($packages as $package)
            <div class="col-md-3 appear-animation pt-4" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                <div class="card custom-card-style-1 shadow-lg card bg-color-light box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                    <div class="card-body py-5">
                        <h3 class="text-color-primary text-center font-weight-medium text-4 pb-1 mb-4">{{$package->title}}</h3>
                        <div class="price d-flex align-items-end justify-content-center font-weight-bold text-color-dark text-6 line-height-1 pb-1 mb-3">
                            <span class="price-unit font-weight-normal position-relative bottom-6">BDT {{$package->final_price}}</span>
                            
                        </div>
                            <ul class="list list-icons list-icons-md px-2 text-2 ">
                                <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                    <span>
                                      <i class="fa fa-check-circle" style="color: #00934D;"></i>
                                      <span>{{$package->daily_proposal_sent}} Proposals (Day)</span>
                                    </span>
                                </li>
                                <li class="text-3-5  mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                    <span>
                                        <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                        <span >{{$package->total_proposal_sent}} Total Proposals </span>

                                    </span>
                                   
                                </li>
                                <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                    <span>
                                        <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                        <span >Duration ({{$package->duration}} Days)</span>
                                    </span>
                                </li>
                                <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                   <span>
                                       <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                       <span class="mt-1">View Daily {{$package->daily_contact_limit}} Contact</span>
                                   </span>
                                </li>
                                <li class="text-3-5 mb-1" style="padding-left: 4px !important; background:#f8f8f8;">
                                    <span>
                                        <i class="fa fa-check-circle" style="color: #00934D"></i> 
                                        <span >View Total {{$package->total_contact_limit}} Contact</span>
                                    </span>
                                </li>
                            </ul>
                            
                            <div class="text-center mt-4 pt-2">
                                <a href="{{route('viewPackage',$package->id)}}" class="btn border-0 font-weight-semi-bold positive-ls-1 text-2-5 px-5 py-3 text-white" style="background-color: #FD017C;">{{ translate('continue') }}</a>
                            </div>
                
                    </div>
                </div>
            </div>
        @endforeach 