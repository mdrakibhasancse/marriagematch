<div class="col-md-6 my-1">
    <div class="card" style="min-height: 230px;">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ route('imagecache', ['template' => 'ppnmd', 'filename' => $user->fi()]) }}" alt="user_profile">
            </div>
           <div class="col-md-7">
             <div class="row">
                <div class="card-body">
                        <h4 class="font-weight-bold text-4">{{$user->name ?? null}}
                    ({{ $user->id ?? null }})
                    </h4>
                    <hr  style="border: -0.5em solid rgb(224, 222, 222);
                    margin: 10px 0px 10px; 0px;">
                    <small style="font-size: 14px;">{{$user->age()}}years,
                        @if($user->profile)
                          {{$user->profile->gender}},
                        @endif 
                      
                        @if($user->profile)
                          {{$user->profile->height }},
                        @endif 
                        @if($user->profile)
                            {{$user->profile->birth_country}},
                        @endif 

                        @if($user->profile)
                            {{$user->profile->birth_city }},
                        @endif 

                        @if($user->profile)
                            {{$user->profile->profession ?? 'Not Working'}},
                        @endif 
                        others...
                    </small> 
                    


                    <div class="d-flex justify-content-start py-2">
                        <div class="mr-3">
                            <a class="btn btn-rounded card-text py-2 fav-contact" style="border: 1px solid gray" href="{{ route('membership.contactProfile',$user->id) }}" > <i class="fas fa-phone-alt w3-small {{auth()->user()->isMyContact($user->id) ? 'w3-text-red' : 'w3-text-blue'}}"></i></a> <br>
                            <span style="white-space:nowrap; font-size:9px">
                                Contact</span>
                        </div>
                        <div class="mr-3">
                            <a class="btn btn-rounded card-text py-2 fav-user" style="border: 1px solid gray" href="{{ route('membership.favouriteProfile',$user->id )}}"> <i class="fas fa-heart w3-small {{auth()->user()->isMyFavourite($user->id ) ? 'w3-text-red' : 'w3-text-blue'}}"></i></a> <br>
                            <span style="white-space:nowrap; font-size:9px">Favourite</span>
                        </div>
                        <div class="mr-3">
                            <a class="btn btn-rounded card-text py-2 " style="border: 1px solid gray" href="{{ route('membership.messageDashboard', ['userto' => $user]) }}" > <i class="fas fa-comment-alt w3-small w3-text-blue" ></i></a> <br>
                            <span style="white-space:nowrap; font-size:9px">
                                Message</span>
                        </div>

                         <div>
                            <button class="btn btn-rounded card-text py-2 proposalSend" data-toggle="modal" data-target="#proposalSentModal" data-url="{{ route('membership.proposalModal', ['user'=>$user->id])}}" style="border: 1px solid gray" >
                               <i class="fas fa-restroom w3-small {{auth()->user()->isMyProfosal($user->id ) ? 'w3-text-red' : 'w3-text-blue'}}"></i>
                            </button> <br>
                            <span style="white-space:nowrap; font-size:9px">
                                Propsals</span>
                        </div>

                    </div>
                    <div>
                        <span> {{ Str::limit($user->profile->about_myself ?? null, 40, '...') }}</span>
                        <a class="card-text py-2 " href="{{ route('membership.viewProfile',$user->id)}}">
                            More</a>
                    </div>
                </div>    
            </div>  
          </div>
        </div>
    </div>    
</div>



   