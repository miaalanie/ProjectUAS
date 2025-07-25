<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <style>
        .sidebar {
            border-radius: 24px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
            margin: 16px 8px 16px 8px;
            transition: width 0.3s, box-shadow 0.3s;
            min-width: 220px;
            max-width: 260px;
        }
        .sidebar.collapsed {
            width: 70px;
            min-width: 70px;
            max-width: 70px;
        }
        .sidebar .sidebar-brand-text {
            transition: opacity 0.3s;
        }
        .sidebar.collapsed .sidebar-brand-text,
        .sidebar.collapsed span,
        .sidebar.collapsed .nav-link > span {
            opacity: 0;
            pointer-events: none;
        }
        .sidebar .sidebar-brand-icon {
            font-size: 2rem;
        }
        .sidebar .nav-link {
            border-radius: 12px;
            margin: 4px 8px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .sidebar-divider {
            border-top: 2px solid #fff;
            margin: 8px 0;
        }
        .sidebar-toggle-btn {
            background: #fff;
            color: #4e73df;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: absolute;
            left: 16px;
            top: 16px;
            z-index: 10;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar-toggle-btn:hover {
            background: #4e73df;
            color: #fff;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.getElementById('accordionSidebar');
            var btn = document.getElementById('sidebarToggleCustom');
            if(btn) {
                btn.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    btn.classList.toggle('collapsed');
                    btn.innerHTML = sidebar.classList.contains('collapsed') ? '<i class="fas fa-angle-double-right"></i>' : '<i class="fas fa-angle-double-left"></i>';
                });
            }
        });
    </script>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guest.dashboard') }}" style="margin-top:48px;">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SnackMood</div>
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('guest.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guest.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Item - Mulai Diagnosa -->
    <li class="nav-item {{ request()->routeIs('guest.mulaiDiagnosa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guest.mulaiDiagnosa') }}">
            <i class="fas fa-vial"></i>
            <span>Mulai Diagnosa</span></a>
    </li>
    <!-- Nav Item - Tentang Proyek -->
    <li class="nav-item {{ request()->routeIs('guest.tentang') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guest.tentang') }}">
            <i class="fas fa-info-circle"></i>
            <span>Tentang Proyek</span></a>
    </li>
    <!-- Nav Item - Login/Register -->
    <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login / Register</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline" style="margin-bottom:12px;">
        <button class="sidebar-toggle-btn" id="sidebarToggleCustom" title="Toggle Sidebar">
            <i class="fas fa-angle-double-left"></i>
        </button>
    </div>
</ul>
<!-- End of Sidebar -->
