<aside class="main-sidebar sidebar-light-danger elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link navbar-danger">
    <img src="{{ asset('img/logo.png') }}"
         alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Sampoerna Kayoe</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{ request()->is(['user', 'user/*']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is(['user', 'user/*']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Index</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('user.create') }}" class="nav-link {{ request()->is('user/create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
            <li class="nav-item">
              <form class="nav-link {{ request()->is('user/edit/*') ? 'active' : '' }}" action="{{ route('user.findAndChange') }}" method="post">
                @csrf
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="NIK" name="code">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">Find</button>
                  </div>
                </div>
              </form>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('absent.index') }}" class="nav-link {{ request()->is('absent') ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              absent
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>