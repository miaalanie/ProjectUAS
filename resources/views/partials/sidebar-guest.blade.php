<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guest.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SnackMood</div>
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guest.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Item - Mulai Diagnosa -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guest.mulaiDiagnosa') }}">
            <i class="fas fa-vial"></i>
            <span>Mulai Diagnosa</span></a>
    </li>
    <!-- Nav Item - Tentang Proyek -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guest.tentang') }}">
            <i class="fas fa-info-circle"></i>
            <span>Tentang Proyek</span></a>
    </li>
    <!-- Nav Item - Login/Register -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login / Register</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
