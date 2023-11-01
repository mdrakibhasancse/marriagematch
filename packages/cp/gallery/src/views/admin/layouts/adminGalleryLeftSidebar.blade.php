@if(auth()->user()->can('gallery-show'))
 <li class="nav-item  {{ session('lsbm') == 'gallery' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-chart-pie"></i>
      <p>
        Gallery
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.galleriesAll')}}" class="nav-link {{ session('lsbsm') == 'galleriesAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Galleries All</p>
        </a>
      </li>
      
        
    </ul>
</li>

@endif