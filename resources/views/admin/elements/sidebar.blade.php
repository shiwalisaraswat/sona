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

    <li class="nav-item {{ request()->routeIs('admin.room_types.*') ? 'active' : '' }}">
      <a class="nav-link" 
        data-bs-toggle="collapse" 
        href="#ui-basic" 
        aria-expanded="{{ request()->routeIs('admin.room_types.*') ? 'true' : 'false' }}">
        <span class="menu-title">Room Type</span>
        <i class="menu-arrow"></i>
        <i class="fa fa-cube menu-icon"></i>
      </a>
      
      <div class="collapse {{ request()->routeIs('admin.room_types.*') ? 'show' : '' }}" id="ui-basic">
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
    

    
  </ul>
</nav>
