
@include('membership::user.includes.paymentButton')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> {{ucwords(str_replace('_', ' ', request()->type))}}
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="row">
            @foreach ($users as $user)
              @include('membership::user.includes.userProfileCard')
            @endforeach
        </div>
      
    </div>
</div>
