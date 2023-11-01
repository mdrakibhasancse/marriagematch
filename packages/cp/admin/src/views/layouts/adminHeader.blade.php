<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
          <a target="_blank" class="nav-link"  href="{{ url('/') }}" style="color:rgb(119, 154, 250)">
            <i class="fas fa-globe"></i>
          </a>
      </li>
    </ul>

    <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
          <i class="fas fa-user mr-1"></i> {{ ucfirst(auth()->user()->name ) }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          
          @if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('user_manage'))
          <a href="{{route('admin.dashboard')}}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>Admin Dashboard
          </a>
          @endif

          <a href="{{ route('userrole.dashboard')}}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>My Dashboard
          </a>

          <div class="dropdown-divider"></div>
          <form action="{{ route('logout')}}" method="post">
            @csrf
            <button class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
          </form>
          
        </div>
      </li>
     
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <style>
      .dropdown-menu-lg {
        min-width: 170px !important;
    }
  </style>

