 
@if(auth()->user()->can('user-show'))
 <li class="nav-item {{ session('lsbm') == 'users' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Users
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

  
      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['usersAll']) }}" class="nav-link {{ session('lsbsm') == 'usersAllusersAll' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Users All</p>
        </a>
      </li>  

      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['usersToday']) }}" class="nav-link {{ session('lsbsm') == 'usersAllusersToday' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Users Today</p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['usersThisMonth']) }}" class="nav-link {{ session('lsbsm') == 'usersAllusersThisMonth' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Users This Month</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['paidUsers']) }}" class="nav-link {{ session('lsbsm') == 'usersAllpaidUsers' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Paid Users</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['freeUsers']) }}" class="nav-link {{ session('lsbsm') == 'usersAllfreeUsers' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Free Users</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['activeUsers']) }}" class="nav-link {{ session('lsbsm') == 'usersAllactiveUsers' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Active Users</p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{ route('admin.usersAll',['inactiveUsers']) }}" class="nav-link {{ session('lsbsm') == 'usersAllinactiveUsers' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Inactive Users</p>
        </a>
      </li>
       
      
      <li class="nav-item">
        <a href="{{ route('admin.userCvPictures') }}" class="nav-link {{ session('lsbsm') == 'userCvPictures' ? ' active ' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>User Cv Pictures</p>
        </a>
      </li>   

 

    </ul>
</li>
@endif
 

@if(auth()->user()->can('role-show'))

<li class="nav-item {{ session('lsbm') == 'rolepermission' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Roles & Permissions
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.rolesAll') }}" class="nav-link  {{ session('lsbsm') == 'rolesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Roles All</p>
      </a>
    </li> 

    <li class="nav-item">
      <a href="{{ route('admin.permissionsAll') }}" class="nav-link  {{ session('lsbsm') == 'permissionsAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Permissions All</p>
      </a>
    </li> 

      <li class="nav-item">
      <a href="{{ route('admin.assignRole') }}" class="nav-link  {{ session('lsbsm') == 'assignRole' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Asign Role</p>
      </a>
    </li> 

      <li class="nav-item">
      <a href="{{ route('admin.roleUsers') }}" class="nav-link  {{ session('lsbsm') == 'mangeRole' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Role Users</p>
      </a>
    </li> 

  </ul>
</li>

@endif