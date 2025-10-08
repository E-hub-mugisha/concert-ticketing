<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 260px;
            background: #0d6efd;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar .logo {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #ffc107;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            transition: all 0.3s ease;
            padding: 20px;
        }

        /* Header */
        .admin-header {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-header .search-bar {
            width: 250px;
        }

        .admin-header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        .sidebar.collapsed .logo span {
            display: none;
        }

        .toggle-btn {
            cursor: pointer;
            font-size: 1.25rem;
            color: #0d6efd;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <span>🎟️ EventAdmin</span>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="active"><i class="bi bi-house"></i> <span>Dashboard</span></a>
        <a href="{{ route('admin.events.index') }}"><i class="bi bi-calendar-event"></i> <span>Events</span></a>
        <a href="{{ route('admin.tickets.index') }}"><i class="bi bi-ticket-perforated"></i> <span>Tickets</span></a>
        <a href="{{ route('admin.orders.index') }}"><i class="bi bi-bag-check"></i> <span>Orders</span></a>
        <a href="#"><i class="bi bi-graph-up"></i> <span>Analytics</span></a>
        <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="admin-header">
            <div class="toggle-btn" id="toggleSidebar"><i class="bi bi-list"></i></div>
            <input type="text" class="form-control search-bar" placeholder="Search...">
            <div class="user-info">
                <span>👋 {{ auth()->user()->name ?? 'Admin' }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}" 
                     class="rounded-circle" width="35" height="35">
            </div>
        </div>

        <main class="mt-3">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });
    </script>

    @stack('scripts')
</body>
</html>
