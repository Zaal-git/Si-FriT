<div class="body-wrapper">
  <header class="app-header sticky-top bg-white shadow-sm z-3">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
              <i class="ti ti-bell-ringing"></i>
              <div class="notification bg-primary rounded-circle"></div>
            </a>
          </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
        </form>
        </div>
      </nav>
    </header>