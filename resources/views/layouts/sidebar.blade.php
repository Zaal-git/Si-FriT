<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img src="../assets/images/logos/Si-FRiT.svg" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>                
                @auth
                @if (Auth::user()->role === 'admin')
                <li class="sidebar-item {{ request()->is('master-data/*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="{{ request()->is('master-data/*') ? 'true' : 'false' }}">
                        <span>
                            <iconify-icon icon="solar:database-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Master Data</span>
                    </a>
                    <ul class="collapse first-level {{ request()->is('master-data/*') ? 'show' : '' }}" aria-expanded="{{ request()->is('master-data/*') ? 'true' : 'false' }}">
                        <li class="sidebar-item {{ request()->is('master-data/server') ? 'active' : '' }}">
                            <a href="/master-data/server" class="sidebar-link">
                                <span>
                                    <iconify-icon icon="solar:server-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Server</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('master-data/infrastruktur') ? 'active' : '' }}">
                            <a href="/master-data/infrastruktur" class="sidebar-link">
                                <span>
                                    <iconify-icon icon="solar:box-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Infrastruktur</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @endauth
                <li class="sidebar-item {{ request()->is('pengajuan/*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="{{ request()->is('pengajuan/*') ? 'true' : 'false' }}">
                        <span>
                            <iconify-icon icon="solar:clipboard-text-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Pengajuan</span>
                    </a>
                    <ul class="collapse first-level {{ request()->is('pengajuan/*') ? 'show' : '' }}" aria-expanded="{{ request()->is('pengajuan/*') ? 'true' : 'false' }}">
                        <li class="sidebar-item {{ request()->is('pengajuan/jaringan') ? 'active' : '' }}">
                            <a href="/pengajuan/jaringan" class="sidebar-link">
                                <span>
                                    <iconify-icon icon="solar:cloud-bolt-bold" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Jaringan</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('pengajuan/server') ? 'active' : '' }}">
                            <a href="/pengajuan/server" class="sidebar-link">
                                <span>
                                    <iconify-icon icon="solar:server-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Server</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('pengajuan/aplikasi') ? 'active' : '' }}">
                            <a href="/pengajuan/aplikasi" class="sidebar-link">
                                <span>
                                    <iconify-icon icon="solar:chat-square-code-bold-duotone" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Aplikasi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @auth
                @if (Auth::user()->role === 'admin')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Manajemen</span>
                </li>
                <li class="sidebar-item {{ request()->is('manajemen/pengajuan') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/manajemen/pengajuan" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:document-text-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Data Pengajuan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('manajemen/user') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/manajemen/user" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:user-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Manajemen User</span>
                    </a>
                </li>
                @endif
                @endauth
            </ul>
        </nav>
    </div>
  </aside>
  