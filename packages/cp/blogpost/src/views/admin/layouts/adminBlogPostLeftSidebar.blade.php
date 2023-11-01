 @if(auth()->user()->can('post-show'))
 <li class="nav-item  {{ session('lsbm') == 'blogPost' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas  fa-folder"></i>
    <p>
      Blog Post
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.blogCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'blogCategoriesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Blog Categories All</p>
      </a>
    </li>
    

      <li class="nav-item">
      <a href="{{ route('admin.blogPostsAll')}}" class="nav-link {{ session('lsbsm') == 'blogPostsAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Blog Posts All</p>
      </a>
    </li>
      
  </ul>
</li>

@endif