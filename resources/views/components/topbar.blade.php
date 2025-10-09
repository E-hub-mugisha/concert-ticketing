<!-- navbar navigation component -->
<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm px-3">
    <button type="button" id="sidebarCollapse" class="btn btn-light">
        <i class="fas fa-bars"></i><span></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ms-auto">

            <!-- Notifications Dropdown -->
            <li class="nav-item dropdown">
                <div class="nav-dropdown">
                    <a href="#" id="notificationsDropdown" class="nav-item nav-link dropdown-toggle text-secondary position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span>Notifications</span>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nav-link-menu" aria-labelledby="notificationsDropdown" style="width: 300px;">
                        <ul class="nav-list">
                            <li>
                                <a href="#" class="dropdown-item d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <div>
                                        <strong>Order #124</strong> has been approved.
                                        <div class="small text-muted">2 mins ago</div>
                                    </div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="#" class="dropdown-item d-flex align-items-start">
                                    <i class="fas fa-user-plus text-primary me-2"></i>
                                    <div>
                                        New user <strong>Jane Doe</strong> registered.
                                        <div class="small text-muted">10 mins ago</div>
                                    </div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="#" class="dropdown-item d-flex align-items-start">
                                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                    <div>
                                        Server usage is high.
                                        <div class="small text-muted">30 mins ago</div>
                                    </div>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li class="text-center">
                                <a href="#" class="dropdown-item text-primary">View All Notifications</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <div class="nav-dropdown">
                    <a href="#" id="userDropdown" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> <span>{{ Auth::user()->name }}</span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                        <ul class="nav-list">
                            <li><a href="#" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fas fa-envelope"></i> Messages</a></li>
                            <li><a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a></li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-3">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- end of navbar navigation -->