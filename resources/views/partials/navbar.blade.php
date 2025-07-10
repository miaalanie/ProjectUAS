<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Fullscreen Button (Improved) -->
<button id="fullscreenBtn" class="btn-fullscreen ml-2" title="Fullscreen">
    <i class="fas fa-expand"></i>
</button>
<style>
.btn-fullscreen {
    background: transparent;
    border: none;
    color: #4e73df;
    font-size: 1.25rem;
    padding: 0.5rem 0.75rem;
    transition: background 0.2s, color 0.2s;
    outline: none;
    box-shadow: none;
}
.btn-fullscreen:hover, .btn-fullscreen:focus {
    background: #f1f1f1;
    color: #224abe;
    border-radius: 50%;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('fullscreenBtn');
        if(btn) {
            btn.addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                }
            });
        }
    });
</script>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item mr-2">
        <form method="POST" action="{{ route('login') }}" class="d-inline">
            @csrf
            <input type="hidden" name="email" value="guest@example.com">
            <input type="hidden" name="password" value="guestpassword">
            <!-- <button type="submit" class="btn btn-sm btn-outline-primary" style="margin-top:8px;">Guest</button> -->
        </form>
    </li>
    @endguest

    <!-- Nav Item - Alerts (Dummy) -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger badge-counter">0</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Notifications</h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-info text-white"></i>
                    </div>
                </div>
                <div>No new notifications</div>
            </a>
        </div>
    </li>

    <!-- Nav Item - Messages (Dummy) -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger badge-counter">0</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Message Center</h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="assets/img/undraw_profile_1.svg" alt="...">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div>No new messages</div>
            </a>
        </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                @if(Auth::check())
                    {{ Auth::user()->name }}
                @else
                    Guest
                @endif
            </span>
            <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=4e73df&color=fff&size=60" alt="Avatar">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            @if(Auth::check())
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </form>

            @else
                <a class="dropdown-item" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Login
                </a>
            @endif
        </div>
    </li>
</ul>

</nav>
<!-- End of Topbar -->