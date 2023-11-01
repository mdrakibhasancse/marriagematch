@push('css')    
        <style>
           .btn-grad {
            background-image: linear-gradient(to right, #ff9800 0%, #FD017C  51%, #ff9800  100%);
            margin: 10px;
            text-align: center;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
        </style> 
@endpush

<div class="row">
    <div class="col-12">
        <p class="">
        
    
        <div class="btn-group">
          <button type="button" class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1  dropdown-toggle
            {{((request()->type == 'pending_proposal_from_me'  or (request()->type == 'pending_proposal_to_me') 
            or (request()->type == 'proposal_from_me') 
            or (request()->type == 'proposal_to_me')) ? "bg-primary" : " ")
            }}" data-toggle="dropdown">
            {{-- Propsal --}}
               {{ translate('propsal') }}
          </button>
          <div class="dropdown-menu">
              <a href="{{route('membership.myProfileDetails',['type'=>'pending_proposal_from_me'])}}" class="dropdown-item w3-bar-item w3-button">
                {{-- Pending From Me --}}
                  {{ translate('pending_from_me') }}
              </a>
              <a href="{{route('membership.myProfileDetails',['type'=>'pending_proposal_to_me'])}}" class="dropdown-item w3-bar-item w3-button">
                {{-- Pending To Me --}}
                  {{ translate('pending_to_me') }}
              </a>
              <a href="{{route('membership.myProfileDetails',['type'=>'proposal_from_me'])}}" class="dropdown-item w3-bar-item w3-button">
                {{-- From Me --}}
                 {{ translate('to_me') }}
              </a>
              <a href="{{route('membership.myProfileDetails',['type'=>'proposal_to_me'])}}" class="dropdown-item w3-bar-item w3-button">
                {{-- To Me --}}
                {{ translate('to_me') }}
              </a>
          </div>
        </div>
       
        <a href="{{ route('userrole.dashboard') }}" class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1
        {{ str_contains(url()->current(), 'user/dashboard') ? 'bg-primary' : '' }}"><i class="fas fa-home"></i>
          </a>


        <a href="{{route('membership.myProfileDetails',['type'=>'latest_profiles'])}}" class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1 {{request()->type == 'latest_profiles' ? 'bg-primary' : ''}}">
          {{-- Latest Profiles --}}
           {{ translate('latest_profiles') }}
        </a>

        <a href="{{route('membership.myProfileDetails',['type'=>'visitors'])}}"  class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1 {{request()->type == 'visitors' ? 'bg-primary' : ''}}">
          {{-- My Visitors --}}
          {{ translate('my_visitors') }}
        </a>

        <a href="{{route('membership.myProfileDetails',['type'=>'visiteds'])}}"  class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1 {{request()->type == 'visiteds' ? 'bg-primary' : ''}}">
          {{-- My Visited --}}
           {{ translate('my_visited') }}
        </a>

        <a href="{{route('membership.myProfileDetails',['type'=>'favourites'])}}"  class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1 {{request()->type == 'favourites' ? 'bg-primary' : ''}}">
          {{-- My Favourite Users --}}
           {{ translate('my_favourite_users') }}
        </a>

        <a href="{{route('membership.myProfileDetails',['type'=>'contacts'])}}"  class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1 {{request()->type == 'contacts' ? 'bg-primary' : ''}}">
          {{-- My Contact --}}
             {{ translate('my_contact') }}
        </a>


      <a href="{{route('membership.myProfileDetails',['type'=>'my_matched'])}}" class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white  my-1
       {{request()->type == 'my_matched' ? 'bg-primary' : ''}}">
       {{-- My Matched --}}
        {{ translate('my_matched') }}
      </a>

    
        <a href="{{ route('membership.messageDashboard')}}" class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1
        {{ str_contains(url()->current(), 'message/dashboard') ? 'bg-primary' : '' }}">
        {{-- My Message  --}}
         {{ translate('my_message') }}
        ({{ Auth::user()->unreadMsgUsersCount() }})
      </a>
        

        <a href="{{ route('allPackages') }}" class="w3-btn w3-round w3-medium shadow-lg btn-grad  my-1 mx-2
        {{ str_contains(url()->current(), 'all-packages') ? 'bg-primary' : '' }}" >
        {{-- MemberShip Package --}}
         {{ translate('membership_package') }}
        </a>

        <a href="{{ route('membership.myOrders') }}" class="w3-btn w3-round w3-medium shadow-lg btn-grad  my-1 mx-2
        {{ str_contains(url()->current(), 'my/orders') ? 'bg-primary' : '' }}">
        {{-- My Orders --}}
          {{ translate('my_orders') }}
      
        </a>


        <a href="{{route('membership.profileSearch')}}"  class="w3-button w3-medium w3-white w3-round shadow-lg w3-hover-orange w3-hover-text-white mx-2 my-1 {{ str_contains(url()->current(), 'profile/search') ? 'bg-primary' : '' }}">
          {{-- Search --}}
          {{ translate('search') }}
        </a>

        <br> 
        <br> 

    </div>
</div>