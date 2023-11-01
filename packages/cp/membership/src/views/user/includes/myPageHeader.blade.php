@if((!Auth::user()->profile) or (Auth::user()->profile and Auth::user()->profile->religion_id == null))
<div class="info-box shadow-lg p-1">
    <span class="info-box-icon bg-primary"><i class="far fa-user-circle"></i></span>
    <div class="info-box-content">
        <span class="info-box-text my-0 font-size-text">{{ translate('welcome') }}, {{ Auth::user()->name}}</span>
        <span class="info-box-number my-0 font-size-text">{{ translate('you_have_no_profile') }}</span> 

        <span>
            <a class="btn btn-primary btn-sm" href="{{route('user.newProfileCreate')}}"> {{ translate('create_a_profile_now') }}</a>
        </span>

    </div>
  
</div>



@elseif(Auth::user()->profile && Auth::user()->profile->checked == 0)
    <div class="info-box shadow-lg p-1">
    <span class="info-box-icon bg-primary"><i class="far fa-user-circle"></i></span>
    <div class="info-box-content">
        <span class="info-box-text my-0 font-size-text">{{ translate('welcome') }}
            , {{ Auth::user()->name}}</span>
        <span class="info-box-number my-0 font-size-text">
            {{-- আপনার সাবমিট করা প্রোফাইল ইনফরমেশন পেন্ডিং রয়েছে --}}
                {{ translate('your_submitted_profile_information_is_pending') }}
        </span> 

        <div class="row mb-2">
            <div class="col-md-6">
                <a href="tel:{{ $ws->contact_mobile}}" class="btn btn-sm btn-primary btn-block">
                      {{ translate('contact_admin_for_approval') }}
                </a>
            </div>
        </div>
            
        <div class="row d-flex justify-content-between">
            <div class="col-md-6">
                <a href="{{ route('membership.profileInfoUpdate')}}" class="btn btn-primary btn-sm mb-2 btn-block">
                     {{ translate('please_update_your_information_again') }}
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('membership.myProfileDetails',['profile']) }}" class="btn btn-primary btn-sm float-right">{{ translate('profile_details') }}</a>
            </div> 
        </div>
    </div>
    </div>
@endif


@if(Auth::user()->profile && Auth::user()->profile->checked == 1)
 
    <div class="card shadow-lg">
        <div class="card-body row">
            <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
            <div class="">
            
                <img  style="width:80%" src="{{ route('imagecache', ['template' => 'pnism', 'filename' => Auth::user()->fi()]) }}" class="img-fluid img-circle" alt="Profile">
                <br><br>
                <a href="{{ route('membership.myProfileDetails',['profile']) }}" class="btn btn-primary">{{ translate('profile_details') }}</a>
                
            
            </div>
                
            </div>
            <div class="col-md-8">
                <dl class="row pt-3">
                    <dt class="col-4">Name </dt>
                    <dd class="col-8"><span class="mr-2">:</span>{{ Str::ucfirst(Auth::user()->name) }} ({{ Auth::user()->id }})</dd>
                    <dt class="col-4">Age </dt>
                    <dd class="col-8"><span class="mr-2">:</span>{{ Auth::user()->age() }}</dd>
                    <dt class="col-4">Marital Status </dt>
                    <dd class="col-8"><span class="mr-2">:</span>
                    {{ Str::ucfirst(Auth::user()->profile->marital_status) }}
                    </dd>
                    <dt class="col-4">Education Level </dt>
                    <dd class="col-8"><span class="mr-2">:</span>
                            {{ Str::ucfirst(Auth::user()->profile->education_level) }}
                    </dd>
                    <dt class="col-4">Height </dt>
                    <dd class="col-8"><span class="mr-2">:</span>
                            {{Auth::user()->profile->height }}
                    </dd>
                    <dt class="col-4">Gender </dt>
                    <dd class="col-8"><span class="mr-2">:</span>
                        {{ Str::ucfirst(Auth::user()->profile->gender) }}
                    </dd>
                    <dt class="col-4">Profile created by </dt>
                    <dd class="col-8"><span class="mr-2">:</span>
                            {{ Str::ucfirst(Auth::user()->profile->profile_created_by) }}
                    </dd>
                    <dt class="col-4">Profession </dt>
                    <dd class="col-8"><span class="mr-2">:</span>
                        {{ Str::ucfirst(Auth::user()->profile->profession) }}
                    </dd>
                </dl>
                
            </div>
        </div>
    </div>

@endif