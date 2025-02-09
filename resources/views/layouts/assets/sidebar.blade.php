<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT TRISTAR </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->role_id == 1)
    <li class="nav-item {{ Request::routeIs('owner.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('owner.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    {{-- <div class="sidebar-heading">
        Master
    </div>
    <li class="nav-item {{ Request::routeIs('admin.roles') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.roles') }}">
            <i class="fas fa-fw fa-crown"></i>
            <span>Roles</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.users') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.fotografer') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.fotografer') }}">
            <i class="fas fa-fw fa-camera"></i>
            <span>Fotografer</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        PAKET
    </div>
    <li class="nav-item {{ Request::routeIs('admin.wilayah') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.wilayah') }}">
            <i class="fas fa-fw fa-location-arrow"></i>
            <span>Wilayah</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.kategori-paket') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kategori-paket') }}">
            <i class="fas fa-fw fa-pen"></i>
            <span>Kategori</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.paket') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.paket') }}">
            <i class="fas fa-fw fa-gift"></i>
            <span>Paket</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.harga-paket') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.harga-paket') }}">
            <i class="fas fa-fw fa-coins"></i>
            <span>Harga Paket</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.paket-tambahan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.paket-tambahan') }}">
            <i class="fas fa-fw fa-gifts"></i>
            <span>Paket Tambahan</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        PEMESANAN
    </div>
    <li class="nav-item {{ Request::routeIs('admin.booking') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.booking') }}">
            <i class="fas fa-fw fa-location-arrow"></i>
            <span>Booking</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('admin.pesanan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pesanan') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Pesanan</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    @endif

    @if (Auth::user()->role_id == 2)
    <li class="nav-item {{ Request::routeIs('client.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('client.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ Request::routeIs('client.booking') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('client.booking') }}">
            <i class="fas fa-fw fa-location-arrow"></i>
            <span>Booking</span>
        </a>
    </li>


    <hr class="sidebar-divider d-none d-md-block"> --}}
    @endif


    @if (Auth::user()->role_id == 2)
    <li class="nav-item {{ Request::routeIs('abk.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('abk.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('abk.perusahaan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('abk.perusahaan') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Perusahaan</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('abk.projek') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('abk.projek') }}">
            <i class="fas fa-fw fa-wind"></i>
            <span>Projek</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('abk.jenis.rekening') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('abk.jenis.rekening') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Jenis Rekening</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('abk.rekening') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('abk.rekening') }}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Rekening</span>
        </a>
    </li>
    <li class="nav-item {{ Request::routeIs('abk.kas') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('abk.kas') }}">
            <i class="fas fa-fw fa-solid fa-chart-bar"></i>
            <span>Kas Besar</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('abk.report.kas.besar') || request()->routeIs('abk.report.transaksi.projek') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="{{ request()->routeIs('abk.report.kas.besar') || request()->routeIs('abk.report.transaksi.projek') ? 'true' : 'false' }}"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file-excel"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseTwo" class="collapse {{ request()->routeIs('abk.report.kas.besar') || request()->routeIs('abk.report.transaksi.projek') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('abk.report.kas.besar') ? 'active' : '' }}" href="{{ route('abk.report.kas.besar') }}">Kas Besar</a>
                <a class="collapse-item {{ request()->routeIs('abk.report.transaksi.projek') ? 'active' : '' }}" href="{{ route('abk.report.transaksi.projek') }}">Transaksi Projek</a>
            </div>
        </div>
    </li>
    @endif



    @if (Auth::user()->role_id == 3)
    <li class="nav-item {{ Request::routeIs('ap.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ap.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @endif
</ul>