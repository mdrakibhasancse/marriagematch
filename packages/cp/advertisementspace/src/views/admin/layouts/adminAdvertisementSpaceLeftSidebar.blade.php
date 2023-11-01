@if(auth()->user()->can('ads-show'))
<li class="nav-item  {{ session('lsbm') == 'advertisement' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas  fa-file"></i>
      <p>
        Ad Space
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.advertisementSpacesAll')}}" class="nav-link {{ session('lsbsm') == 'advertisementsAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>All Ad Spaces</p>
        </a>
      </li>
      

        <li class="nav-item">
        <a href="{{ route('admin.advertisementSpaceCreate')}}" class="nav-link {{ session('lsbsm') == 'advertisementCreate' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>New Ad Space</p>
        </a>
      </li>
        
    </ul>
</li>

@endif