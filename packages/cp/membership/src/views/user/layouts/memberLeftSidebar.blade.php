 <li class="nav-item  {{ session('lsbm') == 'userSettings' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-cog"></i>
      <p>
        Settings
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

        @if(Auth::user()->profile)
      
      <li class="nav-item">
        <a href="{{route('membership.profileInfoUpdate')}}" class="nav-link {{ session('lsbsm') == 'profileInfo' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Profile Info Update</p>
        </a>
      </li>

      @endif

  

       

    </ul>
  </li>