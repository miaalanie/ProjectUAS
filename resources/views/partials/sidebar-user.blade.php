<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SnackMood</div>
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.dashboard')}}">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Diagnosa Baru -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.diagnosa')}}">
            <i class="fas fa-fw fa-vials"></i>
            <span>Diagnosa Baru</span></a>
    </li>
    <!-- Riwayat Diagnosa -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.riwayat')}}">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Riwayat Diagnosa</span></a>
    </li>
    <!-- Snack Saya -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.mySnack')}}">
            <i class="fas fa-fw fa-cookie-bite"></i>
            <span>Snack Saya</span></a>
    </li>
    <!-- Statistik Saya -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.statistik')}}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Statistik Saya</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
