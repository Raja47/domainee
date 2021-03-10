<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion " id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
         {{ config('app.name') }}
        </div>
        <div class="sidebar-brand-text mx-3 d-sm-block d-md-none d-lg-none">{{ config('app.name') }}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

  
      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
  
           <!-- Divider -->
   
     <li class="nav-item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
          <i class="fas fa-tags"></i>
          <span>Categories</span></a>
      </li>
    
      <li class="nav-item {{ Route::currentRouteName() == 'admin.leads.index' ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('admin.leads.index') }}" >
          <i class="fas fa-shopping-bag"></i>
          <span>Leads</span></a>
      </li>

    
      
     


      
      
     



      



     
     
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>


