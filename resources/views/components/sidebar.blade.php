<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            @if (Auth::user()->level == 'ADMIN')
                Admin Panel
                @elseif (Auth::user()->level == 'WAITER')
                Waiter Panel
            @endif
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if (Auth::user()->level == 'ADMIN')
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        @elseif (Auth::user()->level == 'WAITER')
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboardWaiter') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tables
    </div>

    @if (Auth::user()->level == 'ADMIN')
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('menu.index') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Menu</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pesanan.index') }}">
                <i class="fas fa-bell fa-fw"></i>
                <span>Pesanan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Transaksi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-envelope fa-fw"></i>
                <span>Users</span></a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('waiter-order') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Order</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
