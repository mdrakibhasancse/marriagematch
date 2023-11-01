@include('membership::user.includes.myPageHeader')

@include('membership::user.includes.myTopButtons')

@include('membership::user.includes.paymentButton')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> 
            {{-- Latest Profiles --}}
            {{ translate('latest_profiles') }}
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="row">
            @foreach ($userProfiles as $user)
              @include('membership::user.includes.userProfileCard')
            @endforeach
        </div>
      
    </div>
</div>

@if(Auth::user()->profile)
@if($userVisitors->count() > 0)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> 
            Vistors
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="row">
            @foreach ($userVisitors as $user)
              @include('membership::user.includes.userProfileCard')
            @endforeach
        </div>
      
    </div>
</div>
@endif

@if($userVisiteds->count() > 0)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> 
            Visiteds
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="row">
            @foreach ($userVisiteds as $user)
              @include('membership::user.includes.userProfileCard')
            @endforeach
        </div>
      
    </div>
</div>
@endif

@if($userFavourites->count() > 0)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> 
            Favourites
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="row">
            @foreach ($userFavourites as $user)
              @include('membership::user.includes.userProfileCard')
            @endforeach
        </div>
      
    </div>
</div>
@endif

@if($userContacts->count() > 0)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> 
            Contacts
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="row">
            @foreach ($userContacts as $user)
              @include('membership::user.includes.userProfileCard')
            @endforeach
        </div>
      
    </div>
</div>
@endif

@endif



