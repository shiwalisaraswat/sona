@php
  use Illuminate\Support\Facades\Route;
  $routeName = Route::currentRouteName();
@endphp


<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item nav-profile">
      <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ Auth::guard('admin')->user()->profile_pic_url }}" alt="profile" />
          <span class="login-status online"></span>
          <!-- change to offline or busy as needed -->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ Auth::guard('admin')->user()->name }}</span>
          <span class="text-secondary text-small">{{ ucwords(str_replace('_', ' ', Auth::guard('admin')->user()->role)) }}</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>

    <li class="nav-item {{ ($routeName == 'admin.dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
      <a class="nav-link" 
        data-bs-toggle="collapse" 
        href="#ui-admins" 
        aria-expanded="{{ request()->routeIs('admin.admins.*') ? 'true' : 'false' }}">
        <span class="menu-title">Admin</span>
        <i class="menu-arrow"></i>
        <i class="fa fa-id-card"></i>
      </a>
      
      <div class="collapse {{ request()->routeIs('admin.admins.*') ? 'show' : '' }}" id="ui-admins">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ $routeName === 'admin.admins.index' ? 'active' : '' }}" 
              href="{{ route('admin.admins.index') }}">
              Admin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $routeName === 'admin.admins.create' ? 'active' : '' }}" 
              href="{{ route('admin.admins.create') }}">
              Create
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.room_types.*') ? 'active' : '' }}">
      <a class="nav-link" 
        data-bs-toggle="collapse" 
        href="#ui-room_types" 
        aria-expanded="{{ request()->routeIs('admin.room_types.*') ? 'true' : 'false' }}">
        <span class="menu-title">Room Type</span>
        <i class="menu-arrow"></i>
        <i class="fa fa-cube menu-icon"></i>
      </a>
      
      <div class="collapse {{ request()->routeIs('admin.room_types.*') ? 'show' : '' }}" id="ui-room_types">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            {{-- STRICT CHECK: Only active if exact route match --}}
            <a class="nav-link {{ $routeName === 'admin.room_types.index' ? 'active' : '' }}" 
              href="{{ route('admin.room_types.index') }}">
              Room Type
            </a>
          </li>
          <li class="nav-item">
            {{-- STRICT CHECK: Only active if exact route match --}}
            <a class="nav-link {{ $routeName === 'admin.room_types.create' ? 'active' : '' }}" 
              href="{{ route('admin.room_types.create') }}">
              Create
            </a>
          </li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
      <a class="nav-link" 
        data-bs-toggle="collapse" 
        href="#ui-rooms" 
        aria-expanded="{{ request()->routeIs('admin.rooms.*') ? 'true' : 'false' }}">
        <span class="menu-title">Room</span>
        <i class="menu-arrow"></i>
        <i class="fa fa-s15"></i>
      </a>
      
      <div class="collapse {{ request()->routeIs('admin.rooms.*') ? 'show' : '' }}" id="ui-rooms">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ $routeName === 'admin.rooms.index' ? 'active' : '' }}" 
              href="{{ route('admin.rooms.index') }}">
              Room
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $routeName === 'admin.rooms.create' ? 'active' : '' }}" 
              href="{{ route('admin.rooms.create') }}">
              Create
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
      <a class="nav-link" 
        data-bs-toggle="collapse" 
        href="#ui-services" 
        aria-expanded="{{ request()->routeIs('admin.services.*') ? 'true' : 'false' }}">
        <span class="menu-title">Service</span>
        <i class="menu-arrow"></i>
        <i class="fa fa-cogs"></i>
      </a>
      
      <div class="collapse {{ request()->routeIs('admin.services.*') ? 'show' : '' }}" id="ui-services">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ $routeName === 'admin.services.index' ? 'active' : '' }}" 
              href="{{ route('admin.services.index') }}">
              Service
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $routeName === 'admin.services.create' ? 'active' : '' }}" 
              href="{{ route('admin.services.create') }}">
              Create
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ ($routeName == 'admin.contacts.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.contacts.index') }}">
        <span class="menu-title">Contact</span>
        <i class="fa fa-file-text ms-2 me-2"></i>
      </a>
    </li>
    
  </ul>
</nav>
