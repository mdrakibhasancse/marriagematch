@if(auth()->user()->can('story-show'))
 <li class="nav-item  {{ session('lsbm') == 'story' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas  fa-folder"></i>
    <p>
      Story
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.storiesAll')}}" class="nav-link {{ session('lsbsm') == 'storiesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Stories All</p>
      </a>
    </li>
    
    <li class="nav-item">
      <a href="{{ route('admin.testimonialsAll')}}" class="nav-link {{ session('lsbsm') == 'testimonialsAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Testimonials All</p>
      </a>
    </li>

  </ul>
</li>
@endif