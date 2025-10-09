<nav id="sidebar" class="bg-dark text-white">
    <div class="sidebar-header text-center py-3 border-bottom border-secondary">
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center justify-content-center text-decoration-none text-white">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="me-2" style="width: 40px;">
            <h5 class="m-0 fw-bold">Admin Panel</h5>
        </a>
    </div>

    <ul class="list-unstyled components py-3">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.events.*') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.events.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-calendar-alt me-2"></i> Events
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.tickets.*') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.tickets.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-ticket-alt me-2"></i> Tickets
            </a>
        </li>
        

        <li class="{{ request()->routeIs('admin.orders.*') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.orders.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-shopping-cart me-2"></i> Orders
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.users.*') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-users me-2"></i> Users
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.payments') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.payments.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-credit-card me-2"></i> Payments
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.reports.*') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.reports.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-chart-line me-2"></i> Reports
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.settings') ? 'active bg-primary' : '' }}">
            <a href="{{ route('admin.settings') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none">
                <i class="fas fa-cog me-2"></i> Settings
            </a>
        </li>

        <li class="mt-4">
            <form action="{{ route('logout') }}" method="POST" class="px-3">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

<style>
    #sidebar {
        width: 250px;
        transition: all 0.3s ease-in-out;
    }

    #sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    #sidebar .active {
        border-left: 4px solid #0d6efd;
        background-color: #0d6efd !important;
    }
</style>