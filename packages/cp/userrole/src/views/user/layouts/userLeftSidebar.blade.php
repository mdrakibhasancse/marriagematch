 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('userrole.dashboard') }}" class="brand-link">
      <img src="{{ route('imagecache', ['template' => 'sbism', 'filename' => $ws->logo()]) }}" alt="My Panel" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">My Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
 

      <br>

      {{-- <!-- SidebarSearch Form -->
      <div class="form-inline  ">
        <div class="input-group input-group-sm" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy" data-widget="treeview" role="menu" data-accordion="true">
          <li class="nav-item  {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
            <a href="{{ route('userrole.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
 
          </li>

        <li class="nav-item  {{ session('lsbm') == 'userInfo' ? ' menu-open ' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas  fa-user"></i>
            <p>
              Password 
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            
            <li class="nav-item">
              <a href="{{ route('userrole.userEdit') }}" class="nav-link {{ session('lsbsm') == 'userEdit' ? ' active ' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Password Update</p>
              </a>
            </li>

            

          </ul>
        </li>
           
          @includeIf('membership::user.layouts.memberLeftSidebar')

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>