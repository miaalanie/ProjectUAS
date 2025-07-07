<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SnackMood</div>
    </a>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Master Data (Dropdown) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
            aria-expanded="false" aria-controls="collapseMasterData">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.pengguna') }}"><i class="fas fa-fw fa-users mr-2"></i>Data Pengguna</a>
                <a class="collapse-item" href="{{ route('admin.snack') }}"><i class="fas fa-fw fa-cookie-bite mr-2"></i>Data Snack</a>
                <a class="collapse-item" href="{{ route('admin.rules') }}"><i class="fas fa-fw fa-random mr-2"></i>Rules Fuzzy</a>
            </div>
        </div>
    </li>
    <!-- Transaksi (Dropdown) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
            aria-expanded="false" aria-controls="collapseTransaksi">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.log-mood') }}"><i class="fas fa-fw fa-chart-line mr-2"></i>Log Mood</a>
                <a class="collapse-item" href="{{ route('admin.riwayat-snack') }}"><i class="fas fa-fw fa-candy-cane mr-2"></i>Riwayat Snack</a>
                <a class="collapse-item" href="{{ route('admin.statistik-konsumsi') }}"><i class="fas fa-fw fa-chart-bar mr-2"></i>Statistik Konsumsi</a>
            </div>
        </div>
    </li>
    <!-- Monitoring (Dropdown) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonitoring"
            aria-expanded="false" aria-controls="collapseMonitoring">
            <i class="fas fa-fw fa-bell"></i>
            <span>Monitoring</span>
        </a>
        <div id="collapseMonitoring" class="collapse" aria-labelledby="headingMonitoring" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.bad-mood') }}"><i class="fas fa-fw fa-exclamation-triangle mr-2"></i>Bad Mood Alert</a>
                <a class="collapse-item" href="{{ route('admin.frekuensi-snack') }}"><i class="fas fa-fw fa-chart-pie mr-2"></i>Frekuensi Snack</a>
            </div>
        </div>
    </li>
    <!-- Laporan (Dropdown) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="false" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.laporan-user') }}"><i class="fas fa-fw fa-folder-open mr-2"></i>Per User</a>
                <a class="collapse-item" href="{{ route('admin.laporan-akumulasi') }}"><i class="fas fa-fw fa-chart-area mr-2"></i>Akumulatif</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
