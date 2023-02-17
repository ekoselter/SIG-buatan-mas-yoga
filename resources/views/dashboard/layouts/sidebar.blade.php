<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        {{-- tanda bintang akan membuat route setelah url post akan active tombolnya --}}
        <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
          <span data-feather="layers" class="align-text-bottom"></span>
          Map Category
        </a>
      </li>
      <li class="nav-item">
        {{-- tanda bintang akan membuat route setelah url post akan active tombolnya --}}
        <a class="nav-link {{ Request::is('dashboard/categoryChildren*') ? 'active' : '' }}" href="/dashboard/categoryChildren">
          <span data-feather="grid" class="align-text-bottom"></span>
          Map Sub-Category
        </a>
      </li>
      <li class="nav-item">
        {{-- tanda bintang akan membuat route setelah url post akan active tombolnya --}}
        <a class="nav-link {{ Request::is('dashboard/map*') ? 'active' : '' }}" href="/dashboard/maps">
          <span data-feather="globe" class="align-text-bottom"></span>
          Maps
        </a>
      </li>

    </ul>

    {{-- baris ini hanya bisa digunakan dengan gate admin. yang diatur di app service provider --}}         
    <h6 class="sidebar-heding d-flex justify-content-between align-center px-3 mt-4 mb-1 text-muted">
      <span>Administrator</span>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        {{-- tanda bintang akan membuat route setelah url post akan active tombolnya --}}
        <a class="nav-link {{ Request::is('peta*') ? 'active' : '' }}" href="/peta">
          <span data-feather="map-pin" class="align-text-bottom"></span>
          Map Page
        </a>
      </li>
    </ul>
  </div>
</nav>
