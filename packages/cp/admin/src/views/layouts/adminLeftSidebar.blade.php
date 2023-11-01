 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ route('imagecache', ['template' => 'sbism', 'filename' => $ws->logo()]) }}" alt="Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy" data-widget="treeview" role="menu" data-accordion="true">
          <li class="nav-item  {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          </li>



           <li class="nav-item  {{ session('lsbm') == 'configurations' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fa-cog"></i>
              <p>
                Setup & Configurations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.languages')}}" class="nav-link {{ session('lsbsm') == 'languages' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Languages</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.translations')}}" class="nav-link {{ session('lsbsm') == 'translations' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Translation</p>
                </a>
              </li>
              
            </ul>
          </li>
           
         
          @includeIf('userrole::admin.layouts.adminUserRoleLeftSidebar')
          @includeIf('menupage::admin.layouts.adminMenupageLeftSidebar')
          @includeIf('membership::admin.layouts.adminMembershipLeftSidebar')
          @includeIf('product::admin.layouts.adminProductLeftSidebar')
          @includeIf('media::admin.layouts.adminMediaLeftSidebar')
          @includeIf('slider::admin.layouts.adminSliderLeftSidebar')
          @includeIf('gallery::admin.layouts.adminGalleryLeftSidebar')
          @includeIf('blogpost::admin.layouts.adminBlogPostLeftSidebar')
          @includeIf('advertisementspace::admin.layouts.adminAdvertisementSpaceLeftSidebar')
          {{-- @includeIf('jobpost::admin.layouts.adminJobPostLeftSidebar') --}}
          @includeIf('successstory::admin.layouts.adminSuccessStoryLeftSidebar')

          

          @includeIf('websitesetting::admin.layouts.adminWebsiteSettingLeftSidebar')

                 
          
         
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>