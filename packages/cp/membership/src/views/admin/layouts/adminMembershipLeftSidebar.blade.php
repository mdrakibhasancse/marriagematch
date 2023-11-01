@if(auth()->user()->can('marriage-parameter-show'))
 <li class="nav-item  {{ session('lsbm') == 'marriageParameter' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas  fa-folder"></i>
    <p>
      Marriage Parameters
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">  
    <li class="nav-item">
      <a href="{{ route('admin.profileCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'profileCategoriesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Category</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.profileSubCategoriesAll')}}" class="nav-link {{ session('lsbsm') == 'profileSubcategoriesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Subcategory</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.profileReligionsAll')}}" class="nav-link {{ session('lsbsm') == 'profileReligionsAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Religions</p>
      </a>
    </li>

     <li class="nav-item">
      <a href="{{ route('admin.profileCastsAll')}}" class="nav-link {{ session('lsbsm') == 'profileCastsAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Casts</p>
      </a>
    </li>

     <li class="nav-item">
      <a href="{{ route('admin.profileSettingFieldsAll')}}" class="nav-link {{ session('lsbsm') == 'profileSettingFieldsAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Setting Fields</p>
      </a>
    </li>

     <li class="nav-item">
      <a href="{{ route('admin.profileSettingValuesAll')}}" class="nav-link {{ session('lsbsm') == 'profileSettingValuesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Setting Values</p>
      </a>
    </li>


     <li class="nav-item">
      <a href="{{ route('admin.profileParametersAll')}}" class="nav-link {{ session('lsbsm') == 'profileParametersAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Profile Parameters</p>
      </a>
    </li>

  </ul>
</li>
@endif

@if(auth()->user()->can('membership-package-show'))
 <li class="nav-item  {{ session('lsbm') == 'membershipPackage' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas  fa-folder"></i>
    <p>
      MemberShip Packages
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">  
    <li class="nav-item">
      <a href="{{ route('admin.packageCreate')}}" class="nav-link {{ session('lsbsm') == 'packageCreate' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Create New Package </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.packagesAll')}}" class="nav-link {{ session('lsbsm') == 'packagesAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>All Packages</p>
      </a>
    </li>
  </ul>
</li>
@endif

@if(auth()->user()->can('order-show'))
 <li class="nav-item  {{ session('lsbm') == 'orders' ? ' menu-open ' : '' }}">
  <a href="#" class="nav-link">
    <i class="nav-icon fas  fa-folder"></i>
    <p>
      orders
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">  
    <li class="nav-item">
      <a href="{{ route('admin.ordersAll',['ordersAll'])}}" class="nav-link {{ session('lsbsm') == 'ordersAllordersAll' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>All Orders</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.ordersAll',['pendingOrders'])}}" class="nav-link {{ session('lsbsm') == 'ordersAllpendingOrders' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Pending Orders</p>
      </a>
    </li>

     <li class="nav-item">
      <a href="{{ route('admin.ordersAll',['paidOrders'])}}" class="nav-link {{ session('lsbsm') == 'ordersAllpaidOrders' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Paid Orders</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('admin.ordersAll',['tryPayment'])}}" class="nav-link {{ session('lsbsm') == 'ordersAlltryPayment' ? ' active ' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Try Payment</p>
      </a>
    </li>

  </ul>
</li>
@endif


 