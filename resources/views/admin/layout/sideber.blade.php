<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a @if (Session::get('page')== 'dashboard')
        class="nav-link activeClass1" 
        @else
        class="nav-link"
        @endif href="{{ url('/admin/dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      {{-- {{ Auth::guard('admin')->user()->type }} --}}
      @if (Auth::guard('admin')->user()->type == 'vendor')
      <li class="nav-item ">
        <a @if (Session::get('page')== 'personal'|| Session::get('page')== 'business'||Session::get('page')== 'bank')
        class="nav-link activeClass1" 
        @else
        class="nav-link"
        @endif data-toggle="collapse" href="#ui-vendor" aria-expanded="false" aria-controls="ui-vendor">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Vendor Details</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-vendor">
          <ul class="nav flex-column sub-menu libgcolor">
            <li class="nav-item"> <a @if (Session::get('page')== 'personal')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/update-vendor-details/personal') }}">personal Details</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'business')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/update-vendor-details/business') }}">Business Details</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'bank')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/update-vendor-details/bank') }}">Bank Details</a></li>
            
          </ul>
        </div>
      </li> 
      @else
      <li class="nav-item">
        <a @if (Session::get('page')== 'UpdateAdminDetails'|| Session::get('page')== 'UpdateAdminPassword')
        class="nav-link activeClass1" 
        @else
        class="nav-link"
        @endif  data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-settings">
          <ul class="nav flex-column sub-menu libgcolor">
            <li class="nav-item"> <a @if (Session::get('page')== 'UpdateAdminPassword')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/update-admin-password') }}">Update Password</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'UpdateAdminDetails')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/update-admin-details') }}">Update Details</a></li>
            
          </ul>
        </div>
      </li>     
      <li class="nav-item">
        <a @if (Session::get('page')== 'view_admin' ||Session::get('page')== 'view_subadmin'||Session::get('page')== 'view_vendor'||Session::get('page')== 'view_all')
        class="nav-link activeClass1" 
        @else
        class="nav-link"
        @endif data-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Admin Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse " id="ui-admin">
          <ul class="nav flex-column sub-menu libgcolor">
            <li class="nav-item"> <a @if (Session::get('page')== 'view_admin')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/admins/admin') }}">Admin</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'view_subadmin')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/admins/subadmin') }}">subadmin</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'view_vendor')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/admins/vendor') }}">Vendor</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'view_all')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/admins') }}">All</a></li>
            
          </ul>
        </div>
      </li>     
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-user">
          <ul class="nav flex-column sub-menu libgcolor">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users') }}">Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/subscribers') }}">Subscribers</a></li>
          </ul>
        </div>
      </li> 
      <li class="nav-item">
        <a @if (Session::get('page')== 'sections'|| Session::get('page')== 'categories'||Session::get('page')== 'producets')
        class="nav-link activeClass1" 
        @else
        class="nav-link"
        @endif data-toggle="collapse" href="#ui-category" aria-expanded="false" aria-controls="ui-category">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Catalogue Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-category">
          <ul class="nav flex-column sub-menu libgcolor">
            <li class="nav-item"> <a @if (Session::get('page')== 'sections')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/sections') }}">Sections</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'categories')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/categories') }}">Categories</a></li>
            <li class="nav-item"> <a @if (Session::get('page')== 'producets')
              class="nav-link activeClass" 
              @else
              class="nav-link"
              @endif href="{{ url('admin/producets') }}">Products</a></li>
          </ul>
        </div>
      </li>       
      @endif
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Form elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="icon-bar-graph menu-icon"></i>
          <span class="menu-title">Charts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-ban menu-icon"></i>
          <span class="menu-title">Error pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>